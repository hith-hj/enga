<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\userFeats;
use App\userRanks;
use Auth;

class Profile extends Component
{
    public $uid;
    protected $user;
    public $displayFeat = 'feats';

    public function mount($id)
    {
        $this->uid = $id;
        $this->start();
    }

    public function hydrate()
    {
        $this->start();
    }

    public function start()
    {
        $user = User::find($this->uid);
        $user->feats = userFeats::get($this->uid);
        $user->rank = userRanks::get($this->uid);
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile',['user'=>$this->user]);
    }
}
