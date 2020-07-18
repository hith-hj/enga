<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\feelEvent;
use App\Events\notifier;
use App\Utility;
use App\Notify;
use App\User;
use Auth;
use App;
use DB;

class Body extends Component
{
    protected $users;
    protected $gen;
    public $utili = [];

    public function mount()
    {
        $this->getFeeds();
        
    }

    public function getFeeds()
    {
        Auth::user()->gender == 'male' ? $this->gen ='female' : $this->gen ='male'; 

        $this->users = User::where([['gender', $this->gen],
                        ['district', Auth::user()->district],])
                        ->orderByDesc('created_at')->take(25)->get();

        if(Auth::user()->status != 1)
        { 
            return $this->users = [];
        }

        foreach($this->users as $usr)
        {
            $usr->feats = User::getFeats($usr->id);
            $a = array_map(function($a,$b){
                return $a == $b ? 1 : 0;
            },str_split(Auth::user()->rank(Auth::user()->id,'semiRank'))
            ,str_split(Auth::user()->rank($usr->id,'stackRank')));
            $count = count(array_keys($a, "1"));
            $usr->matchRate = round($count*100/21, 3);
        }
        $this->users->reverse();
        
        return $this->checkUtility();
    }

    public function checkUtility()
    {
        foreach($this->users as $usr)
        {
            $var = Utility::where([['user_id',Auth::user()->id],['reciver_id',$usr->id],])->get()->toArray();
            $usr->utl = empty($var) ? NULL : $var[0]['type'] ;
        }
        return $this->users;
    }

    public function utiliti($type = Null , $id = 0)
    {
        if($type !== Null && $id !== 0)
        {
            Utility::create([
                'user_id'=>Auth::user()->id,
                'reciver_id'=>$id,
                'type'=>$type,
                'status'=>'waiting',
                'viewed'=>0,
            ]);
            Notify::storeNotification(Auth::user()->id,$id,'Utility',$type);
            broadcast(new notifier(Auth::user()->id,$id,'Utility',$type))->toOthers();
            return;
        }
    }

    public function remUtl($id = 0)
    {
        if($id !== 0)
        {
            $del = Utility::where([['user_id',Auth::user()->id],['reciver_id',$id],])->first();  
            $del->delete();
            // Notify::deleteNotification($id);
        }        
        return;
    }

    public function render()
    {
        $this->getFeeds();
        return view('livewire.body',['users'=>$this->users]);
    }
}
