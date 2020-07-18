<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Quest;
use Auth;

class Quests extends Component
{
    protected $quests;
    public $questType;
    public $questTitle;

    public function mount()
    {
        $this->start();
    }

    public function hydrate()
    {
        $this->start();
    }

    public function start()
    {
        $this->quests = Quest::all()->where('user_id',Auth::id())->sortByDesc('created_at') ?? [];
    }

    public function newQuest(string $type = '')
    {
        // dd($this->questTitle,$type);
        $count = Quest::all()->where('user_id',Auth::id())->count();
        if($count <= 3)
        {
            Quest::create([
                'user_id'=>Auth::id(),
                'type'=>$type,
                'title'=>$this->questTitle,
                'questionCount'=>0,
            ]);
            return $this->start();
        }
       return $this->emit('error','No more Questionnary Allowed');
    }

    public function delQuest(int $id = 0)
    {
        if($id != Null && $id != 0)
        {
           Quest::find($id)->delete();
           return $this->start();
        }
        return $this->emit('error','Parameter is missing or Null');
    }



    public function render()
    {
        return view('livewire.quests',['quests'=>$this->quests]);
    }
}
