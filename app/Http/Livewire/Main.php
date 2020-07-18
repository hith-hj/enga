<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Auth;

class Main extends Component
{
    protected $type;
    public $params;    
    protected $listeners = ['changeBody'];

    public function mount($type){
        $this->type = $type;
    }

    public function changeBody($type){
        if(\is_array($type)){
            $this->type = $type[0]; 
            $this->params = $type[1];
        }  else{
            $this->type = $type; 
        }
        return $this->emit('pageRefreshSave', $this->type);
    }

    public function render()
    {
        return view('livewire.main',['type'=>$this->type]);
    }
}
