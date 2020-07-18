<div >
    <div class=" col-xl-12 ">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between" onclick="newQuestion()">
          <h6 class="m-0 font-weight-bold text-primary">Questionnary</h6>
            <div class="dropdown show">
                <button class="btn btn-circle btn-sm btn-outline-success " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-plus fa-lg fa-fw" ></i>
                </button>
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <div class="dropdown-header">Questionnarie Title</div>
                    <input type="text" class="form-control" wire:model.lazy="questTitle" placeholder="Title Here">
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Questionnarie Type</div>
                    <a class="dropdown-item" wire:click="newQuest('write')">Typing</a>
                    <a class="dropdown-item" wire:click="newQuest('select')">Multible Choise</a>                  
                </div>
              </div>
        </div>
        <div class="card-body" id="questionnary">
            @forelse ($quests as $quest)
            <div class="dropdown-item d-flex align-items-center my-1 bb-i py-2" 
                style="padding:.5rem 1rem !important" >
                <div class="mr-1 col-1">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alter text-white"><strong>{{$quest->questionCount}}</strong></i>
                    </div>
                </div>
                <div class="col-8"wire:click="$emitTo('main', 'changeBody', ['questions','{{$quest->id}}'])">
                    <span class="font-weight-bold">Title : {{$quest->title}}</span>
                    <div class="text-gray-700">Type : {{$quest->type}}</div>
                    <div class="small text-gray-500">@ {{$quest->created_at->format('D H:m')}}</div>
                </div>
                <div class="col-2">
                    <i class="fa fa-trash" data-toggle="tooltip" title="Delete Questionnrie"
                    wire:click="delQuest('{{$quest->id}}')"></i>
                    <i class="fa fa-plus" data-toggle="tooltip" title="New Question" 
                    wire:click="$emitTo('main', 'changeBody', ['questions',['{{$quest->id}}', true ,] ,])"></i>
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
    </div>
</div>
