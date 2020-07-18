<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\userFeats;
use App\userRanks;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age',
        'gender', 'phone', 'user_image',
        'status', 'full', 'district','bio',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feats()
    {
        return $this->hasOne('App\userFeats','user_id');
    }
    
    public function ranks()
    {
        return $this->hasOne('App\userRanks','user_id');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat','user_id');
    }

    public function match()
    {
        return $this->hasMany(Match::class,'user_id');
    } 

    public function messages()
    {
        return $this->hasMany(Message::class,'user_id');
    }

    public function utilities()
    {
        return $this->hasMany('App\Utility','user_id');
    }

    public function Quest()
    {
        return $this->hasOne('App\Quest','user_id');
    }

    public static function getFeats(int $id)
    {
        return userFeats::find($id);
    }

    public static function getRanks(int $id = 0)
    {
        return userRanks::get($id);
    }

    public function rank(int $id = 0 , string $type )
    {
        if($id == 0)
        {
            return userRanks::find(Auth::user()->id)->$type;
        }else {
            return userRanks::find($id)->$type;
        }
    }

    public function isFull()
    {
        return userRanks::find(Auth::user()->id)->isFull;
    }

    public function flip(string $feat , int $value , string $type):string 
    {
        $arr = \file_get_contents('store');
        $feats = unserialize($arr);
        return $feat.': '.$feats[$feat][$type != 'smart' ? $value : $value-1];
        // return $feat.': '.$feats[$feat][$value];
    }
}
