<div class="" >
        @forelse ($users as $user)
            <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}">            
                <div class="card {{$user->utl !== NULL ? $user->utl : ''}}
                    shadow" >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto mr-1" >
                                <a href="../../storage/users_images/{{$user->user_image}}" target="_blank">
                                    <img src="../../storage/users_images/{{$user->user_image}}" style="height:100px;width:100px;border-radius:10px;">
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="text-lg font-weight-bold {{$user->matchRate > 85 ? 'text-success' : 'text-primary'}} text-uppercase"
                                    data-toggle="tooltip" title="Match Rate is {{$user->matchRate}}">{{$user->name}}</div>
                                {{-- <div class="h5 mb-0 text-gray-800">Match Rate: {{$user->matchRate}}%</div> --}}
                                <div class="h6 mb-0 text-gray-800">Expres your feeling</div>
                                <div name="ineract">
                                    @php
                                        switch ($user->utl) {
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
                                        }    
                                    @endphp
                                    @if($user->utl !== NULL)
                                        <i class="{{$icon}} fa-2x text-gray-300 {{$user->utl}}" 
                                            wire:click="remUtl('{{$user->id}}')" aria-hidden="true"></i>
                                        <i class="fa fa-info-circle fa-2x text-gray-300"  onclick="displayInfo({{$user->id}})"
                                            onmouseover="event.target.classList.add('info')" onmouseout="event.target.classList.remove('info')"></i> 
                                    @else        
                                        <i class="far fa-heart fa-2x text-gray-300 " wire:click="utiliti('heart', '{{$user->id}}')"
                                        onmouseover="event.target.classList.add('heart')"onmouseout="event.target.classList.remove('heart')"></i>
    
                                        <i class="far fa-gem fa-2x text-gray-300" wire:click="utiliti('diamond', '{{$user->id}}')"
                                            onmouseover="event.target.classList.add('diamond')" onmouseout="event.target.classList.remove('diamond')"></i>
    
                                        <i class="fa fa-fire fa-2x text-gray-300" wire:click="utiliti('fire', '{{$user->id}}')"
                                            onmouseover="event.target.classList.add('fire')" onmouseout="event.target.classList.remove('fire')"></i>
    
                                        <i class="far fa-star fa-2x text-gray-300" wire:click="utiliti('star', '{{$user->id}}')"
                                            onmouseover="event.target.classList.add('star')" onmouseout="event.target.classList.remove('star')"></i>
    
                                        <i class="far fa-thumbs-up fa-2x text-gray-300" wire:click="utiliti('like', '{{$user->id}}')"
                                        onmouseover="event.target.classList.add('like')" onmouseout="event.target.classList.remove('like')"></i>
    
                                        <i class="fas fa-info-circle fa-2x text-gray-300"  onclick="displayInfo({{$user->id}})"
                                            onmouseover="event.target.classList.add('info')" onmouseout="event.target.classList.remove('info')"></i> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="info{{$user->id}}" class=" animated fadeIn card_infoz hidden" >
                        <div class="card shadow py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <h2 class="title" style="border-bottom:1px solid #d2cdcd;margin-bottom:10px;">{{ucfirst($user->name)}} information 
                                        <i class="fas fa-times fa-xs text-gray-300 float-right" onclick="hideInfo({{$user->id}})"></i> </h2>
                                        <div class="row row-space" style="padding:0 .5rem !important">
                                            <div class="col-6"><div class="input-group"><label class="label feats"> District : {{$user->district}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Education : {{$user->education}} </label> </div></div>                                            
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Social Status : {{$user->socialStatus}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Wealth : {{$user->feats->wealth}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Height : {{$user->feats->height}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Weight : {{$user->feats->weight}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Skin Color : {{$user->feats->skinColor}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Eyes Color : {{$user->feats->eyeColor}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Hair Length : {{$user->feats->hairLength}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Hair Color : {{$user->feats->hairColor}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Face Shape : {{$user->feats->faceShape}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Eyes  : {{$user->feats->eyeSize}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Mouth : {{$user->feats->mouthSize}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Chin Shape : {{$user->feats->chinShape}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Body Type : {{$user->feats->bodyType}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Body Shape : {{$user->feats->bodyShape}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> 
                                                {{$user->gender == 'male' ? 'Muscles Rate' : 'WaistLine'}} : {{$user->feats->waistMuscles}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> 
                                                {{$user->gender == 'male' ? 'Beard Type' : 'Hair Type'}} : {{$user->feats->hairBeard}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Music Listinging : {{$user->feats->musicListinging}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Food Love : {{$user->feats->foodLove}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Book Reading : {{$user->feats->bookReading}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Movie Watching : {{$user->feats->movieWatching}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Entertainment : {{$user->feats->entertainment}} </label> </div></div>
                                            <div class="col-6"><div class="input-group"><label class="label feats"> Sense Humor : {{$user->feats->senseHumor}} </label>  </div></div>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="text-xs font-weight-bold text-primary  mb-1">okay okay </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-600">First you should fill your references</div> 
                                <sub>That why nothing abeard here</sub>
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div> 
        @endforelse        
</div>
