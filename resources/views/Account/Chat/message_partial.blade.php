@php 
    // Mark the message as read here 
    if($message->receiver_id == auth()->id() && !$message->is_read) {
        $message->is_read = 1;
        $message->save();
    }
@endphp 

<li class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2 chat-message-row" id="message-{{ $message->id }}" data-message-id="{{ $message->id }}"> 
    <div class="d-flex align-items-end chat-message-content">
        <!-- Profile Picture (Only for received messages) -->
        @if ($message->sender_id != auth()->id())
            <img src="{{ $message->sender->getProfilePicture($message->sender->profile_picture) }}" 
                alt="{{ $message->sender->first_name }}" class="rounded-circle avatar-xs me-2 mb-1">
        @endif

        <!-- Chat Message Box -->
        <div class="message-box">
            <p class="mb-1 ctext-content">{{ $message->message }}</p>
            <small class="d-block text-end opacity-75 fs-11">{{ $message->created_at->format('h:i A') }}</small>
        </div>
    </div>
</li>