<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class userRanks extends Model
{
    protected $table = 'user_ranks';
    protected $fillable = ['user_id','isFull',
    'stackRank', 'stackSum', 'smartRank', 'smartSum',
    'semiRank', 'semiSum', 'stockRank', 'stockSum',];
    protected $primarykey='user_id';
    public $timestamp='true';

    public static function get($id = 0)
    {
        if($id == 0)
        return self::where('user_id',Auth::user()->id)->first();
        else 
        return self::where('user_id',$id)->first();
    }    

    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public static function checkFull($id = 0)
    {
        $user = self::get($id);
        if($user->smartSum != 0 && $user->semiSum != 0 && $user->stockSum != 0 )
        {
            $user->isFull =1;
            $user->save();
            return true;
        }else{
            return false;
        }
    }
}
