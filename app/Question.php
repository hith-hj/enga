<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['quest_id','question','firstAns','secondAns','thirdAns','correctAns',];
    protected $primarykey='id';
    public $timestamp='true';

    public function quest()
    {
        return $this->belongsTo('App\Quest');
    }
}
