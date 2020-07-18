<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Fonder;
use App\Events\notifier;
use App\Notify;
use App\Match;
use App\User;
use Auth;
use DB;

class Finder extends Component
{
    public $type;
    public $stRank;
    public $Mfucker;
    protected $matche;
    protected $matches;
    public function mount($type)
    {
        $this->type = $type; 
        $this->start();      
    }

    public function hydrate()
    {
        $this->start(); 
    }

    public function start(){
        if ($this->type != 'mixed') {
            $this->getMatches();
        }else {
            $this->getMixedMatches();
        }
    }

    public function getMatches($rank = NULL)
    {
        if($rank !== null ){
            $str = $this->stRank  = $rank; 
            $sts = array_sum(str_split($rank));
        } else {
            $stack= $this->Mfucker = $this->type.'Rank';
            $sum = $this->type.'Sum';
            $str = $this->stRank = Auth::user()->rank(Auth::user()->id,$stack);
            $sts = Auth::user()->rank(Auth::user()->id,$sum);
        }
        $var = 0;   
        $matches = [];
        $users = collect();
        do {
            $one = $sts-$var;
            $two = $sts+$var;
            $matches = DB::table('user_ranks')
                        ->where('user_id','!=',Auth::user()->id)
                        ->whereBetween('stackSum',[$one , $two])->get()->toArray();
            $var++;
        } while (count($matches) < 3 && $var < 40);

        foreach ($matches as $key => $val) {
            $users->push(User::find($val->user_id)); 
        }

        $users = $users->filter(function($user){
            return $user->gender != Auth::user()->gender ;
        });
        // ->filter(function($user){
        //     $a1 = array_map(function($a,$b){
        //         return $a == $b ? 1 : 0 ;
        //     },str_split(Auth::user()->rank($user->id,$this->Mfucker)),
        //     str_split(Auth::user()->rank(Auth::id(),'stackRank')));
        //     return count(array_keys($a1, "1")) > 1;
        // });
        if(!empty($users) && count($users)>0)
        {
            return $this->findMatch($users); 
        }else {
            $this->emit('Opss', 'No Matches found');
            return $this->matches = [];
        }   
    }

    private function findMatch($matches)
    {
        $finaStackRArr = \str_split($this->stRank);
        foreach($matches as $match){
            $a1 = array_map(function($a,$b){
                return $a == $b ? 1 : 0 ;
            },str_split(Auth::user()->rank($match->id,'stackRank')),$finaStackRArr);
            $count = count(array_keys($a1, "1"));
            $this->matche[$match->id] = $count;
        }   
        return $this->result();
    }

    private function result()
    {
        $this->matches = [];
        foreach($this->matche as $key => $val)
        {
            $this->matches[$key] = User::find($key);
            $this->matches[$key]['count'] = $val;
        }

        foreach($this->matches as $key => $id )
        {
            $id->rate = round($this->matche[$id->id]*100/21, 3);
            $che = Match::where([
                    ['user_id', '=', Auth::user()->id],
                    ['second_id', '=', $id->id],])->orWhere([
                    ['user_id', '=', $id->id],
                    ['second_id', '=', Auth::user()->id],])->exists();
            if($che == true )
            {
                unset($this->matches[$key]);
            } else {
                $id->stat = 'waiting';
            }
        }
        $this->matches = \array_filter($this->matches,function($mat){
            return $mat->rate > 10 ? $mat : Null ;
        });
        return $this->matches = \collect($this->matches)->sortByDesc('matchRate');
    }

    private function getMixedMatches():string
    {
        $one = Auth::user()->rank(Auth::user()->id,'smartRank');
        $two = Auth::user()->rank(Auth::user()->id,'semiRank');
        $thr = Auth::user()->rank(Auth::user()->id,'stockRank');
        $rank = array_map(function($o , $t , $h){
            if(($o === $t) && ($t === $h)){
                return $o;
            }elseif (($o === $t) || ($o === $h)) {
                return $o;
            }elseif (($t === $o) || ($t === $h)) {
                return $t;
            }else{
                return max($o,$t,$h);
            } 
        },str_split($one),str_split($two),str_split($thr));
        return $this->getMatches(\implode('',$rank));
    }

    public function render()
    {
        return view('livewire.finder',['matchs'=>$this->matches]);
    }

}