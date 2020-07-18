<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Quest;
use App\Question;

class Questions extends Component
{
    protected $quest;
    public $new = false;
    public $quest_id;
    public $type;
    public $question;
    public $firstAns; 
    public $secondAns; 
    public $thirdAns; 
    public $correctAns; 

    public function mount($id)
    {
        // dd($id);
        if(\is_array($id))
        {
            $this->new = $id[1];
            $this->start($id[0]);
            $this->quest_id = $id[0];
        }else{
            $this->start($id);
            $this->quest_id = $id;
        }
    }

    public function hydrate()
    {
        $this->start($this->quest_id);
    }

    public function start($id)
    {
        $this->quest = Quest::find($id);
        $this->quest->questions = Question::all()->where('quest_id',$id)->sortByDesc('created_at') ?? Null;
        $this->type= $this->quest->type;
        // $this->questions = Questions::all()->where('quest_id',)
    }

    public function newQuestion()
    {
        if($this->type == 'select')
        {
            $this->validate([
                'question'=>'required',
                'firstAns'=>'required',
                'secondAns'=>'required',
                'thirdAns'=>'required',
                'correctAns'=>'required',
                ]);
            Question::create([
                'quest_id'=>$this->quest_id,
                'question'=>$this->question,
                'firstAns'=>$this->firstAns,
                'secondAns'=>$this->secondAns,
                'thirdAns'=>$this->thirdAns,
                'correctAns'=>$this->correctAns,
            ]);
        }else {
            $this->validate([
                'question'=>'required',
                ]);
            Question::create([
                'quest_id'=>$this->quest_id,
                'question'=>$this->question,
            ]);
        }
        $up = Quest::find($this->quest_id);
        $up->questionCount += 1;
        $up->save();
        $this->new = false;
        return $this->start($this->quest_id);   
    }

    public function delQuestion($id)
    {
        Question::find($id)->delete();
        return $this->start($this->quest_id);
    }

    public function render()
    {
        return view('livewire.questions',['quest'=>$this->quest,]);
    }
}
