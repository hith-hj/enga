<div >
    <div class=" col-xl-12 ">
        <!-- Card Header - Dropdown onclick="newQuestion()"-->
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between" >
          <h4 class="m-0 font-weight-normal ">{{$quest->title}} <small>Type : {{$quest->type}}</small></h4>
        </div>
        @if($new != true && count($quest->questions) > 0)
            @forelse($quest->questions as $qust )
                <div class="card shadow mb-1 question" id="firstQuest">
                    <a href="#collapseCard{{$loop->index}}" class="card-header py-1" data-toggle="collapse" aria-expanded="true" >
                        <div class="col-12">
                           <h3 style="color:black;">{{$qust->question}}..? 
                            <span style="color:#7b7474;font-size:12px !important" class="ml-1">{{$qust->created_at->diffForHumans()}}</span></h3>
                        </div>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div id="collapseCard{{$loop->index}}" class="collapse show" >
                        @if($quest->type == 'select')
                            <div class="card-body">
                                <div class="answer col-12">                
                                    <label for="firstAns" class="col-2">1st Answer</label>
                                    <div class="form-check-inline col-7 {{$qust->correctAns == 'firstAns' ? 'rb-s' : ''}} ">
                                        <p>{{$qust->firstAns}}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="answer col-12">                
                                    <label for="secondAns" class="col-2">2nd Answer</label>
                                    <div class="form-check-inline col-7 {{$qust->correctAns == 'secondAns' ? 'rb-s' : ''}}">
                                        <p>{{$qust->secondAns}}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="answer col-12">                
                                    <label for="thirdAns" class="col-2">3ed Answer</label>
                                    <div class="form-check-inline col-7 {{$qust->correctAns == 'thirdAns' ? 'rb-s' : ''}}">
                                        <p>{{$qust->thirdAns}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card-footer">
                            <button type="button" class="col-1 btn btn-outline-danger"
                            wire:click="delQuestion('{{$qust->id}}')"><i class="fa fa-trash"></i></button>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-600">No Questions </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        @else
        <div class="card-body" id="questionnary">
            <div class="card shadow mb-1 question" id="firstQuest">
                <div class="d-block card-header py-1 d-flex">
                    <div class="col-10">
                        <label for="" class="col-4">Write Question</label>
                        <input type="text" class="form-control" placeholder="Question" wire:model.lazy="question">
                    </div>
                    <div class="col-2 mt-4 ml-5">
                        <button type="button" class="btn btn-circle btn-sm btn-outline-success"
                        wire:click="newQuestion()"><i class="fa fa-check"></i></button>
                    </div>
                </div>
                @if($quest->type == 'select')
                    <div class="card-body">
                        <div class="answer col-12">
                            <label for="firstAns" class="col-2">1st Answer</label>
                            <div class="form-check-inline col-7">
                                <input type="text" id="firstAns" class="form-control" placeholder="Write The Answer" wire:model.lazy="firstAns">
                            </div>
                            <hr>
                        </div>
                        <div class="answer col-12">
                            <label for="secondAns" class="col-2">2nd Answer</label>
                            <div class="form-check-inline col-7">
                                <input type="text" id="secondAns" class="form-control" placeholder="Write The Answer" wire:model.lazy="secondAns">
                            </div>
                            <hr>
                        </div>
                        <div class="answer col-12">
                            <label for="thirdAns" class="col-2">3ed Answer</label>
                            <div class="form-check-inline col-7">
                                <input type="text" id="thirdAns" class="form-control" placeholder="Write The Answer" wire:model.lazy="thirdAns">
                            </div>
                            <hr>
                        </div> 
                        <div class="dropdown col-12">
                            <button class="btn btn-outline-success col-12" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Correct Answer is {{$correctAns}}
                            </button>
                            <div class="dropdown-menu animated--fade-in col-12" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" wire:click="$set('correctAns', 'firstAns')">First Answer</a>
                                <a class="dropdown-item" wire:click="$set('correctAns', 'secondAns')">Second Answer</a>                  
                                <a class="dropdown-item" wire:click="$set('correctAns', 'thirdAns')">Third Answer</a>                  
                            </div>
                          </div>                       
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>