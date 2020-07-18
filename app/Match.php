<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Match extends Model
{
    protected $table = 'matches';
    protected $fillable = ['user_id','second_id','matchRank','rankTitle','type','status',];
    protected $primarykey='id';
    public $timestamp='true';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function matchs()
    {
        return self::where('user_id',Auth::user()->id)
        ->orWhere('second_id',Auth::user()->id)->get();
    }
}
