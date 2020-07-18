<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\semiSmart as ss;
use Auth;

class Semi extends Component
{
    protected $users;
    public $ids;
    protected $listeners = ['ids'];

    public function mount(){
        // $this->getUsers();
    }

    public function getUsers(){
        Auth::user()->gender == 'male' ? $gen = 'female' : $gen = 'male' ;
        $this->users = User::all()->where('gender',$gen);
    }
    public function ids($ids){
        $this->ids = $ids;
        $this->getIds();
    }
    
    public function getIds(){
        $res = SS::start($this->ids);
        return $res == true ? $this->emitUp('semiGen', true) : $this->emitUp('semiGen', false);
    }

    public function render()
    {
        $this->getUsers();
        return view('livewire.semi',['users'=>$this->users]);
    }
}
