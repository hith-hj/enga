<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\userFeats;
use Auth;

class SemiSmart extends Model
{
    protected $users;
    protected $feats = [];
    protected $keys = [];
    protected $fina = [];
    protected $matche = [];
    protected $matchPercent;
    
    public static function start($ids){
        // return (new self())->getIds($ids);
        return (new self())->getRanks($ids);
    }

    public function getRanks(array $ids)
    {
        $usersRanks = userRanks::find($ids);
        $ranks = $this->buildRanksArr($usersRanks);
        $keys = $this->buildKeysArr($ranks);
        $result = $this->buildStack($keys);
        
        return $this->saveResult($result);
    }

    private function buildRanksArr($usersRanks)
    {
        $ranksArr = [];        
        foreach ($usersRanks as $rank) {
            array_push($ranksArr,\str_split($rank->stackRank));
        }
        return $ranksArr;
    }

    private function buildKeysArr($ranksArr)
    {
        $keys = array_fill(0,count($ranksArr[0]),array());
        foreach ($ranksArr as $arr) {
            foreach ($keys as $key => $val) {
            array_push($keys[$key],$arr[$key]);
            }
        }
        return $keys;
    }

    private function buildStack($keys)
    {
        foreach ($keys as $key => $value) {
            $count = array_count_values($value);
            $keys[$key] = array_search(max($count),$count);
        }

        return $keys;
    }

    private function saveResult($result)
    {
        $us = userRanks::find(Auth::user()->id);
        $us->semiRank = \implode('',$result);
        $us->semiSum = array_sum($result);
        $us->save();
        return 'done';
    }
}
