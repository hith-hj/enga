<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\notifier;
use App\Notify;
use App\User;
use App\Chat;
use App\Match;
use App\Message;
use Auth;

class Matches extends Component
{
    public $type;
    protected $match;
    public function mount($type)
    {
        $this->type = $type;
    }

    public function hydrate()
    {
        $this->start();
    }

    public function start()
    {
        $mat = Match::matchs();
        if($this->type == 'all'){
            $mat->filter(function($mat){
                if ($mat->status == 'accepted' ) {
                    Chat::checkExists($mat->user_id,$mat->second_id) ? $mat->chatable = false : $mat->chatable = true ;
                }
                return $mat->user_id == Auth::user()->id ? $mat['by'] = 'me' : $mat['by'] = 'you';
            });
           $this->match = $mat;
        } else {
            $mat = $mat->filter(function ($mat) {
                return $mat->type === $this->type;
            })->filter(function($mat){
                if ($mat->status == 'accepted' ) {
                    Chat::checkExists($mat->user_id,$mat->second_id) ? $mat->chatable = false : $mat->chatable = true ;
                }
                return $mat->user_id == Auth::user()->id ? $mat['by'] = 'me' : $mat['by'] = 'you';
            });
            $this->match = $mat;
        }
        return $this->gatherInfo();
    }

    private function gatherInfo()
    {
        foreach($this->match as $mat)
        {
            $mat->first = User::find($mat->user_id);
            $mat->second = User::find($mat->second_id);
        }
        return;
    }

    public function acceptMatch(int $id = 0, int $rid = 0)
    {
        if($id == 0 )
        {
            dd('no id passed');
        }
        $mat = Match::find($id);
        $mat->status = 'accepted';
        $mat->save();
        Notify::storeNotification(Auth::user()->id,$rid,'Match','Accepted');
        broadcast(new notifier(Auth::user()->id,$rid,'Match', $this->type.'/Accepted'))->toOthers();
        $this->emit('success','you Accepted the match');
        return;
    }

    public function cancelMatch(int $id = 0, int $rid = 0, string $meth = 'edit')
    {
        if($id == 0 )
        {
            dd('No id passed');
        }
        if($meth == 'delete'){
            $mat = Match::find($id);
            $mat->delete();
            return $this->emit('error','You deleted canceld Match request');
        }
        $mat = Match::find($id);
        $mat->status = 'rejected';
        $mat->save();
        Notify::storeNotification(Auth::user()->id,$rid,'Match','Rejected');
        broadcast(new notifier(Auth::user()->id,$rid,'Match', $this->type.'/Rejected'))->toOthers();
        $this->emit('error','you rejected the match');
        return;
    }

    public function startChat(int $id , int $matId)
    {
        if($id == '' || $id == 0 || empty($id))
        {
            return dd('Parameter missing');
        }
        $chat = Chat::create([
            'user_id'=>Auth::user()->id,
            'second_id'=>$id,
            'status'=>'normal',
            'msgsCount'=>1,
            'done_by'=>'none',
        ]);
        $msg = Message::create([
            'chat_id'=>$chat->id,
            'user_id'=>Auth::user()->id,
            'reciver_id'=>$id,
            'message'=>'Hay Matchy',
            'status'=>'done',
            'viewed'=>0,
            'done_by'=>'none',
        ]);
        // dd($this->match);
        $this->match->pull($matId);
        Notify::storeNotification(Auth::user()->id,$id,'New','Chat Created');
        return \broadcast(new notifier(Auth::user()->id, $id, 'Chat', ' Chat created'))->toOthers();
    }

    public function render()
    {
        $this->start();
        return view('livewire.matches',['matches'=>$this->match]);
    }
}
