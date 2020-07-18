<div class="" >
    <h4 style="margin-left: 2%;">{{ucfirst($type)}} matches</h4>
    @forelse ($matches as $mat)
        @php
            switch ($type) {
                case 'smart':
                    $icon = 'fa fa-fingerprint';
                    break;
                case 'semi':
                    $icon = 'fa fa-barcode';
                    break;
                case 'stock':
                    $icon = 'fa fa-grip-lines-vertical';
                    break;
                case 'all':
                    $icon = 'far fa-circle';
                    break;
            }
        @endphp
        @if($mat->by == 'me')
            <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}">            
                <div class="card {{$mat->status == 'accepted' ? 'border-left-success' : ''}}
                    {{$mat->status == 'rejected' ? 'border-left-danger' : ''}}
                    {{$mat->status == 'waiting' ? 'border-left-primary' : ''}}
                    shadow py-1" >
                    <div class="card-body">                        
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto mr-1">                                
                                <a href="../../storage/users_images/{{$mat->second->user_image}}" target="_blank">
                                    <img src="../../storage/users_images/{{$mat->second->user_image}}" style="width:110px;border-radius:15px;">
                                </a>
                            </div>
                            <div class="col">
                                <div class="text-md font-weight-bold text-gray-800">
                                    Match to {{strToUpper($mat->second->name)}} from You</div>
                                <div class="h6 mb-0 text-gray-800">Rank :{{$mat->matchRank}}%</div>
                                <div class="inter">
                                    @switch($mat->status)
                                        @case('waiting')
                                            <div class="animated fadeIn">
                                                <span style="font-size:12px;" data-toggle="tooltip" title="we are Waiting together">
                                                    No Responce Yet <i class="fa fa-cog fa-spin"></i></span>
                                                <span data-toggle="tooltip" title="Cancel your request" class="text-danger text-md-center respe "
                                                wire:click="cancelMatch('{{$mat->id}}', '{{$mat->second_id}}','delete')">Cancle !!</span> 
                                            </div>                                            
                                            @break
                                        @case('accepted')
                                            <span style="font-size:12px;" class="text-success" data-toggle="tooltip" title="good for you">
                                                Matched &check;</span>
                                            @if($mat->chatable == true)
                                            <span style="font-size:12px; cursor: pointer;" class="text-gray-600 font-weight-bold" wire:click="startChat('{{$mat->second->id}}', '{{$mat->id}}')" data-toggle="tooltip" title="good for you">
                                                Start Chat <i class="fa fa-comment ml-1"></i></span> 
                                            @endif                                              
                                                <br>
                                            @break
                                        @case('rejected')
                                            <span style="font-size:12px;" class="text-danger" data-toggle="tooltip" title="sorry">
                                                Not Matched &check;</span><br>
                                            @break
                                        @default                                            
                                    @endswitch
                                    <span style="font-size:12px;">created {{$mat->created_at->diffForHumans()}} 
                                        using <i class="{{$icon}} fa-lg ml-1"></i></span>
                                </div>
                            </div>
                            <div class="col-auto float-right">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v fa-sm fa-fw fa-lg text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="top-end" 
                                    style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(-175px, -40px, 0px);">
                                      <a class="dropdown-item" href="#">Action</a>
                                      <a class="dropdown-item" href="#">Another action</a>
                                      <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>    
                            </div>                       
                        </div>
                    </div>
                </div>            
            </div>
        @else 
            <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}">            
                <div class="card {{$mat->status == 'accepted' ? 'border-left-success' : ''}}
                                {{$mat->status == 'rejected' ? 'border-left-danger' : ''}}
                                {{$mat->status == 'waiting' ? 'border-left-primary' : ''}}
                    shadow py-1" >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto mr-1">                                
                                <a href="../../storage/users_images/{{$mat->first->user_image}}" target="_blank">
                                    <img src="../../storage/users_images/{{$mat->first->user_image}}" style="width:110px;border-radius:15px;">
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="text-md font-weight-bold text-gray-800">
                                    Match to you from {{strToUpper($mat->first->name)}}</div>
                                <div class="h6 mb-0 text-gray-800">Rank :{{$mat->matchRank}}%</div>
                                <div class="inter">
                                    @switch($mat->status)
                                        @case('waiting')
                                            <div class="animated fadeIn">
                                                <span style="font-size:12px;" data-toggle="tooltip" title="your Match request are send">
                                                    Waiting U <i class="fa fa-cog fa-spin"></i></span>

                                                <span  data-toggle="tooltip" title="Accept the match" class="text-success text-md-center respe"
                                                wire:click="acceptMatch('{{$mat->id}}', '{{$mat->user_id}}')">Accept &check;</span>

                                                <span data-toggle="tooltip" title="Cancel your request" class="text-danger text-md-center respe "
                                                wire:click="cancelMatch('{{$mat->id}}', '{{$mat->user_id}}')">Cancle !!</span> 
                                            </div>                                            
                                            @break
                                        @case('accepted')
                                            <span style="font-size:12px;" class="text-success" data-toggle="tooltip" title="good for you">
                                                Matched &check;</span>
                                                @if($mat->chatable == true)
                                                <span style="font-size:12px; cursor: pointer;" class="text-gray-600 font-weight-bold" wire:click="startChat('{{$mat->second->id}}', '{{$mat->id}}')" data-toggle="tooltip" title="good for you">
                                                    Start Chat <i class="fa fa-comment ml-1"></i></span> 
                                                @endif 
                                                <br>
                                            @break
                                        @case('rejected')
                                            <span style="font-size:12px;" class="text-danger" data-toggle="tooltip" title="sorry">
                                                Not Matched &check;</span><br>
                                            @break
                                        @default                                            
                                    @endswitch
                                    <span style="font-size:12px;">created {{$mat->created_at->diffForHumans()}} 
                                        using <i class="{{$icon}} fa-lg ml-1"></i></span> 
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>            
            </div>
        @endif
    @empty
    <div class="col-xl-12 col-md-12 mb-1">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary  mb-1">Sorry</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-600">No result found</div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endforelse 
</div>