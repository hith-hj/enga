<div class="container-fluid animated fadeIn" style="overflow-x:hidden;">
    <a class="d-block card-header py-3" role="button" aria-expanded="true" aria-controls="collapseCardExample" href="#collapseCardExample" data-toggle="collapse">
        <h6 class="m-0 font-weight-bold text-primary"  >pick what you like 15/<samp id="selected_item"></samp> </h6>
        </a>
    <div class="row">        
        @forelse ($users as $user)
            <div id="post{{$loop->index}}" class="col-xl-12 col-md-12 mb-1" wire:key="{{$loop->index}}" 
                onmouseover="document.querySelector('#post'+{{$loop->index}}).classList.add('Xfocus');
                document.querySelector('#infoShow'+{{$loop->index}}).classList.add('animated','pulse','info')"
                onmouseout="document.querySelector('#post'+{{$loop->index}}).classList.remove('Xfocus');
                document.querySelector('#infoShow'+{{$loop->index}}).classList.remove('animated','pulse','info')"
                onclick="setSelected({{$loop->index}}, {{$user->id}})"  >
                <div class="card border-left-primary shadow py-1" >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-1" >
                                <a href="../../storage/users_images/{{$user->user_image}}" target="_blank">
                                    <img src="../../storage/users_images/{{$user->user_image}}" style="height:100px;width:100px;border-radius:15px;">
                                </a>
                            </div>
                            <div class="col-6">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">{{$user->name}}</div>
                                <div class="h5 mb-0 text-gray-800">chose if liked</div>
                            </div>
                            <div class="col">
                                    <i id="infoShow{{$loop->index}}" class="fas fa-info-circle fa-2x text-gray-300" onclick="displayInfo({{$user->id}})"
                                    onmouseover="event.target.classList.add('info')" onmouseout="event.target.classList.remove('info')"></i> 
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
            <div id="info{{$user->id}}" class=" animated slideInDown card_info hidden" >
                <div class="card border-left-promary shadow py-2">
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
                                        {{$user->gander == 'male' ? 'Muscles Rate' : 'WaistLine'}} : {{$user->waistMuscles}} </label> </div></div>
                                    <div class="col-6"><div class="input-group"><label class="label feats"> 
                                        {{$user->gander == 'male' ? 'Beard Type' : 'Hair Type'}} : {{$user->hairBeard}} </label> </div></div>
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
            <div class="col-xl-12 col-md-10 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info mb-1">{{ucfirst('okay okay')}} </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-600">First you should fill your references</div>
                                <sub>That why nothing abeard here</sub>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        @endforelse
        @if(count($users) > -1 && count($users) > 0 )
            <input type="text" name="ids" id="ids" multiple wire:model="ids" hidden>
            <button onclick="checkIds()" class="btn btn-primary col-12 mt-3" style="bottom:10px;">Next 
                <i class="fa fa-chevron-right ml-2"></i></button>
        @endif
    </div>
</div>
