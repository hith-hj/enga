<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['chat_id','user_id','reciver_id','message','status','viewed','done_by',];
    protected $primarykey='id';
    public $timestamp='true';

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public static function getMessages()
    {
        return self::where([['reciver_id',Auth::user()->id],['viewed','>=',1]])
                    ->orderByDesc('created_at')->take(10)->get();
    }
}
