@extends('layouts.accounts')

@section("styles")
<style>
/* Ensure the chat area has a scrollable height */
 

.chat-messages {
        max-height: 400px !important; /* Fixed height for messages container */
        overflow-y: auto !important; /* Enables vertical scrolling */
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
    }

/* Style for message bubbles */
.bg-light-green {
    background-color: #d1e7dd !important; /* Light green */
}

.bg-light-red {
    background-color: #f8d7da !important; /* Light red */
}
</style>
@endsection

@section('content')
 
    <div class="row">
        <!-- Sidebar (Thread List) -->
        @include('Account.Chat.threadList', ['threadList' => $db_data['threadList']])

        <!-- Chat Section -->
        <div class="col-12 col-lg-8">


            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">
                        
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0);" class="me-3 d-block d-lg-none fs-4">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                            <img src="{{ $user->getProfilePicture($user->profile_picture) }}" class="rounded-circle me-2" width="40" height="40" alt="">
                            <div>
                                <h5 class="mb-0">{{ $user->first_name . ' ' . $user->last_name }}</h5>
                                {{-- <p class="text-muted small mb-0">Online</p> --}}
                            </div>
                        </div>

                    </h4>
                    <div class="flex-shrink-0">
                        <div>
                            @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                            <a href="{{ url('accounts/chat/delete_converstaion/'.$user->unique_identifier) }}" onclick="confirm_soft_delete(event)" class="btn btn-sm btn-danger">
                                Delete Conversation
                            </a>


                            <a href="{{ url('accounts/chat/print_converstaion/'.$user->unique_identifier) }}" class="btn btn-sm btn-primary">
                                Print Conversation
                            </a>

                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
 
                    <!-- Chat Messages -->
                    <div class="p-3 chat-messagses flex-grow-1 " id="chat-conversation"  style="height: 300px;overflow:scroll;overflow-x: hidden;">
                        <ul class="list-unstyled mb-0" id="users-conversation">
                            @foreach ($db_data['messages'] as $message)
                                @include('Account.Chat.message_partial', ['message' => $message])
                            @endforeach
                        </ul>
                    </div>

                    <!-- Chat Input -->
                    <div class="p-3 border-top">
                        <form id="chatinput-form">
                            <div class="input-group">
                                <input type="text" class="form-control" id="chat-input" placeholder="Type your message..." autocomplete="off">
                                <button type="submit" class="btn btn-success">
                                    <i class="ri-send-plane-2-fill"></i>
                                </button>
                            </div>
                            <input type="hidden" id="receiver_id" value="{{ $user->unique_identifier }}">
                        </form>
                    </div>


                </div>
            </div>
  
        </div>
    </div>
 

@endsection

@section("scripts")

<script>
$(document).ready(function () {
    function scrollToBottomMessage(force = false) {
        var chatList = $('#chat-conversation');
        if (chatList.length) {
            chatList.stop().animate({
                scrollTop: chatList[0].scrollHeight
            }, force ? 0 : 500); // Instant scroll on page load, smooth scroll otherwise
        }
        else {
            console.error("Chat conversation container not found.");
        }
    }

    // Scroll to the bottom when the page loads
    setTimeout(() => {
        scrollToBottomMessage(true);
    }, 500); // Give it some time to render properly

    // let lastMessageId = $('#users-conversation li:last-child').data('message-id') || null;
    let lastMessageId = $('#users-conversation li').last().data('message-id') || null;
    // alert(lastMessageId);


    function fetchNewMessages() {
        var receiverId = $('#receiver_id').val();
        
        $.ajax({
            url: '{{ url("accounts/chat/fetch-new-messages") }}',
            method: 'POST',
            data: {
                receiver_id: receiverId,
                last_message_id: lastMessageId,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.messageHtml) {
                    $('#users-conversation').append(response.messageHtml);
                    lastMessageId = response.lastMessageId;
                    scrollToBottomMessage(true); // Scroll immediately after appending new messages
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching new messages:", error);
            },
        });
    }

    setInterval(fetchNewMessages, 5000);

    $('#chatinput-form').on('submit', function (e) {
        e.preventDefault();

        var messageContent = $('#chat-input').val();
        var receiverId = $('#receiver_id').val();

        if (messageContent.trim() === '') {
            alert("Please enter a message.");
            return;
        }

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
                    $('#users-conversation').append(response.messageHtml);
                    lastMessageId = response.lastMessageId;
                    $('#chat-input').val('');
                    scrollToBottomMessage(true); // Scroll immediately after appending new messages
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error sending the message. Please try again.");
            },
        });
    });
});
</script>

@endsection
