<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Notify extends Model
{
    protected $table = 'notifies';
    protected $fillable = ['user_id','reciver_id','type','content','viewed',];
    protected $primarykey = 'id';
    public $timestamp = 'true'; 

    /**
        *@param int $uid sender user id
        *@param int $rid reciver user id
        *@param string $type notification type
        *@param string $content notification content
    */

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public static function storeNotification(int $uid , int $rid , string $type , string $content) : object
    {
        return self::create([
            'user_id'=>$uid,
            'reciver_id'=>$rid,
            'type'=>$type,
            'content'=>$content,
            'viewed'=>0,
        ]);
    }

    public static function deleteNotification(int $notificationId) : bool
    {
        return self::find($id)->delete();
    }

    public static function getNotification()
    {
        return self::where([['reciver_id',Auth::user()->id],['type','!=','message'],['viewed',0]])
        ->orderByDesc('created_at')->take(10)->get();
    }
}
