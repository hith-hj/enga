<div class="" >
    @php 
        $R = $type.'Rank';
        $S = $type.'Sum';
    @endphp
    @if($noGen == true)
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <a class="d-block card-header py-3" role="button" aria-expanded="true" aria-controls="collapseCardExample" href="#collapseCardExample" data-toggle="collapse">
                <h4 class="m-0 font-weight-bold text-primary">{{strToUpper($type)}} Reference</h4>
                </a>
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        @php
                            $stack = Auth::user()->rank(Auth::user()->id,$R);
                            $sum = Auth::user()->rank(Auth::user()->id,$S);
                        @endphp
                        @if( $stack == 0 && $sum == 0)
                            @if($type != 'stock')
                                <h5>Yet you don't have {{$type}} Rank</h5>
                                <h6>You can build one <strong wire:click="$emitSelf('Rank', '{{$type}}')" class="no-st" 
                                    onmouseover="event.target.style.color='blue'"
                                    onmouseout="event.target.style.color='#777'" 
                                    style="cursor: pointer">Generate Rank</strong></h6>
                                    <div wire:loading> <i class="fa fa-spinner fa-spin"></i> </div>
                                @else 
                                <h5>Yet you don't have {{$type}} Rank</h5>
                                <a href="{{route('stockRef')}}" class="no-st">build New</a></h6>
                            @endif
                        @else 
                            {{-- <h5>Your {{$type}} Rank is <strong class="badge badge-success">{{Auth::user()->$R}}</strong></h5> --}}
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="row row-space">
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Height', $stack[0], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Weight', $stack[1], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Skin Color', $stack[2], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Eyes Color', $stack[3], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Hair Length', $stack[4], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Hair Color', $stack[5], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Face Shape', $stack[6], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Eyes Size', $stack[7], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Mouth Size', $stack[8], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Chin Shape', $stack[9], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Body Type', $stack[10], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> {{Auth::user()->flip('Body Shape', $stack[11], $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> 
                                            {{Auth::user()->flip(Auth::user()->gender == 'male' ? 'Muscles Rate' : 'WaistLine', $stack[12] , $type)}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats">
                                            {{Auth::user()->flip(Auth::user()->gender == 'male' ? 'Beard Type' : 'Hair Type', $stack[13] , $type)}}</label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Wealth : {{__('Level')}} {{$stack[14]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Music Listinging : {{__('Level')}} {{$stack[15]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Food Love : {{__('Level')}} {{$stack[16]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Book Reading : {{__('Level')}} {{$stack[17]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Movie Watching : {{__('Level')}} {{$stack[18]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Entertainment : {{__('Level')}} {{$stack[19]}} </label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Sense Humor : {{__('Level')}} {{$stack[20]}} </label>  </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Stack Sum : {{$sum}}</label> </div></div>
                                        <div class="col-6"><div class="input-group"><label class="label feats"> Stack Rank : {{$stack}}</label> </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                            @if($type != 'stock')
                            <h6>Do You want to build a new one ...? 
                                <span wire:click="$emitSelf('Rank', '{{$type}}')" class="no-st">Generate New</span></h6>
                            @else
                            <h6>lets build you new one
                                <a href="{{route('stockRef')}}" class="no-st">Generate New</a></h6>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else 
        @if($semi == true)
            @livewire('semi')
        @else 
            @livewire('stock')
        @endif    
    @endif

</div>
