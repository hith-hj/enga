<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Auth;

class Sidenav extends Component
{
    public $utilNoti ;
    public $matchNoti ;
    public $matchStat ;
    public $chatNoti ;

    public function mount()
    {
        $this->utilNoti = '';
        $this->matchNoti = '';
        $this->chatNoti = false;
    }

    public function getListeners()
    {
        return [
            "resetVars" => 'resetVars',
            "echo:notifi,notifier" => 'notifier',
        ];
    }

    public function notifier($data)
    {
        if($data['reciver'] == Auth::user()->id)
        {
            switch ($data['type']) {
            case 'Match':
                $content = \explode('/',$data['content']);
                $this->updateMatch($data['content']);
                break; 
            case 'Chat':
                $this->updateChat();
                break;  
            case 'Utility':
                $this->updateUtiliti($data['content']);
                break;   
            case 'message':
                $this->updateChat();
                break;   
            }
        }
    }

    public function resetVars($type)
    {
        // dd('here',$type);
        switch ($type) {
            case 'match':
                $this->matchNoti = '';
                $this->matchStat = '';
                break;
            case 'util':
                $this->utilNoti = '';
                break;
            case 'chat':
                $this->chatNoti = false;
                break;
        }
    }

    public function updateMatch($data)
    {
        // dd(strpbrk($data,'/'),$data);
        if(strpbrk($data,'/') == false)
        {
            return $this->matchNoti = 'new' ;
        }else {
            $type = \explode('/',$data);
            // dd($type);
            $this->matchStat = $type[1];
            return $this->matchNoti = $type[0];
        }
    }

    public function updateChat()
    {
        return $this->chatNoti = true;
    }

    public function updateUtiliti($data)
    {
        return $this->utilNoti = $data;
    }

    public function render()
    {
        return view('livewire.sidenav');
    }
}
