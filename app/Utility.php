<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Utility extends Model
{
    protected $table = 'utilities';
    protected $fillable = ['user_id','reciver_id','type','status','viewed',];
    protected $primarykey='id';
    public $timestamp='true';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function utilities()
    {
        return self::where('reciver_id',Auth::user()->id)
            ->orWhere('user_id',Auth::user()->id)->get();
    }

}
