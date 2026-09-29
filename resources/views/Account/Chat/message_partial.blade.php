@php 
    // Mark the message as read here 
    if($message->receiver_id == auth()->id() && !$message->is_read) {
        $message->is_read = 1;
        $message->save();
    }
@endphp 

<li class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2" id="message-{{ $message->id }}" data-message-id="{{ $message->id }}"> 
    <div class="d-flex align-items-end">
        <!-- Profile Picture (Only for received messages) -->
        @if ($message->sender_id != auth()->id())
            <img src="{{ $message->sender->getProfilePicture($message->sender->profile_picture) }}" 
                alt="Profile Picture" class="rounded-circle avatar-xs me-2">
        @endif

        <!-- Chat Message Box -->
        <div class="message-box {{ $message->sender_id == auth()->id() ? 'bg-light' : 'bg-light' }}">
            <p class="mb-1 ctext-content">{{ $message->message }}</p>
            <small class="text-muted d-block text-end">{{ $message->created_at->format('h:i A') }}</small>
            
            <!-- Read Receipt Icon -->
            {{-- @if ($message->is_read && $message->sender_id == auth()->id())
                <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
            @endif --}}
        </div>
    </div>
</li>



<style>

.message-box {
    min-width: 100%; /* Limit message width */
    padding: 10px 15px;
    border-radius: 10px;
 
}

.bg-primary {
    border-radius: 10px 10px 0 10px; /* Rounded for sent messages */
}

.bg-light {
    border-radius: 10px 10px 10px 0; /* Rounded for received messages */
}


</style>