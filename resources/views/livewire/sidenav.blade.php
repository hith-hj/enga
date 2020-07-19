<div>
    @php
        switch ($utilNoti) {
            case 'heart':
                $icon = 'far fa-heart heart ';
                break;
            case 'diamond':
                $icon = 'far fa-gem diamond ';
                break;
            case 'fire':
                $icon = 'fa fa-fire fire ';
                break;
            case 'star':
                $icon = 'far fa-star star ';
                break;
            case 'like':
                $icon = 'far fa-thumbs-up like ';
                break;
            default:
                # code...
                break;
        }

        switch ($matchNoti) {
            case 'smart':
                $matchIcon = 'fa fa-fingerprint';
                break;
            case 'semi':
                $matchIcon = 'fa fa-barcode';
                break;
            case 'stock':
                $matchIcon = 'fa fa-grip-lines-vertical';
                break;
            default:
                $matchIcon = '';
            break;
        }
    @endphp
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Enga <sup>2020</sup> <div wire:loading> <i class="fa fa-spinner fa-pulse"></i> </div></div>
            
        </a>
        {{--  --}}
        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <span class="nav-link" wire:click="$emitTo('main', 'changeBody', 'body')">
                <i class="fas fa-fw fa-h-square"></i>
                <span>{{__('lang.Home')}}</span>
            </span>
        </li>

        <hr class="sidebar-divider">


        {{-- <li class="nav-item active">
            <span class="nav-link collapsed" >
                <button class="findbtn">Find</button>
            </span>    
        </li> --}}

        <div class="sidebar-heading">
            Main
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#findCollapse" >
                <i class="fa fa-fw fa-search fa-lg"></i>
                <span >{{__('lang.Find')}}</span>
            </a>
            <div id="findCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Find By : </h6>
                    <span class="collapse-item " wire:click="$emitTo('main', 'changeBody', 'smartF')" ><i class="mr-1 fa fa-fw fa-fingerprint"></i>Smart Ref</span>
                    <span class="collapse-item " wire:click="$emitTo('main', 'changeBody', 'semiF')" ><i class="mr-1 fa fa-fw fa-barcode"></i>Semi Ref</span>
                    <span class="collapse-item " wire:click="$emitTo('main', 'changeBody', 'stockF')" ><i class="mr-1 fa fa-fw fa-grip-lines-vertical"></i>Stock Ref</span>
                    <span class="collapse-item " wire:click="$emitTo('main', 'changeBody', 'mixedF')" ><i class="mr-1 far fa-fw fa-circle"></i>Mixed Ref</span>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" >
                <i class="fas fa-fw fa-fingerprint fa-lg"></i>
                <span >{{__('lang.Matches')}}
                    @if($matchNoti == true)
                        {{-- <i class="fa fa-circle {{$matchStat == 'Accepted' ? 'like' : 'ban'}} fa-xs"></i> --}}
                        <i class=" {{$matchIcon}} {{$matchStat == 'Accepted' ? 'like' : 'ban'}} fa-md"></i>
                    @endif
                </span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">My</h6>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'smartM')"><i class="mr-1 fas fa-fw fa-fingerprint"></i>Smart Match</span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'semiM')"><i class="mr-1 fas fa-fw fa-barcode"></i>Semi Match</span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'stockM')"><i class="mr-1 fas fa-fw fa-grip-lines-vertical"></i>Stock Match</span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'allM')"><i class="mr-1 far fa-fw fa-circle"></i>All Matchs</span>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" wire:click="$emitTo('main', 'changeBody', 'chats')"
                data-toggle="collapse" data-target="#collapseChats" >
                <i class="fas fa-fw fa-comments"></i>
                <span wire:click="$set('chatNoti', false)">{{__('lang.Chats')}}
                    @if($chatNoti == true)
                        <i class="ml-2 fa fa-circle ban fa-xs"></i>
                    @endif
                </span>
            </a>            
        </li>

        <li class="nav-item">
            <a wire:click="" class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" >
                <i class="fas fa-fw fa-cog"></i>
                <span >{{__('lang.Utilities')}} 
                    @if($utilNoti !== '')
                        <i class=" {{$icon}} fa-lg"></i>
                    @endif
                </span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'utilities')"><i class="mr-1 far fa-circle info"></i>
                         Every Thing 
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'heart')"><i class="mr-1 far fa-heart heart"></i>
                        Hearts 
                        <span >
                            @if($utilNoti == 'heart')
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'diamond')"><i class="mr-1 far fa-gem diamond"></i>
                        Diamonds 
                        <span >
                            @if($utilNoti == 'diamond')
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'fire')"><i class="mr-1 fa fa-fire fire "></i>
                        Fires 
                        <span >
                            @if($utilNoti == 'fire')
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'star')"><i class="mr-1 far fa-star star "></i>
                        Stars 
                        <span >
                            @if($utilNoti == 'star')
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'like')"><i class="mr-1 far fa-thumbs-up like"></i>
                        Likes 
                        <span >
                            @if($utilNoti == 'like')
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>                           
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Details
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRefs" >
                <i class="fa fa-fw fa-align-left"></i>
                <span>{{__('lang.Reference')}}
                    @if(Auth::user()->isFull() == false )
                        <i class="ml-2 fa fa-circle ban fa-xs"></i>
                    @endif
                </span>
            </a>
            <div id="collapseRefs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">My:</h6>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'smartRef')">
                      <i class="mr-1 fa fa-fw fa-fingerprint"></i>
                        <span>Smart references
                            @if(Auth::user()->rank(Auth::user()->id,'smartRank') == 0 || Auth::user()->rank(Auth::user()->id,'smartSum') == 0)
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'semiRef')">
                        <i class="mr-1 fa fa-fw fa-barcode"></i>
                        <span>Semi references
                            @if(Auth::user()->rank(Auth::user()->id,'semiRank') == 0 || Auth::user()->rank(Auth::user()->id,'semiSum') == 0)
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                    <span class="collapse-item" wire:click="$emitTo('main', 'changeBody', 'stockRef')">
                        <i class="mr-1 fa fa-fw fa-grip-lines-vertical"></i>
                        <span>Stock references
                            @if(Auth::user()->rank(Auth::user()->id,'stockRank') == 0 || Auth::user()->rank(Auth::user()->id,'stockSum') == 0)
                                <i class="ml-2 fa fa-circle ban fa-xs"></i>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </li> 
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>Profile</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">My:</h6>
                    <a class="collapse-item" href=""> <i class="mr-1 far fa-eye"></i> View</a>
                    <div class="collapse-divider"></div>
                    <a class="collapse-item" href=""> <i class="mr-1 far fa-edit"></i> Edit</a>
                </div>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExtra" aria-expanded="true" aria-controls="collapseExtra">
                <i class="fa fa-fw fa-link"></i>
                <span>{{__('lang.Extra')}}</span>
            </a>
            <div id="collapseExtra" class="collapse" aria-labelledby="headingExtra" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded" wire:click="$emitTo('main', 'changeBody', 'quests')">
                    <h6 class="collapse-header">My:</h6>
                    <a class="collapse-item text-bold" > <i class="mr-1 fas fa-file-alt fa-fw" style="color:#999;"></i> Questionnary</a>
                    {{-- href="{{route('Questionnary')}}" --}}
                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
</div>