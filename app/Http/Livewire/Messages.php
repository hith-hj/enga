<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\msg;
use App\Events\online;
use App\Events\typing;
use App\Events\notifier;
use App\User;
use App\Chat;
use App\Message;
use App\Notify;
use Auth;

class Messages extends Component
{
    protected $msgs;
    protected $user;
    public $chatId;
    public $typing = false;
    public $online= false;
    public $content;


    public function mount($id)
    {
        $this->chatId = $id;
    }
    public function hydrate(){
        $this->start();
    }
    public function start()
    {
        $user = Chat::find($this->chatId);
        if($user->user_id == Auth::user()->id)
        {
            $this->user = User::find($user->second_id);
        }else {
            $this->user = User::find($user->user_id);
        }
        $this->fetchMsg();
        // broadcast(new online($this->chatId,Auth::user()->id));
    }

    public function updatingContent()
    {
        broadcast(new typing($this->chatId,Auth::user()->id));
    }
    
    public function updatedContent()
    {
        broadcast(new typing($this->chatId,Auth::user()->id,false));
    }

    public function getListeners()
    {
        return [ 
            "echo:chat.{$this->chatId},msg" => 'fetchMsg',
            "echo:chat.{$this->chatId},typing" => 'typing',
            "echo:chat.{$this->chatId},online" => 'online',
        ];
    }

    public function online($data)
    {
        if($data['uid'] !== Auth::user()->id && $data['stat'] == true){
            $this->online = true;
            broadcast(new online($this->chatId,Auth::user()->id));
        } else {
            $this->online = false;
        }
    }

    public function typing($data)
    {
        if($data['uid'] != Auth::user()->id && $data['stat'] == true){
           $this->online = true;
           $this->typing = true; 
        }else {
            $this->typing = false; 
        }
    }

    public function sendMsg()
    {
        if($this->content == ''){
            return;
        }        
        Message::create([
            'chat_id'=>$this->chatId,
            'user_id'=>Auth::user()->id,
            'reciver_id'=>$this->user->id,
            'message'=>$this->content,
            'status'=>'done',
            'viewed'=>1,
            'done_by'=>'none'
        ]);
        $ch = Chat::find($this->chatId);
        $ch->msgsCount += 1;
        $ch->save();
        $this->content = '';
        if($this->online != true )
        {
            Notify::storeNotification(Auth::user()->id,$this->user->id,'Message',$this->content);
            \broadcast(new notifier(Auth::user()->id,$this->user->id,'message',$this->content))->toOthers();
        }        
        return broadcast(new msg($this->chatId))->toOthers();
    }

    public function fetchMsg($data = [])
    {
        $msgs = @Message::all()->where('chat_id',$this->chatId) ?: NULL;
        if($msgs == NULL)
        {
            return $this->msgs = [];
        }
        $msgs->filter(function($msg){
            if($msg->user_id != Auth::user()->id && $msg->viewed == 1){
                $msg->viewed = 2;
                $msg->save();
            }
        });
        $this->emit('scrollDown', $this->chatId);
        $this->msgs = $msgs;
    }

    public function render()
    {
        $this->start();
        return view('livewire.messages',['msgs'=>$this->msgs,'user'=>$this->user]);
    }
}
