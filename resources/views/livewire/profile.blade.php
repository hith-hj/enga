<div class="col-xl-12 col-md-12  col-sm-12 my-1 profile">
        <div class="col lprofile">
            <div class="col-12 ">
                <img src="{{asset('storage/users_images/'.$user->user_image)}}" class="profile-image" alt="{{$user->name}} profile Image" srcset="">
            </div>
            <div class="col-12 profile-info ">
                <div class="main-info" style="padding-bottom: .3rem;border-bottom: 1px solid #d2cdcd">
                    <b style="font-size: 20px;font-weight: 700;">{{strToUpper($user->name)}}</b><br>
                    <em><strong>Email</strong> {{$user->email}}</em><br>
                </div>
                <em><strong>i'm</strong> {{$user->socialStatus}}</em><br>
                <em><strong>from</strong> {{$user->district}}</em><br>
                <em><strong>a</strong> {{$user->age}} years old {{$user->gender}}</em><br>               
                <em>                   
                    <details class="animated fadeIn">
                        <summary>More info</summary>
                        <div class="animated slideInDown">
                            <div class="col-12"><strong>Education </strong> {{$user->education}} </div>
                            <div class="col-12"><strong>Wealth level</strong> {{$user->feats->wealth}} </div>
                            <div class="col-12"><strong>Phone</strong> {{substr_replace($user->phone,"****",6,4)}}</div>
                            <div class="col-12"><strong>Here since</strong> {{$user->created_at->diffForHumans()}}</div>
                            <div class="col-12"><strong>Intrested In</strong> {{$user->gender == 'male' ? 'Females':'Males'}}</div>
                            <div class="col-12"><strong>Bio</strong> {{$user->bio}}</div>
                        </div>                        
                    </details>
                </em>
                {{-- <div class="d-flex mt-2">
                    <button type="button" class="btn ml-2 btn-sm btn-outline-primary" disabled>Rate</button>
                    <button type="button" class="btn ml-2 btn-sm btn-outline-primary" disabled>Request</button>
                    <button type="button" class="btn ml-2 btn-sm btn-outline-dark" disabled>Question</button>                    
                </div> --}}
            </div>
        </div>
        <div class="col rprofile">
            <div class="d-flex mb-2 pb-2">
                <em class="mx-3  feat-active" wire:click="$set('displayFeat', 'feats')"><strong>Feats</strong></em>
                {{-- <em class="mx-1 rb" wire:click="$set('displayFeat', 'smart')"><strong>Smart Feats</strong></em>
                <em class="mx-1 rb" wire:click="$set('displayFeat', 'semi')"><strong>Semi Feats</strong></em>
                <em class="mx-1" wire:click="$set('displayFeat', 'stock')"><strong>Stock Feats</strong></em> --}}
            </div>
            {{-- @if($displayFeat == 'feats') --}}
            <div class=" animated fadeIn card_infoz" >
                <div class="row no-gutters align-items-center">
                    <div class="">
                        <div class="row row-space" style="padding:.2rem .5rem !important">
                            <div class="col-6"><div class="input-group"><label class="label-2"> Height : </label> {{$user->feats->height}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Weight : </label> {{$user->feats->weight}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Skin Color : </label> {{$user->feats->skinColor}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Eyes Color : </label> {{$user->feats->eyeColor}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Hair Length : </label> {{$user->feats->hairLength}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Hair Color : </label> {{$user->feats->hairColor}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Face Shape : </label> {{$user->feats->faceShape}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Eyes  : </label> {{$user->feats->eyeSize}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Mouth : </label> {{$user->feats->mouthSize}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Chin Shape : </label> {{$user->feats->chinShape}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Body Type : </label> {{$user->feats->bodyType}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Body Shape : </label> {{$user->feats->bodyShape}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> 
                                {{$user->gender == 'male' ? 'Muscles Rate' : 'WaistLine'}} : </label> {{$user->feats->waistMuscles}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> 
                                {{$user->gender == 'male' ? 'Beard Type' : 'Hair Type'}} : </label> {{$user->feats->hairBeard}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Music Listinging : </label> {{$user->feats->musicListinging}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Food Love : </label> {{$user->feats->foodLove}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Book Reading : </label> {{$user->feats->bookReading}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Movie Watching : </label> {{$user->feats->movieWatching}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Entertainment : </label> {{$user->feats->entertainment}}  </div></div>
                            <div class="col-6"><div class="input-group"><label class="label-2"> Sense Humor : </label> {{$user->feats->senseHumor}}   </div></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @else 
                <div class=" animated fadeIn card_infoz" >
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row row-space" style="padding:.2rem .5rem !important">
                                <div class="col-6"><div class="input-group"><label class="label-2"> Height : {{$user->ranks->rank[0]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Weight : {{$user->ranks->rank[1]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Skin Color : {{$user->ranks->rank[2]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Eyes Color : {{$user->ranks->rank[3]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Hair Length : {{$user->ranks->rank[4]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Hair Color : {{$user->ranks->rank[5]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Face Shape : {{$user->ranks->rank[6]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Eyes  : {{$user->ranks->rank[7]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Mouth : {{$user->ranks->rank[8]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Chin Shape : {{$user->ranks->rank[9]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Body Type : {{$user->ranks->rank[10]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Body Shape : {{$user->ranks->rank[11]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> 
                                    {{$user->gender == 'male' ? 'Muscles Rate' : 'WaistLine'}} : {{$user->ranks->rank[12]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> 
                                    {{$user->gender == 'male' ? 'Beard Type' : 'Hair Type'}} : {{$user->ranks->rank[13]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Music Listinging : {{$user->ranks->rank[14]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Food Love : {{$user->ranks->rank[15]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Book Reading : {{$user->ranks->rank[16]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Movie Watching : {{$user->ranks->rank[17]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Entertainment : {{$user->ranks->rank[18]}} </label> </div></div>
                                <div class="col-6"><div class="input-group"><label class="label-2"> Sense Humor : {{$user->ranks->rank[19]}} </label>  </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
            
        </div>
</div>
