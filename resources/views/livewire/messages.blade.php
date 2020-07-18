<div class="">
    <div class="chaty">
        <div class="chatHead">
            <div class="{{$online == true ? 'online' : '' }}">{{$user->name}}
                @if($typing == true)
                    <span class="ml-1 msg-date"><small>Typing...</small>  </span>
                @endif
            </div>          
            
        </div>
        <div class="chatBody" style="overflow-y:auto;max-height:70vh !important;scrollbar-width: thin;" id="msgs{{$chatId}}">
            @forelse ($msgs as $msg )
                @if($msg->user_id != Auth::user()->id)
                    <div class="lmsg" >
                        <div class="lmsg-content">                   
                            <span class="msg-date">{{$msg->created_at->format("H:m")}} </span>
                            {{$msg->message}}
                        </div>
                    </div>
                @else    
                    <div class="rmsg">
                        <div class="rmsg-content"> 
                            {{$msg->message}}
                            <span class="msg-date"> {{$msg->viewed == 2 ? '✓✓' : '✓' }} {{$msg->created_at->format("H:m")}}  </span>
                        </div>
                    </div>
                @endif
            @empty    
                <div class="rmsg">
                    <div class="rmsg-content"> 
                        no messages here
                    </div>
                </div>        
            @endforelse
        </div>
        <div class="chatInput">            
            <input type="text" class="chat-input" placeholder="----" wire:model="content" wire:keydown.enter="sendMsg({{$chatId}})">
            <i class="fa fa-paper-plane chat-send" wire:click="sendMsg('{{$chatId}}')"></i>            
        </div>
    </div>
</div>
