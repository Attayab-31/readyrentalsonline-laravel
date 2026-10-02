@extends('layouts.accounts')

@section("styles")
<style>
/* Ensure the chat area has a scrollable height */
 

.chat-messages {
    max-height: 400px !important;
    overflow-y: auto !important;
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
 
    <div class="row g-3 chat-thread-layout">
        <!-- Sidebar (Thread List) -->
        @include('Account.Chat.threadList', [
            'threadList' => $db_data['threadList'],
            'columnClass' => 'col-12 col-lg-4 col-xxl-3 chat-conversation-sidebar',
        ])

        <!-- Chat Section -->
        <div class="col-12 col-lg-8 col-xxl-9 chat-thread-panel">


            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="card-title mb-0 flex-grow-1">
                        <div class="d-flex align-items-center min-w-0">
                            <a href="{{ url('accounts/chat') }}" class="me-2 d-block d-lg-none btn btn-sm btn-light chat-back-link" aria-label="Back to conversations" title="Back to conversations">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                            <img src="{{ $user->getProfilePicture($user->profile_picture) }}" class="rounded-circle me-2 flex-shrink-0" width="40" height="40" alt="">
                            <div class="chat-recipient min-w-0">
                                <h5 class="mb-0 text-truncate">{{ $user->first_name . ' ' . $user->last_name }}</h5>
                                {{-- <p class="text-muted small mb-0">Online</p> --}}
                            </div>
                        </div>

                    </div>
                    <div class="flex-shrink-0 chat-conversation-panel-actions">
                        <div>
                            @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                            <form method="post" action="{{ url('accounts/chat/delete_converstaion/'.$user->unique_identifier) }}" class="d-inline js-delete-conversation-form">@csrf
                                <button type="submit" class="btn btn-sm btn-danger">Delete Conversation</button>
                            </form>


                            <a href="{{ url('accounts/chat/print_converstaion/'.$user->unique_identifier) }}" class="btn btn-sm btn-primary">
                                Print Conversation
                            </a>

                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
 
                    <!-- Chat Messages -->
                    <div class="p-3 chat-messagses flex-grow-1" id="chat-conversation" style="height: 300px; overflow-y: auto; overflow-x: hidden;">
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
                                <button type="submit" class="btn btn-primary">
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
    let lastMessageId = $('#users-conversation li').last().data('message-id') || 0;
    let isSendingMessage = false;

    function appendMessagesOnce(messageHtml) {
        if (!messageHtml) return;

        $(messageHtml).each(function () {
            var messageId = this.getAttribute && this.getAttribute('data-message-id');
            if (messageId && document.getElementById('message-' + messageId)) return;
            $('#users-conversation').append(this);
        });
    }
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
                    appendMessagesOnce(response.messageHtml);
                    lastMessageId = Math.max(lastMessageId, Number(response.lastMessageId) || 0);
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

        if (isSendingMessage) return;

        var messageContent = $('#chat-input').val();
        var receiverId = $('#receiver_id').val();
        var sendButton = this.querySelector('button[type="submit"]');

        if (messageContent.trim() === '') {
            alert("Please enter a message.");
            return;
        }

        isSendingMessage = true;
        RRButtonLoading.start(sendButton, 'Sending…');

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
                    appendMessagesOnce(response.messageHtml);
                    lastMessageId = Math.max(lastMessageId, Number(response.lastMessageId) || 0);
                    $('#chat-input').val('');
                    scrollToBottomMessage(true); // Scroll immediately after appending new messages
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error sending the message. Please try again.");
            },
            complete: function () {
                RRButtonLoading.stop(sendButton);
                isSendingMessage = false;
            },
        });
    });
});
</script>

<script>
document.addEventListener('submit', function (event) {
    var form = event.target.closest('.js-delete-conversation-form');
    if (!form) return;

    event.preventDefault();
    if (form.dataset.confirming === 'true') return;

    Swal.fire({
        title: 'Delete this conversation?',
        text: 'All messages in this conversation will be permanently removed.',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        focusCancel: true,
        buttonsStyling: false,
        confirmButtonText: 'Delete conversation',
        cancelButtonText: 'Keep conversation',
        customClass: {
            popup: 'rr-confirm-dialog',
            title: 'rr-confirm-title',
            htmlContainer: 'rr-confirm-message',
            confirmButton: 'btn btn-danger fw-semibold px-3',
            cancelButton: 'btn btn-light fw-semibold px-3 me-2'
        }
    }).then(function (result) {
        if (result.isConfirmed || result.value) {
            form.dataset.confirming = 'true';
            form.submit();
        }
    });
});
</script>
@endsection