<div>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-comments fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">{{count($msgs) > 0 ? count($msgs) : ''}}{{count($msgs) == 10 ? '+' : ''}}</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                    aria-labelledby="messagesDropdown" style="overflow-y: auto;max-height:40vh;scrollbar-width:none;">
                    <h6 class="dropdown-header">
                        Messages
                    </h6>
                    @forelse ($msgs as $msg)
                        <a class="dropdown-item d-flex align-items-center" wire:click="$emitTo('main', 'changeBody', 'chats')">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="../../storage/users_images/{{$msg->user->user_image}}" alt="">
                                {{-- <div class="status-indicator bg-success"></div> --}}
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-gray-700">{{$msg->message}}
                                </div>
                                <div class="small text-gray-600">{{$msg->user->name}} · {{$msg->created_at->format('h:m')}}</div>
                            </div>
                        </a>
                    @empty
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="font-weight-bold">
                                <div class="text-truncate">No New Msgs</div>
                            </div>
                        </a>
                    @endforelse
                    
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" wire:click="" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">{{count($notis) > 0 ? count($notis) : ''}}{{count($notis) == 10 ? '+':''}}</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="overflow-y: auto;max-height:40vh;">
                    <h6 class="dropdown-header">
                        Notification
                    </h6>
                    @forelse ($notis as $noti)
                        <a class="dropdown-item d-flex align-items-center" href="#" wire:click.prefetch="setViewed('{{$noti->id}}', 'noti')">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-gray-800">{{$noti->user->name}}
                                    <div class="small text-gray-500">{{$noti->created_at->format('D H:m')}}</div>
                                </div>
                                <span class="font-weight-light">
                                    {{$noti->type}}
                                    <span class="font-weight-bold">{{$noti->content}}</span>
                                </span>
                            </div>
                        </a>
                    @empty   
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>No new notification </div>
                        </a>
                    @endforelse 
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-language fa-fw"></i> </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                    aria-labelledby="messagesDropdown" style="overflow-y: auto;max-height:40vh;scrollbar-width:none;">
                    <span> <a class="dropdown-item {{App::getLocale() == 'ar' ? 'active' : ''}}" href="/setLang/ar">Arabic</a></span>
                    <span> <a class="dropdown-item {{App::getLocale() == 'en' ? 'active' : ''}}" href="/setLang/en">English</a></span>                    
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                    <img class="img-profile rounded-circle" src="{{asset('/uploads/users_images/'.Auth::user()->user_image)}}" alt="{{Auth::user()->name}} image">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" wire:click="$emitTo('main', 'changeBody', ['profile','{{Auth::id()}}'])">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                    </a>
                    {{--<a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                    </a>
                     <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log 
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                    </a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>

        </ul>

    </nav>
</div>
