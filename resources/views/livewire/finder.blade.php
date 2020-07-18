<div class="" >
    <h4 style="margin-left: 2%;" class="text-gray-600 text-bold">{{ucfirst($type)}} Ref Matche Finder Result</h4>
    @forelse ($matchs as $user)
        <div class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}">            
            <div class="card {{$user->matchRate > 60 ? 'border-left-info' : ''}}
                            {{$user->matchRate > 80 ? 'border-left-primary' : ''}}
                            {{$user->matchRate > 90 ? 'border-left-success' : ''}}
                shadow py-1" >
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        {{-- <div class="col-3 mr-2" style="background-repeat: no-repeat;background-size:cover;height:120px;background-image: url('../../storage/users_images/{{$user->user_image}}');border-radius:15px;"
                            onclick="window.open('../../storage/users_images/{{$user->user_image}}','_blank')"> --}}
                            <div class="col-auto mr-1">
                            <a href="../../storage/users_images/{{$user->user_image}}" target="_blank">
                                <img src="../../storage/users_images/{{$user->user_image}}" style="width:110px;border-radius:15px;">
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg font-weight-bold {{$user->rate > 85 ? 'text-success' : 'text-primary'}} text-uppercase">{{$user->name}}</div>
                            <div class="h6 mb-0 text-gray-800">Match :{{$user->rate}}%</div>
                            <div class="inter">
                                @if($user->stat !== 'Matching')
                                    <span class="match" wire:click="reqMatch('{{$user->id}}', '{{$type}}', '{{$user->rate}}')">Match ??</span>
                                @else 
                                    <div class="animated fadeIn">
                                        <span style="font-size:12px;" data-toggle="tooltip" title="your Match request are send">Matching <i class="fa fa-cog fa-spin"></i></span>
                                        <span style="font-size:12px; cursor: pointer; border-left:1px solid #aaa;padding-left:6px" data-toggle="tooltip" title="Cancel your request" 
                                        wire:click="cancelMatch('{{$user->id}}', '{{$type}}', '{{$user->rate}}')">Cancle Matching !!</span>     
                                    </div>   
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>            
        </div>
        <div id="info{{$user->id}}" class=" animated slideInDown card_info hidden" >
            <div class="card {{$user->matchRate > 85 ? 'border-left-success' : 'border-left-primary'}} shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h2 class="title" style="border-bottom:1px solid #d2cdcd;margin-bottom:10px;">{{$user->name}} information 
                                <i class="fas fa-times fa-md text-gray-300 float-right" onclick="hideInfo({{$user->id}})"></i> </h2>
                            <div class="row row-space">
                                <div class="col-6"><div class="input-group"><label class="label feats"> Height : {{$user->height}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Weight : {{$user->weight}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Skin Color : {{$user->skinColor}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Eyes Color : {{$user->eyeColor}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Hair Length : {{$user->hairLength}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Hair Color : {{$user->hairColor}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Face Shape : {{$user->faceShape}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Eyes  : {{$user->eyeSize}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Mouth : {{$user->mouthSize}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Cheek : {{$user->cheekSize}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Body Type : {{$user->bodyType}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Body Shape : {{$user->bodyShape}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> 
                                    {{$user->gender == 'male' ? 'Muscles Rate' : 'WaistLine'}} : {{$user->waistMuscles}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> 
                                    {{$user->gender == 'male' ? 'Beard Type' : 'Hair Type'}} : {{$user->hairBeard}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> District : {{$user->district}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Education : {{$user->education}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Social Status : {{$user->socialStatus}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Wealth : {{$user->wealth}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Music Listinging : {{$user->musicListinging}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Food Love : {{$user->foodLove}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Book Reading : {{$user->bookReading}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Movie Watching : {{$user->movieWatching}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Entertainment : {{$user->entertainment}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label feats"> Sense Humor : {{$user->senseHumor}} </label>  </div></div>
                                <div class="col-12"><div class="input-group"><label class="label feats"> Stack Rank : {{$user->stackRank}}</label> </div></div>
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
                            <div class="text-xs font-weight-bold text-primary  mb-1">Sorry</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-600">No result found</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endforelse 
</div>
