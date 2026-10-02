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
        $db_data['threadList'] = $this->threadListForCurrentUser();

        return view('Account.Chat.chats', compact('db_data'));
    }


        /**
     * Fetch messages between the logged-in user and another user.
     */
    public function fetchMessages($uniqueIdentifier)
    {
        $db_data['threadList'] = $this->threadListForCurrentUser();

        // Limit the selected thread to the recipients allowed for this role.
        $user = $db_data['threadList']->firstWhere('unique_identifier', $uniqueIdentifier);
        abort_unless($user, 404);
        
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
     * Return the conversations visible to the signed-in account role.
     */
    private function threadListForCurrentUser()
    {
        $query = User::where('id', '!=', auth()->id());

        if (auth()->user()->isTenant()) {
            $query->whereIn('user_type', ['superAdmin', 'admin']);
        }

        return $query->get();
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
    
        // A notification failure must not make an already-saved message look unsent.
        $this->sendMessageNotification($receiver, $validated['message']);
        
        $messageHtml = view('Account.Chat.message_partial', ['message' => $message])->render();
    
        return response()->json([
            'messageHtml' => $messageHtml,
            'lastMessageId' => $message->id,
        ]);
    } 

    protected function sendMessageNotification(User $receiver, string $messageContent): void
    {
        $sender = auth()->user();
        $senderName = trim($sender->first_name . ' ' . $sender->last_name);
        $receiverName = trim($receiver->first_name . ' ' . $receiver->last_name);

        try {
            $emailResult = Email_functions::sendNewEmail_For_Webhook(
                $receiver->email,
                'New Message from ' . $senderName,
                'email_templates.new_message_notification',
                [],
                'notification@readyrentalsonline.com',
                'ReadyRentalsOnline.com',
                [
                    'receiverName' => $receiverName,
                    'senderName' => $senderName,
                    'messageContent' => $messageContent,
                    'loginUrl' => url('/login'),
                ]
            );

            if (($emailResult['res_code'] ?? null) !== 200) {
                \Log::error('Failed to send message notification email', [
                    'error' => $emailResult['message'] ?? 'Unknown email delivery error',
                    'receiver_id' => $receiver->id,
                ]);
            }
        } catch (\Throwable $exception) {
            \Log::error('Failed to send message notification email', [
                'error' => $exception->getMessage(),
                'receiver_id' => $receiver->id,
            ]);
        }
    }
     
     
     
     
     
     
     
     
    /**
     * Fetch new messages between the logged-in user and another user.
     */

     public function fetchNewMessages(Request $request)
     {
         $validated = $request->validate([
             'receiver_id' => 'required|exists:users,unique_identifier',
             'last_message_id' => 'nullable|integer|min:0',
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
        ->where('id', '>', (int) ($validated['last_message_id'] ?? 0))
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
