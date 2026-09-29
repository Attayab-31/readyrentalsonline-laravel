<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Message;
use App\Models\User;
use App\Http\Helpers\Email_functions;

class ChatController extends Controller
{ 
    /**
     * Display the chat interface.
     */
    public function index()
    {
        // Get a list of users for the chat interface
        if(auth()->user()->user_type == 'tenant')
        {
            $db_data['threadList'] = User::where('id', '!=', auth()->id())
                                          ->where('user_type' , "superAdmin")
                                          ->orWhere('user_type' , "admin")
                                          ->get();
        }
        else{
            $db_data['threadList'] = User::where('id', '!=', auth()->id())->get();
        }
        return view('Account.Chat.chats', compact('db_data'));
    }


        /**
     * Fetch messages between the logged-in user and another user.
     */
    public function fetchMessages($uniqueIdentifier)
    {
 
        if(auth()->user()->user_type == 'tenant')
        {
            $db_data['threadList'] = User::where('id', '!=', auth()->id())
                                          ->where('user_type' , "superAdmin")
                                          ->orWhere('user_type' , "admin")
                                          ->get();
        }
        else{
            $db_data['threadList'] = User::where('id', '!=', auth()->id())->get();
        }
        
        // Fetch the sender and receiver by unique identifier
        $user = User::where('unique_identifier', $uniqueIdentifier)->firstOrFail();
        
        $db_data['messages'] = Message::where(function ($query) use ($user) {
                    $query->where('sender_id', auth()->id())
                          ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                          ->where('receiver_id', auth()->id());
                })
                ->orderBy('created_at', 'asc')
                ->get();
    
 
        return view('Account.Chat.thread', compact('db_data' , 'user'));
        // return response()->json($messages);
    }
    

    /**
     * Send a message.
     */
    public function sendMessageOld(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,unique_identifier',
            'message' => 'required|string',
        ]);
    
        $receiver = User::where('unique_identifier', $validated['receiver_id'])->firstOrFail();
    
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'message' => $validated['message'],
        ]);
    
        $messageHtml = view('Account.Chat.message_partial', ['message' => $message])->render();
    
        return response()->json([
            'messageHtml' => $messageHtml,
            'lastMessageId' => $message->id, // Pass the ID of the new message
        ]);
    }
    
     
     
     
    /**
     * Send a message.
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,unique_identifier',
            'message' => 'required|string',
        ]);
    
        $receiver = User::where('unique_identifier', $validated['receiver_id'])->firstOrFail();
        
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'message' => $validated['message'],
        ]);
    
        // Send email notification to the receiver
        $senderName = auth()->user()->first_name.' '.auth()->user()->last_name; // or whatever field you use for user's name
        $receiverEmail = $receiver->email;
        
        $loginUrl = url('/login'); // or a direct link to the chat if you have one
        
        $emailResult = Email_functions::sendNewEmail_For_Webhook(
            $receiverEmail,
            'New Message from ' . $senderName,
            'email_templates.new_message_notification',
            [], // BCC array
            "notification@readyrentalsonline.com",
            "ReadyRentalsOnline.com",
            [
                'receiverName' => $receiver->name,
                'senderName' => $senderName,
                'messageContent' => $validated['message'],
                'loginUrl' => $loginUrl
            ]
        );
 
        // Log email result if needed
        if ($emailResult['res_code'] !== 200) {
            \Log::error('Failed to send message notification email', [
                'error' => $emailResult['message'],
                'receiver_id' => $receiver->id
            ]);
        }
    
        $messageHtml = view('Account.Chat.message_partial', ['message' => $message])->render();
    
        return response()->json([
            'messageHtml' => $messageHtml,
            'lastMessageId' => $message->id,
        ]);
    } 
     
     
     
     
     
     
     
     
    /**
     * Fetch new messages between the logged-in user and another user.
     */

     public function fetchNewMessages(Request $request)
     {
         $validated = $request->validate([
             'receiver_id' => 'required|exists:users,unique_identifier',
             'last_message_id' => 'required|integer',
         ]);
     
         $receiver = User::where('unique_identifier', $validated['receiver_id'])->firstOrFail();
     
         $query = Message::where(function ($q) use ($receiver, $request) {
            $q->where(function ($q) use ($receiver) {
                $q->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiver->id);
            })
            ->orWhere(function ($q) use ($receiver) {
                $q->where('sender_id', $receiver->id)
                  ->where('receiver_id', auth()->id());
            });
        })
        ->where('id', '>', $request->last_message_id)
        ->orderBy('id', 'asc');
        
        $newMessages = $query->get();
 
         // Return rendered HTML for new messages
         $messageHtml = '';
         foreach ($newMessages as $message) {
             $messageHtml .= view('Account.Chat.message_partial', ['message' => $message])->render();
         }
     
         return response()->json([
             'messageHtml' => $messageHtml,
             'lastMessageId' => $newMessages->last()?->id, // Update the lastMessageId to the latest message ID
         ]);
     }
 
    public function print_conversation($uniqueIdentifier)
    {
        // Fetch the messages based on the unique identifier
        $user = User::where('unique_identifier', $uniqueIdentifier)->firstOrFail();
    
        $messages = Message::where(function ($query) use ($user) {
                        $query->where('sender_id', auth()->id())
                            ->where('receiver_id', $user->id);
                    })
                    ->orWhere(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)
                            ->where('receiver_id', auth()->id());
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();
    
        return view('Account.Chat.printConversation', compact('messages'));
    }
     


    public function delete_conversation($uniqueIdentifier)
    {
        // Fetch the messages based on the unique identifier
        $user = User::where('unique_identifier', $uniqueIdentifier)->firstOrFail();
    
        $messages = Message::where(function ($query) use ($user) {
                        $query->where('sender_id', auth()->id())
                            ->where('receiver_id', $user->id);
                    })
                    ->orWhere(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)
                            ->where('receiver_id', auth()->id());
                    })
                    ->delete();
    
        return redirect('accounts/chat/messages/'.$uniqueIdentifier)->with('success', 'Conversation deleted successfully.');
    }

}