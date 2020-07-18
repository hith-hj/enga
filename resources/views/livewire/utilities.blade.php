<div class="" style="min-height:50vh">
    <h4 style="margin-left: 2%;">{{ucfirst($type)}} utilitiest</h4>
    @forelse ($utliti as $utl)
    @php
        switch ($utl->type) {
            case 'heart':
                $icon = 'far fa-heart'; 
                break;
            case 'diamond':
                $icon = 'far fa-gem'; 
                break;
            case 'fire':
                $icon = 'fa fa-fire'; 
                break;
            case 'star':
                $icon = 'far fa-star'; 
                break;
            case 'like':
                $icon = 'far fa-thumbs-up'; 
                break;
            default:
                $icon = 'far fa-handshake info'; 
                break;
        }
        switch ($utl->responce) {
            case 'heart':
                $resIcon = 'far fa-heart'; 
                break;
            case 'diamond':
                $resIcon = 'far fa-gem'; 
                break;
            case 'fire':
                $resIcon = 'fa fa-fire'; 
                break;
            case 'star':
                $resIcon = 'far fa-star'; 
                break;
            case 'like':
                $resIcon = 'far fa-thumbs-up'; 
                break;
            default:
                $resIcon = 'far fa-handshake info'; 
                break;
        }
    @endphp
        @if($utl->by == 'me')
            <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}" wire:click.prefetch="setView('{{$utl->id}}')">            
                <div class="card shadow py-1" >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto mr-1">
                                <a href="../../storage/users_images/{{$utl->reciver->user_image}}" target="_blank">
                                    <img src="../../storage/users_images/{{$utl->reciver->user_image}}" style="width:60px; height:60px; border-radius:50px;">
                                </a>
                            </div>                                              
                            <div class="col">
                                <div class="text-md font-weight-bold text-uppercase">
                                    <div class="">  
                                        <i class="{{$icon}} fa-2x {{$utl->type}} "></i>
                                    </div>      
                                </div>                            
                                <div class="">  
                                    <span style="font-size: 12px;font-weight: 800"> No Response Yet</span>  
                                    <span class="respe" wire:click="cancelReq('{{$utl->id}}')"data-toggle="tooltip" title="Will be deleted">Cancel ??</span>
                                </div>
                                <div class="text-gray-800" style="font-size: 12px;">To <strong>{{$utl->reciver->name}}</strong> from you {{$utl->created_at->diffForHumans()}} | stat : {{$utl->status}}</div>
                            </div>                       
                        </div>
                    </div>
                </div>            
            </div>
        @else 
            <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}" >
                    {{-- wire:click.prefetch="setView('{{$utl->id}}')" --}}
                <div class="card shadow py-1" >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center"> 
                            <div class="col-auto mr-1">
                                <i class="{{$icon}} fa-3x {{$utl->type}} {{$utl->type == 'fire' ? 'mr-2 ml-2' : ''}}"></i>    
                            </div>                                             
                            <div class="col ">                           
                                <div class="h-100 dis-flex" > 
                                    <a class="m-1" href="../../storage/users_images/{{$utl->sender->user_image}}" target="_blank" style="text-decoration: none">
                                        <img src="../../storage/users_images/{{$utl->sender->user_image}}" style="width:60px;border-radius:50px;">
                                    </a>                                     
                                    <div class="h-100">
                                        <span class="text-lg text-gray-700 ml-2">{{ $utl->sender->name }}</span>
                                        @if($utl->status == 'waiting')
                                            <span class="dis-flex ml-2" style="margin-bottom: -5px;">
                                                <i class="{{$icon}} {{$utl->type}}"></i> 
                                                <i id="openFeel{{$utl->id}}" class="fa fa-chevron-right ml-1" onclick="
                                                    document.querySelector('#feeling'+{{$utl->id}}).style.display = 'block';
                                                    document.querySelector('#openFeel'+{{$utl->id}}).style.display = 'none'; 
                                                    document.querySelector('#closeFeel'+{{$utl->id}}).style.display = 'block';                                                                                           
                                                "></i>
                                                <i id="closeFeel{{$utl->id}}" class="fa fa-chevron-left ml-1" style="display:none;" onclick="
                                                    document.querySelector('#feeling'+{{$utl->id}}).style.display = 'none';
                                                    document.querySelector('#openFeel'+{{$utl->id}}).style.display = 'block';
                                                    document.querySelector('#closeFeel'+{{$utl->id}}).style.display = 'none';
                                                "></i>
                                            </span>                                            
                                        @else 
                                            <span class="dis-flex ml-2" style="margin-bottom: -5px;">
                                                <i class="{{$resIcon}} {{$utl->response}}"></i>  
                                            </span> 
                                        @endif
                                        <span class="text-gray-800 ml-2" style="font-size: 12px;">
                                            viewed - {{$utl->viewed == 0 ? 'No' : 'Yes' }} 
                                            | Send By {{$utl->by == 'me' ? 'Me' : $utl->sender->name }}
                                            {{$utl->created_at->diffForHumans()}} 
                                            | stat - {{$utl->status}} 
                                        </span>
                                    </div>
                                </div>
                                <div id="feeling{{$utl->id}}" class="animated slideInLeft feedBack">
                                    <div class="dis-flex" style="justify-content: space-between;padding:2%;">
                                        <i class="far fa-heart heart" wire:click="response('{{$utl->id}}', 'heart')"></i>
                                        <i class="far fa-gem diamond" wire:click="response('{{$utl->id}}', 'diamond')"></i>
                                        <i class="fa fa-fire fire" wire:click="response('{{$utl->id}}', 'fire')"></i>
                                        <i class="far fa-star star" wire:click="response('{{$utl->id}}', 'star')"></i>
                                        <i class="far fa-thumbs-up like" wire:click="response('{{$utl->id}}', 'like')"></i>
                                        <i class="far fa-handshake fa-md info" data-toggle="tooltip" title="Thank you" wire:click="response('{{$utl->id}}', 'thanks')"></i>
                                    </div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-600">Nothing found</div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endforelse 
</div>