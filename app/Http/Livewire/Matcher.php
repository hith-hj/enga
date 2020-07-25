<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Finder;
use App\Events\notifier;
use App\Notify;
use App\Match;
use App\User;
use Auth;

class Matcher extends Component
{
    public $type;
    protected $matches;

    public function mount($type)
    {
        $this->type = $type; 
        $this->start();      
    }

    // public function hydrate()
    // {
    //     $this->start(); 
    // }

    public function start(){
        // $this->matches = Finder::first($this->type,false) ?
        // Finder::first($this->type,false) : \collect();
        $this->matches = Finder::first($this->type,true) ?? \collect();
    }

    public function reqMatch($id = 0 , $type = '' , $rank = 0)
    {
        if($id === 0 || $type === '' || $rank === 0)
        {
            return $this->emit('error','empty needed value');
        }
        Match::create([
            'user_id'=>Auth::user()->id,
            'second_id'=>$id,
            'matchRank'=>$rank,
            'type'=>$type,
            'status'=>'waiting',
        ]);
        $this->start();
        $this->broadcaster($id,'Match','New Request');
        $this->emit('success','Match Request created & Sent');
    }

    public function cancelMatch($id = 0 , $type = '' , $rank = 0)
    {
        if( $id !== 0 && $type !== '' && $rank !== 0)
        {
            Match::where([['user_id',Auth::user()->id],['second_id',$id],])->delete();
            return $this->emit('error', 'Match request removed');
        }
        return $this->emit('error','something went wrong');
    }

    public function broadcaster(int $rid , string $type, string $content)
    {
        Notify::storeNotification(Auth::user()->id,$rid,$type,$content);
        try{
            broadcast(new notifier(Auth::user()->id,$rid,$type,$content))->toOthers();
        }
        catch(\Exception $exc){
            $this->emit('error','Can\'t boradcast now but will notifi the user');
        }
        finally{
            return;
        }
    }
    public function render()
    {
        return view('livewire.matcher',['matchs'=>$this->matches]);
    }
}
