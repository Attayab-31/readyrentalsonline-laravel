<div class="col-xxl-4">
   <div class="card">
       <div class="card-header align-items-center d-flex">
           <h4 class="card-title mb-0 flex-grow-1">Chats</h4>
           {{-- <div class="flex-shrink-0">
               <div>
                   <button type="button" class="btn btn-soft-primary btn-sm">*</button>
               </div>
           </div> --}}
       </div>
       <div class="card-body">
           <div class="table-responsive table-card">
               <div data-simplebar style="max-height: 405px;">
                   <table class="table table-borderless align-middle">
                       <tbody>
                           @foreach($threadList as $thread) 

                              @php 
                                 $unreadMessagesCount = App\Models\Message::UnReadMessageCount(Auth::user()->id, $thread->id);
                              @endphp 

                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                          <a href="{{url('accounts/chat/messages/'.$thread->unique_identifier)}}">
                                             <img src="{{ $thread->getProfilePicture($thread->profile_picture) }}" alt="" class="avatar-sm rounded-circle">
                                          </a>
                                          <div class="ms-3">
                                             <a href="{{url('accounts/chat/messages/'.$thread->unique_identifier)}}">
                                                <h6 class="fs-12 mb-1">{{$thread->first_name.' '.$thread->last_name}} </h6>
                                             </a>
                                             @if($thread->user_type == "superAdmin" || $thread->user_type == "admin")
                                                <span class="badge bg-success">Manager</span>
                                             @endif
                                          </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div id="mini-chart-1" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                 </td>
                                 <td class="text-end">
                                    @if($unreadMessagesCount > 0)
                                       <div class="ms-auto"><span class="badge bg-danger rounded p-1">{{$unreadMessagesCount}}</span></div>
                                    @endif
                                 </td>
                              </tr>
 
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
</div><!--end col-->

 