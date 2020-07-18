<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\userRanks;
use App\User;
use Auth;

class Reference extends Component
{
    public $type;
    public $semi;
    public $smart;
    public $noGen = true; 
    protected $listeners = ['Rank','semiGen'];

    public function mount($type){
        $this->type = $type;
        return;
    } 

    public function Rank($type){
        
        switch ($type) {
            case 'smart':
                $this->smartRank($type);
                break;
            case 'semi':
                $this->semiRank($type);
                break;
            case 'stock':
                $this->stockRank($type);
                break;
        }
    }

    public function smartRank($type){
        $R = $type.'Rank';
        $S = $type.'Sum';
        $smart = app('Trainer')->scorer(Auth::user()->rank(Auth::user()->id,'stackRank'));
        $us = userRanks::get();
        $us->$R = $smart;
        $us->$S = array_sum(str_split($smart));
        $us->save();
        return;
    }

    public function semiRank($type){
        $this->noGen = false;
        $this->semi = true;
        return;
    }
    
    public function semiGen($stat){
        $this->noGen = true;
        $this->semi = false;
        return;
    }

    public function stockRank($type){
        // $this->noGen = false;
        // $this->semi = true;
        return;
    }

    public function render()
    {
        return view('livewire.reference');
    }
}
