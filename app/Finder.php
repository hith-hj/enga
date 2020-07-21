<?php 

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Coll;
use App\User;
use App\userFeats;
use App\userRanks;
use Auth;
use DB;

class Finder
{    
    protected static $type;
    protected static $checkMatch;
    protected static $stack;
    protected static $sum;
    protected static $rank = Null;
    protected static $myId;
    protected static $users;

    /**
     * firt function is a constructer for the model 
     * @param string $searchType what type of search to do
     * @param bool $checkIfBothMatch check if both users are matched not one to other
     */

    public static function first(string $searchType ,bool $checkIfBothMatch = false):?collection
    {
        self::$type = $searchType;
        self::$checkMatch = $checkIfBothMatch;
        self::$stack = $searchType.'Rank';
        self::$sum = $searchType.'Sum';
        self::$myId = Auth::id();
        self::$users = self::start();
        return  !empty(self::$users) && 
                count(self::$users) > 0 && 
                count(self::$users) > -1 
                ? self::$users : self::$users = Null ;
    }

    /**
     * the Start function is begining of finding matches 
     * @param no Params needed
     */

    public static function start():collection
    {   
        if(self::$type == 'mixed')
        {
            self::getMixedRanks();
        }
        $ranks = self::getUsersByRanks();
        $users = self::getUsersWithFeats($ranks);
        if(self::$checkMatch == true)
        {
           return $matchToOther = self::chackIfMatchToOther($users);
        }
        return $users;
    }

    /**
     * if mixed type of search is enabled gatherd rank from user ranks
     * @param no Params needed
     */

    private static function getMixedRanks():int
    {
        $one = Auth::user()->rank(Auth::user()->id,'smartRank');
        $two = Auth::user()->rank(Auth::user()->id,'semiRank');
        $thr = Auth::user()->rank(Auth::user()->id,'stockRank');
        self::$rank = array_map(function($o , $t , $h){
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
        return self::$rank = \array_sum(self::$rank);
    }

    /**
     * get users info for matched ranks
     * @param no Params needed
     */

    private static function getUsersByRanks():array
    {
        $mySum = self::$rank != Null ? self::$rank : Auth::user()->rank(self::$myId,self::$sum);
        $var = 0;
        do {
            $one = $mySum-$var;
            $two = $mySum+$var;
            $ranks = userRanks::where('user_id','!=',self::$myId)
                    ->whereBetween('stackSum',[$one,$two])->get();
            $var++;
        } while (count($ranks) < 2 && $var < 40);
        $ids = [];
        foreach ($ranks as $rank) {
            $a1 = array_map(function($a,$b){
                return $a == $b ? 1 : 0 ;
            },\str_split(Auth::user()->rank(self::$myId,self::$stack)),\str_split($rank->stackRank));
            $count = count(array_keys($a1, "1"));
            $ids[$count] = $rank->id;
        }
        return $ids;
    }

    private static function getUsersWithFeats(array $ranks = NUll ):collection
    {
        if($ranks != NUll)
        {
            $users = User::find($ranks);
            $users = $users->filter(function($user){
                return $user->gender != Auth::user()->gender ;
            });
            $users->each( function($user) use ($ranks) 
            {
                $user->rate = round(array_search($user->id,$ranks)*100/21, 3);
                $user->feats = userFeats::find(self::$myId);
            });
            return self::checkIfMatchExist($users);
        }
    }

    private static function chackIfMatchToOther(collection $users):collection
    {
        $users = $users->filter(function($user){
            $comp = array_map(function($a,$b){
                return $a == $b ? 1 : 0 ;
            },str_split(Auth::user()->rank($user->id,self::$stack)),
            str_split(Auth::user()->rank(Auth::id(),'stackRank')));
            return count(array_keys($comp, "1")) > 10;
        });
        return self::checkIfMatchExist($users);
    }

    private static function checkIfMatchExist(collection $users):collection
    {
        foreach($users as $key => $user )
        {
            $check = Match::where([
                    ['user_id', '=', Auth::user()->id],
                    ['second_id', '=', $user->id],])->orWhere([
                    ['user_id', '=', $user->id],
                    ['second_id', '=', Auth::user()->id],])->exists();
            if($check == true)
            {
                unset($users[$key]);
            } else {
                $user->stat = 'waiting';
            }
        }
        return $users;
    }

}