<div class="chat-leftsidebar">
    <div class="px-4 pt-4 ">
       <div class="d-flex align-items-start">
          <div class="flex-grow-1">
             <h5 class="">Chats</h5>
          </div>
       </div>
    </div>
    <!-- .p-4 -->
 
    <div class="tab-content text-muted">
       <div class="tab-pane active" id="chats" role="tabpanel">
          <div class="chat-room-list  simplebar-scrollable-y" data-simplebar="init">
             <div class="simplebar-wrapper" style="margin: -16px 0px 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                   <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                   <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                      <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                         <div class="simplebar-content" style="padding: 16px 0px 0px;">
 
                            <div class="chat-message-list">
                               <ul class="list-unstyled chat-list chat-user-list" id="userList">
                                    
                                    @foreach($threadList as $thread) 

                                       @php 
                                          $unreadMessagesCount = App\Models\Message::UnReadMessageCount(Auth::user()->id, $thread->id);
                                       @endphp 

                                       <li id="{{$thread->unique_identifier}}" class="activessssssss">
                                          <a href="{{url('accounts/chat/messages/'.$thread->unique_identifier)}}">
                                             <div class="d-flex align-items-center">
                                                   <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                                      <div class="avatar-xxs">
                                                         <img src="{{ $thread->getProfilePicture($thread->profile_picture) }}" class="rounded-circle img-fluid userprofile" alt=""><span class="user-status"></span>
                                                      </div>
                                                   </div>
                                                   <div class="flex-grow-1 overflow-hidden">
                                                      <p class="text-truncate mb-0">
                                                         {{$thread->first_name.' '.$thread->last_name}} 
                                                         @if($thread->user_type == "superAdmin" || $thread->user_type == "admin")
                                                            <span class="badge bg-success">Manager</span>
                                                         @endif
                                                      </p>
                                                      {{-- <small style="text-muted">Address of the Property Here</small> --}}
                                                   </div>
                                                   @if($unreadMessagesCount > 0)
                                                      <div class="ms-auto"><span class="badge bg-danger rounded p-1">{{$unreadMessagesCount}}</span></div>
                                                   @endif
                                             </div>
                                          </a>
                                       </li>
                                    @endforeach
                               </ul>
                            </div>

                            <!-- End chat-message-list -->
                         </div>
                      </div>
                   </div>
                </div>
                <div class="simplebar-placeholder" style="width: 300px; height: 650px;"></div>
             </div>
             <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
             </div>
             <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
             </div>
          </div>
       </div>

    </div>
    <!-- end tab contact -->
 </div>
 <!-- end chat leftsidebar -->