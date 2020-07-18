<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Chat extends Model
{
    protected $table = 'chats';
    protected $fillable = ['user_id','second_id','status','msgsCount','done_by',];
    protected $primarykey='id';
    public $timestamp='true';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function chats()
    {
        return self::where('user_id',Auth::user()->id)
        ->orWhere('second_id',Auth::user()->id)
        ->orderByDesc('updated_at')->get();
    }

    public static function checkExists(int $first , int $second) : bool
    {
        return self::where([['user_id',$first],['second_id',$second],])
        ->orWhere([['user_id',$second],['second_id',$first],])->exists();
    }

}
