<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\userFeats;
use App\userRanks;
use Auth;

class Profile extends Component
{
    public $myId;
    protected $user;
    public function mount($id)
    {
        $this->myId = $id;
        $this->start();
    }

    public function hydrate()
    {
        $this->start();
    }

    public function start()
    {
        $user = User::find(Auth::id());
        $user->feats = userFeats::get();
        $user->rank = userRanks::get();
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile',['user'=>$this->user]);
    }
}
