<div class="{{ $columnClass ?? 'col-12 col-lg-4 col-xxl-3 chat-conversation-sidebar' }} chat-conversation-column">
    <section class="card chat-conversation-card h-100" aria-labelledby="conversation-heading">
        <div class="card-header d-flex align-items-center justify-content-between gap-2">
            <h2 class="card-title mb-0" id="conversation-heading">Conversations</h2>
            <span class="badge bg-primary flex-shrink-0">
                {{ count($threadList) }} Active
            </span>
        </div>

        @if(count($threadList))
            <nav class="chat-conversation-list" aria-label="Conversations">
                @foreach($threadList as $thread)
                    @php
                        $unreadMessagesCount = App\Models\Message::UnReadMessageCount(Auth::user()->id, $thread->id);
                        $isActiveThread = isset($user) && $user->id == $thread->id;
                        $threadName = trim($thread->first_name . ' ' . $thread->last_name);
                    @endphp

                    <a
                        href="{{ url('accounts/chat/messages/'.$thread->unique_identifier) }}"
                        class="chat-conversation-item {{ $isActiveThread ? 'is-active' : '' }}"
                        @if($isActiveThread) aria-current="page" @endif
                    >
                        <img
                            src="{{ $thread->getProfilePicture($thread->profile_picture) }}"
                            alt=""
                            class="chat-conversation-avatar"
                            loading="lazy"
                        >

                        <span class="chat-conversation-person">
                            <span class="chat-conversation-name">{{ $threadName }}</span>
                            <span class="chat-conversation-meta">
                                @if($thread->user_type == 'superAdmin')
                                    <span class="badge bg-primary">Super Admin</span>
                                @elseif($thread->user_type == 'admin')
                                    <span class="badge bg-info">Manager</span>
                                @else
                                    <span class="badge bg-secondary">Tenant</span>
                                @endif
                                <span class="chat-conversation-email">{{ $thread->email }}</span>
                            </span>
                        </span>

                        <span class="chat-conversation-indicator">
                            @if($unreadMessagesCount > 0)
                                <span class="badge bg-danger rounded-pill">{{ $unreadMessagesCount }} new</span>
                            @else
                                <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
                            @endif
                        </span>
                    </a>
                @endforeach
            </nav>
        @else
            <div class="chat-conversation-empty" role="status">
                <i class="ri-chat-3-line" aria-hidden="true"></i>
                <p class="mb-0">No conversations yet.</p>
            </div>
        @endif
    </section>
</div>
