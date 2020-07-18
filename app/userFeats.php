<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class userFeats extends Model
{
    protected $table = 'user_feats';
    protected $fillable = ['user_id'
    , 'height', 'weight', 'skinColor', 'eyeColor', 'hairColor', 'hairLength'
    , 'faceShape', 'eyeSize', 'mouthSize', 'chinShape', 'noseSize', 'chinShape'
    , 'hairBeard', 'bodyType', 'bodyShape', 'waistMuscles','beardType', 'wealth'
    , 'musicListinging', 'foodLove', 'bookReading', 'movieWatching', 'entertainment', 'senseHumor',];

    protected $primarykey='user_id';
    public $timestamp='true';

    public static function get($id = 0 )
    {
        if($id == 0)
        {
            return self::where('user_id',Auth::user()->id)->first();
        }
        return self::where('user_id',$id)->first();
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
    
}
