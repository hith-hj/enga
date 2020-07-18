<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $table = 'quests';
    protected $fillable = ['user_id','type','title',];
    protected $primarykey='id';
    public $timestamp='true';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function questinos()
    {
        return $this->hasMany('App\Question','quest_id');
    }
}
