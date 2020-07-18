<?php

use Illuminate\Support\Facades\Broadcast;
use App\Chat;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chat.{id}',function ($user,$id){
//     // return Chat::where('user_id',$user->id)->orWhere('second_id',$user->id)->where('id',$id)->exists() == true ? $user : false ;
//     return $user;
// });
