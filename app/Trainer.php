<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    private $dts;
    private $file; 
    private $precent;
    private $trainers = [];
    private $predicters = [];
    private $predRules ;
    private $prediction = null;
    public $Rules;

    
    public function __construct($file = '', $percent = 1)
    {
        if($file === '' || $percent === NULL)
        { dd('some thing messing') ;}
       $this->file = $file;
       $this->precent = $percent;
       $this->getDTS();
    }

    private function getDTS()
    {
        if(fopen($this->file,'r')){
            $this->dts = array_map('str_getcsv', file($this->file));
            return $this->Seperate();
        }else{
            dd('opss cant open file');
        }                    
    }

    private function Seperate()
    {
        // $count = count($this->dts);
        // // shuffle($this->dts);
        // $train = round($count*$this->precent,0);
        // $test = $count - $train;
        // $this->trainers = array_slice($this->dts,1,$train);
        // $this->tester = array_slice($this->dts,$train,$test);

        $this->trainers = $this->dts;
        return $this->train();
    }

    private function getMAx()
    {
        $max = 0;
        $val = [];
        foreach($this->trainers as $tr){
            array_push($val,max(str_split($tr[1])));
        }
        $max = max($val);
        return $max;
    }

    private function getCount()
    {
        return sizeof(str_split($this->trainers[5][1]));
    }

    private function train()
    {  
        $max = $this->getMax();
        $cou = $this->getCount();
        $this->predRules = array_fill(1,$cou,array_fill(1,$max,array_fill(1,$max,0)));                
        foreach($this->trainers as $row){
            $r1 = \str_split($row[1]);
            $r2 = \str_split($row[2]);
            foreach($r1 as $ind => $val) {
                $this->predRules[$ind+1][$r1[$ind]][$r2[$ind]] += 1 ;               
            }         
        }
        $this->Rules = $this->predRules;
        return $this->Rules;
    }

    private function test(){
        foreach($this->tester as $tst)
        {
            $pred = $this->score($tst[1]);
            $a1 = array_map(function($a,$b){
                if ($a==$b)
                { return 1; }
                return 0;
            },str_split($pred),\str_split($tst[2]));
            $count = count(array_keys($a1, "1"));
            $pers = round($count*100/24, 3);
            $fi = 'prediction2.txt';
            fopen($fi,'w');
            $current = file_get_contents($fi);
            $current .= $tst[0].','.$tst[1].','.$tst[2].','.$pred.','.$pers.','.$count.PHP_EOL;
            file_put_contents($fi, $current);
        }
    }

    private function score($rank)
    {        
        $r1 = \str_split($rank);
        $pred = '';
        foreach($r1 as $ind => $val)
        {
           $pred .= array_search(max($this->Rules[$ind+1][$r1[$ind]]),$this->Rules[$ind+1][$r1[$ind]]);
        }
        return $pred;
    } 

    public function predicte($rank,$reqRank)
    {        
        $r1 = \str_split($rank);
        $r2 = \str_split($reqRank); 
        foreach($r1 as $ind => $val)
        {
            $this->prediction .= array_search(max($this->Rules[$ind+1][$r1[$ind]]),$this->Rules[$ind+1][$r1[$ind]]);
        }
        $a1 = array_map(function($a,$b){
            if ($a==$b)
            { return 1; }
            return 0;
        },str_split($this->prediction),$r2);
        $count = count(array_keys($a1, "1"));
        $pers = round($count*100/24, 3);
        return [$this->prediction,  $count , $pers];
    } 

    public function tester(){return $this->test();}
    public function scorer($rank){return $this->score($rank);}
    
}
