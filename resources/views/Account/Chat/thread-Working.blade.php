@extends('layouts.accounts')
@section("styles")
@endsection
@section('content')

<style>

   #users-conversation {
      overflow-y: auto; /* Enables scrolling */
      max-height: 300px; /* Adjust to fit your UI layout */
   }
</style>
<div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">

    @include('Account.Partials.Chat.threadList' , ['threadList' => $db_data['threadList']])

   <!-- Start User chat -->
   <div class="user-chat w-100 overflow-hidden">
      <div class="chat-content d-lg-flex">
         <!-- start chat conversation section -->
         <div class="w-100 overflow-hidden position-relative">
            <!-- conversation user -->
            <div class="position-relative">
               <div class="position-relative" id="users-chat" style="display: block;">
                  <div class="p-3 user-chat-topbar">
                     <div class="row align-items-center">
                        <div class="col-sm-4 col-8">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0 d-block d-lg-none me-3">
                                 <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                              </div>
                              <div class="flex-grow-1 overflow-hidden">
                                 <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                       <img src="{{$user->getProfilePicture($user->profile_picture)}}" class="rounded-circle avatar-xs" alt="">
                                       <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                       <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">{{$user->first_name.' '.$user->last_name}}</a></h5>
                                       <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>Online</small></p>
                                    </div>
   
                                 </div>
                              </div>
                           </div>
                        </div>

                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                         <div class="col-sm-8 col-4">
                           <ul class="list-inline user-chat-nav text-end mb-0">
                              <li class="list-inline-item d-none d-lg-inline-block m-0">
                                 <a href="{{url('accounts/chat/print_converstaion/'.$user->unique_identifier)}}" class="btn btn-primary print-button"  >Print Conversation</a>
                              </li>
                           </ul>
                        </div>
                        @endif  
                     </div>
                  </div>
                  <!-- end chat user head -->
                  <div class="chat-conversation p-3 p-lg-4 simplebar-scrollable-y" id="chat-conversation" data-simplebar="init">
                     <div class="simplebar-wrapper" style="margin: -24px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                           <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                           <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                              <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                 <div class="simplebar-content" style="padding: 24px;">
                                    {{-- <div id="elmLoader"></div> --}}
                                    <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                        @foreach ($db_data['messages'] as $message)
                                            @include('Account.Partials.Chat.message', ['message' => $message])
                                        @endforeach
                                    </ul>
                                    
                                    <!-- end chat-conversation-list -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 1025px; height: 1205px;"></div>
                     </div>
                     <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                     </div>
                     <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 25px; display: block; transform: translate3d(0px, 33px, 0px);"></div>
                     </div>
                  </div>
 
               </div> 
               <!-- end chat-conversation -->
               <div class="chat-input-section p-3 p-lg-4">
                <form id="chatinput-form" enctype="multipart/form-data">
                    <div class="row g-0 align-items-center">
 
                        <div class="col">
                            <div class="chat-input-feedback">
                                Please Enter a Message
                            </div>
                            <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" placeholder="Type your message..." autocomplete="off">
                        </div>
                        <div class="col-auto">
                            <div class="chat-input-links ms-2">
                                <div class="links-list-item">
                                    <button type="submit" class="btn btn-success chat-send waves-effect waves-light">
                                        <i class="ri-send-plane-2-fill align-bottom"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="receiver_id" value="{{ $user->unique_identifier }}">
                </form>
                
               </div>
               <div class="replyCard">
                  <div class="card mb-0">
                     <div class="card-body py-3">
                        <div class="replymessage-block mb-0 d-flex align-items-start">
                           <div class="flex-grow-1">
                              <h5 class="conversation-name"></h5>
                              <p class="mb-0"></p>
                           </div>
                           <div class="flex-shrink-0">
                              <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18" fdprocessedid="2xvkbn">
                              <i class="bx bx-x align-middle"></i>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end chat-wrapper -->
@endsection



@section("scripts")

<script>

$(document).ready(function () {
    

      scrollToBottomMessage(true);

   
      let lastMessageId = $('#users-conversation li:last-child').attr('data-message-id') || null; // Use `data-message-id` for consistency

    // Function to fetch new messages
    function fetchNewMessages() {
        var receiverId = $('#receiver_id').val();

        $.ajax({
            url: '{{ url("accounts/chat/fetch-new-messages") }}',
            method: 'POST',
            data: {
                receiver_id: receiverId,
                last_message_id: lastMessageId, // Pass the last message ID
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.messageHtml) {
                    // Append new messages to the chat UI
                    $('#users-conversation').append(response.messageHtml);

                    // Update the lastMessageId to the latest message's ID from the response
                    lastMessageId = response.lastMessageId;

                    // Call this function after new messages are added
                    scrollToBottomMessage();

                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching new messages:", error);
            },
        });
    }

    // Poll for new messages every 5 seconds
    setInterval(fetchNewMessages, 5000);

    // Handle form submission
    $('#chatinput-form').on('submit', function (e) {
        e.preventDefault(); // Prevent form from submitting normally

        // Get the message content and receiver_id
        var messageContent = $('#chat-input').val();
        var receiverId = $('#receiver_id').val();

        if (messageContent.trim() === '') {
            alert("Please enter a message.");
            return;
        }

        // Send AJAX request to store the message
        $.ajax({
            url: '{{ url("accounts/chat/send") }}',
            method: 'POST',
            data: {
                receiver_id: receiverId,
                message: messageContent,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.messageHtml) {
                    // Append the new message's HTML to the chat UI
                    $('#users-conversation').append(response.messageHtml);

                    // Update the lastMessageId to the newly sent message's ID
                    lastMessageId = response.lastMessageId;
 
                    scrollToBottomMessage();
                    // Clear the input field
                    $('#chat-input').val('');
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error sending the message. Please try again.");
            },
        });
    });



   // Scroll to the bottom of the chat
   function scrollToBottomMessage(isPageLoad = false) {
      var chatList = $('#users-conversation');

      // Ensure the chatList element exists
      if (!chatList.length || !chatList[0].scrollHeight) {
         console.error("Chat container not found or scrollHeight is 0.");
         return;
      }

      // If it's a page load, use a slightly larger delay to ensure rendering is complete
      var delay = isPageLoad ? 200 : 50;

      // Debugging logs for troubleshooting
      console.log("ScrollHeight before scroll:", chatList[0].scrollHeight);
      console.log("ScrollTop before scroll:", chatList.scrollTop());

      chatList.stop().animate({ 
               scrollTop: chatList[0].scrollHeight + 10 // Add buffer for safety
         }, 500); // Smooth scrolling duration


      // Add a delay for DOM rendering before scrolling
      // setTimeout(function () {
      //    chatList.stop().animate({ 
      //          scrollTop: chatList[0].scrollHeight + 10 // Add buffer for safety
      //    }, 500); // Smooth scrolling duration

      //    // Debugging logs for confirmation
      //    console.log("ScrollHeight after scroll:", chatList[0].scrollHeight);
      //    console.log("ScrollTop after scroll:", chatList.scrollTop());
      // }, delay); // Delay to ensure DOM updates are complete
   }


 
  

});




</script>


@endsection