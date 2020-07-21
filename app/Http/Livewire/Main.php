<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Auth;

class Main extends Component
{
    protected $type;
    public $component;    
    public $params;    
    protected $listeners = ['changeBody'];

    public function mount($component){
        $this->component = $component;
    }

    public function changeBody($type){
        if(\is_array($type)){
            $this->component = $type[0]; 
            $this->params = $type[1];
        }  else{
            $this->component = $type; 
        }
        return $this->emit('pageRefreshSave', $this->component);
    }
    
    public function render()
    {
        return view('livewire.main',['component'=>$this->component]);
    }
}
