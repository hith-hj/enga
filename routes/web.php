<?php

use Illuminate\Support\Facades\Route;
use App\Events\msg;
use App\Message;
use App\Chat;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('fetchMsgs/{id}',function($id){
    return Message::all()->where('chat_id',$id)->toJson();
});
Route::post('sendMsg/{cid}/{content}/{rid}',function($cid,$content,$rid){
    Message::create([
        'chat_id'=>$cid,
        'user_id'=>Auth::user()->id,
        'reciver_id'=>$rid,
        'message'=>$content,
        'status'=>'done',
        'viewed'=>1,
        'done_by'=>'none'
    ]);
    broadcast(new msg($cid,$rid));
    return response()->json('done');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/newRank/{type}', 'HomeController@newRank')->name('newRank');
Route::get('/stockRef', function(){
    return view('adds.stockref');
})->name('stockRef');

Route::get('/userFeats',function(){
    return view('adds.second');
})->name('userFeats');
Route::get('/getUsers',function(){
    if(Auth::user()->gender == 'male')
    {
        $gen = 'female';
    }else {
        $gen = 'male';
    }
    $users = User::all()->where('gender',$gen)->where('district',Auth::user()->district)->sortByDesc('created_at')->take(25);
    return view('third',compact('users'));
})->name('getUsers');

Route::get('/gotResult','HomeController@gofourth')->name('goFourth');

Route::post('/stock','HomeController@stockRef')->name('stock'); 
Route::post('/sendIds' , 'HomeController@getIds');
Route::post('/updateFeats' , 'HomeController@updateSideFeats');

// Route::post('/getgenderAge' , 'HomeController@first');
// Route::post('/getuserFeats' , 'HomeController@second');

Route::get('/Questionnary',function(){
    return view('adds.quest');
})->name('Questionnary');
Route::get('feat','HomeController@feats');

Route::get('/setLang/{lang}',function($lang){
    
    // dd(session()->get('locale'));
    App::setLocale($lang);
        session()->put('lang', $lang);
        // dd(App::getLocale());
        return redirect()->back();
});

// Route::get('csv','HomeController@csv');
// Route::get('csv2','HomeController@csv2');
// Route::get('pred','predController@prediction');
// Route::get('/chat','HomeController@chat');
// Route::get('/inde',function(){
//     return view('index');
// });

Auth::routes();

