<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Message;
use App\User;
use App\Chat;
use Auth;
class Chats extends Component
{

    protected $uid;
    protected $chats;

    public function mount()
    {
        $this->getChats();
    }

    public function hydrate()
    {
        $this->getChats();
    }

    public function getChats()
    {
        $chats = Chat::chats();
        $chats->filter(function ($chat){
            $chat->user_id == Auth::user()->id ? $chat->by = 'me' : $chat->by = 'you';
            $chat->first = User::find($chat->user_id);
            $chat->second = User::find($chat->second_id);
            $chat->msg = Message::where('chat_id',$chat->id)->orderByDesc('created_at')->first() ?? NULL;
        });
        $this->chats = $chats;   
    }

    public function render()
    {
        return view('livewire.chats',['chats'=>$this->chats] );
    }
}
