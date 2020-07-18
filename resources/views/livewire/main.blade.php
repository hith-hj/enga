<div id="wrapper">

    @livewire('sidenav')

    <div id="content-wrapper" class="d-flex flex-column">
        @livewire('topnav')
        <div id="content" style="flex: .6 0 auto !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-md-12 animated fadeIn scrol" >
                        @switch($type)
                            @case('body')
                                @livewire('body')
                                @break
                                
                            {{-- Chats starts --}}
                            @case('chats')
                                @livewire('chats')
                                @break
                            @case('messages')
                                @livewire('messages',['id'=>$params])
                                @break
                            {{-- Chat ends --}}
                            
                            {{-- finder Start --}}
                            @case('smartF')
                                @livewire('matcher',['type'=>'smart'])
                                @break    
                            @case('semiF')
                                @livewire('matcher',['type'=>'semi'])
                                @break    
                            @case('stockF')
                                @livewire('matcher',['type'=>'stock'])
                                @break    
                            @case('mixedF')
                                @livewire('matcher',['type'=>'mixed'])
                                @break    
                            {{-- finder Ends --}}    
                            
                            {{-- Matches starts --}}                    
                            @case('smartM')
                                @livewire('matches',['type'=>'smart'])
                                @break
                            @case('semiM')
                                @livewire('matches',['type'=>'semi'])
                                @break
                            @case('stockM')
                                @livewire('matches',['type'=>'stock'])
                                @break
                            @case('allM')
                                @livewire('matches',['type'=>'all'])
                                @break
                            {{-- Matches Ends --}}
        
                            {{-- Utitilities start --}}
                            @case('heart')
                                @livewire('utilities',['type'=>'heart'])
                                @break
                            @case('diamond')
                                @livewire('utilities',['type'=>'diamond'])
                                @break
                            @case('fire')
                                @livewire('utilities',['type'=>'fire'])
                                @break
                            @case('star')
                                @livewire('utilities',['type'=>'star'])
                                @break
                            @case('like')
                                @livewire('utilities',['type'=>'like'])
                                @break
                            @case('utilities')
                                @livewire('utilities',['type'=>'all'])
                                @break
                            {{-- Utitilities ends --}}
        
                            {{-- Reference Start --}}
                            @case('smartRef')
                                @livewire('reference',['type'=>'smart'])
                                @break
                            @case('semiRef')
                                @livewire('reference',['type'=>'semi'])
                                @break
                            @case('stockRef')
                                @livewire('reference',['type'=>'stock'])
                                @break

                            {{-- Questionnary --}}
                            @case('quests')
                                @livewire('quests')
                                @break
                            @case('questions')
                                @livewire('questions',['id'=>$params])
                                @break
                            {{-- End Questionnary --}}

                            {{-- profile --}}
                            @case('profile')
                                @livewire('profile',['id'=>$params])
                                @break
                            {{-- end profile --}}
                        @endswitch 
                    </div>                                   
                    @livewire('feedtool')
                </div>
            </div>
        </div>
        @livewire('footer')

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</div>
