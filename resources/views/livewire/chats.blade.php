<div class="">
    @forelse ($chats as $chat)
        @php
            if($chat->by == 'me'){
                $image = $chat->second->user_image;
                $name = $chat->second->name;
            }else{
                $image = $chat->first->user_image;
                $name = $chat->first->name;
            }
        @endphp
        <div class="col-xl-12 col-md-12 mb-2 {{$loop->first ? 'mt-3' : ''}}
        {{$chat->msg != Null && $chat->msg->user_id != Auth::user()->id && $chat->msg->viewed < 2 ? 'new-msgs animated pulse' : ''}}" 
        wire:click="$emitTo('main', 'changeBody', ['messages','{{$chat->id}}'])"
        wire:key="{{$loop->index}}" >            
            <div class="card shadow" wire:click="$emitTo('sidenav', 'resetVars', 'chat');">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-1" >
                            <a href="../../storage/users_images/{{$image}}" target="_blank">
                                <img src="../../storage/users_images/{{$image}}" style="height:100px;width:100px;border-radius:10px;">
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg font-weight-bold ">{{$name}}</div>
                            <div class="h6 mb-0 text-gray-800">{{$chat->msg != Null ? $chat->msg->message : 'no messages'}}</div>
                            <div name="ineract">
                                <small>{{$chat->msgsCount}} msgs | stat: {{$chat->status}}</small>
                            </div>
                        </div>
                        <div class="col" style="text-align: end;">
                            @if($chat->msg != Null)
                                <h6>
                                    {{$chat->msg->user_id == Auth::user()->id ? $chat->msg->viewed == 2 ? '✓✓' : '✓' : '' }}
                                    {{$chat->msg->created_at->format('H:m')}}
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    @empty
    <div class="col-xl-12 col-md-12 mb-1">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary  mb-1">Sorry</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-600">No Chats</div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endforelse
</div>
