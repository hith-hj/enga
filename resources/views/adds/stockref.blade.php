@extends('layouts.app2')
@section('content')
<div class="page-wrapper bg-gra-02 font-poppins animated slideInRight" onmouseover="changeSelectOption('{{Auth::user()->gender}}')">
    <div id="container" class="wrapper wrapper--w780 " >
        <div class="card card-4" style="height:95vh; overflow-y:auto; scrollbar-width: none;">
            <h2 class="title mt-1 ml-1">Chose what you want </h2>
            <div class="card-body" style="{{App::getLocale() == 'ar' ? 'text-align:right;' : ''}}">
                <form action="/stock" method="POST" enctype="multipart/form-data">
                    <h3>{{__('lang.Basics')}}</h3><hr>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Height')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="height" >
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="155-160/1">155-160</option>
                                        <option value="160-165/2">160-165</option>
                                        <option value="165-170/3">165-170</option>
                                        <option value="170-175/5">170-175</option>
                                        <option value="175-180/4">175-180</option>
                                        <option value="180-185/7">180-185</option>
                                        <option value="185-190/6">185-190</option>
                                        <option value="190-195/9">190-195</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Weight')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="weight" >
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="55-60/1">55-60</option>
                                        <option value="60-65/2">60-65</option>
                                        <option value="65-70/3">65-70</option>
                                        <option value="70-75/5">70-75</option>
                                        <option value="75-80/4">75-80</option>
                                        <option value="80-85/7">80-85</option>
                                        <option value="85-90/6">85-90</option>
                                        <option value="90-95/9">90-95</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                    <h3>{{__('lang.Colors')}}</h3><hr>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Skin Color')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="skinColor" >
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="White/3">White</option>
                                        <option value="Brunette/2">Brunette</option>
                                        <option value="Dark/1">Dark</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Eye Color')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="eyeColor">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Brown/4">Brown</option>
                                        <option value="Blue/3">Blue</option>
                                        <option value="Green/2">Green</option>
                                        <option value="Dark/1">Dark</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <h3>{{__('lang.Hair')}}</h3><hr>  
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Hair color')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="hairColor">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Red/1">Red</option>
                                        <option value="Brunette/2">Brunette</option>
                                        <option value="Blond/3">Blond</option>
                                        <option value="Dark/4">Dark</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Hair length')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="hairLength">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="bald/1" >bald</option>
                                        <option value="Short/2" >Short</option>
                                        <option value="Normal/5" >Normal</option>
                                        <option value="Long/4" >Long</option>
                                        <option value="Very long/3" >Very Long</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <h3>{{__('lang.Face')}}</h3><hr>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Face Shape')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="faceShape">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Oval/3" >Oval</option>
                                        <option value="Round/2" >Round</option>
                                        <option value="V-triangle/5" >V-triangle</option>
                                        <option value="A-triangle/4" >A-triangle</option>
                                        <option value="Diamond/1" >Diamond</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Eyes')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="eyeSize">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="small/1" >small</option>
                                        <option value="Normal/3" >Normal</option>
                                        <option value="Big/2" >Big</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Mouth')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="mouthSize">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Slim/1" >Slim</option>
                                        <option value="Normal/2" >Normal</option>
                                        <option value="full/5" >full</option>
                                        <option value="wide/4" >wide</option>
                                        <option value="big/3" >big</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Cheeks')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="cheekSize">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Narrow/1" >Narrow</option>
                                        <option value="Normal/4" >Normal</option>
                                        <option value="Wide/3" >Wide</option>
                                        <option value="very Wide/2" >very Wide</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label" id="hairBeard"></label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="hairBeard">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="light/1" >light </option>
                                        <option value="Normal/2" >Normal</option>
                                        <option value="heavy/3" >heavy</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <h3>{{__('lang.Body')}}</h3><hr>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Body Type')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="bodyType">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Slim/1" >Slim</option>
                                        <option value="Normal/2" >Normal</option>
                                        <option value="Curvy/4" >Curvy</option>
                                        <option value="chubby/3" >chubby</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Body Shape')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="bodyShape">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Round/1" >Round</option>
                                        <option value="hour glass/5" >hour glass</option>
                                        <option value="rectangle/3" >rectangle</option>                                            
                                        <option value="V-triangle/2" >V triangle</option>
                                        <option value="A-triangle/4" >A triangle</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label" id="waistMuscles"></label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="waistMuscles">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="XSmall/1" >XSmall</option>
                                        <option value="Small/2" >Small</option>
                                        <option value="Medium/5" >Medium</option>
                                        <option value="Larg/4" >Larg </option>
                                        <option value="Xlarg/3" >Xlarg </option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>{{__('lang.Extra')}}</h3><hr>
                    <div class="row row-space">
                        <div class="col-12">
                            <div class="input-group">
                                <label class="label">{{__('lang.wealth')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="wealth">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">stage 1</option>
                                        <option value="2/2">stage 2</option>
                                        <option value="3/3">stage 3</option>
                                        <option value="4/4">stage 4</option>
                                        <option value="5/5">stage 5</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Music listening')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="musicListinging">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Food love')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="foodLove">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Book reading')}} </label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="bookReading">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Movie watching')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="movieWatching">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Entertainment level')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="entertainment">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">{{__('lang.Sense humor')}}</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="senseHumor" onchange="
                                    document.querySelector('#check').style.display='block';
                                    ">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="1/1">level 1 (bad)</option>
                                        <option value="2/2">level 2</option>
                                        <option value="3/3">level 3</option>
                                        <option value="4/4">level 4</option>
                                        <option value="5/5">level 5 (best)</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 mb-2">
                        <button class="btn btn--radius-2 btn--blue col-12" type="submit" style="bottom:10px;">Next 
                            <i class="fa fa-chevron-right m-1"></i></button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    window.addEventListener('resize',response)
    window.addEventListener('load',response)
    function response(){
    let wid = screen.width || window.innerWidth
    // console.log(wid)
    let id = document.querySelector('#container')
        if(wid > 450)
        {
            id.style.marginLeft = '23%';
        }else {
            id.style.marginLeft = '0';
        }
    }
</script>