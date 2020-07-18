<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Notify;
use App\Message;
use App\User;
use Auth;

class Topnav extends Component
{
    protected $notis;
    protected $msgs;

    public function getupdates()
    {
        $this->getNotification();
        $this->getMsgs();
    }

    public function getNotification()
    { 
        $this->notis = Notify::getNotification();
    }

    public function getMsgs()
    {
        $this->msgs = Message::getMessages();
        if(count($this->msgs)>0)
        {
            $this->msgs->filter(function($msg){
                $msg->viewed = 1;
                $msg->save();
                $msg->user = User::find($msg->user_id);
            });
        }
    }

    public function setViewed(int $id , String $type) : void
    {
        if($id == 0 || $id == null){
            $this->emit('error', 'you didn\'t pass any parameter');
            return;
        }
        $nt = Notify::find($id);
        $nt->viewed = 1;
        $nt->save();
        return;
    }

    public function getListeners()
    {
        return [
            "echo:notifi,notifier" => 'notify',
            "msg"=>"newMsg",
        ];
    }
    
    public function notify($data)
    {
        if($data['reciver'] == Auth::user()->id)
        {
            $user = User::find($data['sender']);
            $this->emit('notifier',$data['type'], $data['content'] , $user->name);
        }
        return;
    }

    public function newMsg()
    {
        
    }

    public function render()
    {
        
        $this->getupdates();
        return view('livewire.topnav',['notis'=>$this->notis , 'msgs'=>$this->msgs]);
    }
}
