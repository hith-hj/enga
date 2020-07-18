<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Utility;
use App\User;
use Auth;

class Utilities extends Component
{
    public $type;
    protected $util;

    public function mount($type){
        $this->type = $type;
    }

    public function getUtil()
    {
        $utl = Utility::utilities();
        if($this->type == 'all'){
            $utl = $utl->filter(function($ut){
                $ut->user_id == Auth::user()->id ?$ut['by'] = 'me' : $ut['by'] = 'you';
                $ut->sender = User::find($ut->user_id);
                $ut->reciver = User::find($ut->reciver_id);
                return $ut;
             });
            $this->util = $utl;
        } else {
           $utl = $utl->filter(function($ut){
               if($ut->type == $this->type )
               {
                    $ut->user_id == Auth::user()->id ?$ut['by'] = 'me' : $ut['by'] = 'you';
                    $ut->sender = User::find($ut->user_id);
                    $ut->reciver = User::find($ut->reciver_id);
                    return $ut;
               }
            });
            $this->util = $utl->shuffle()->sortByDesc('updated_at')->reverse();
        }
    }

    public function setView($id = '')
    {
        $up = Utility::find($id);
        if($up !== null || !empty($up))
        {
            $up->viewed = 1;
            $up->save();
        }
    }

    public function response($id='' , $type ='')
    {
        if($id == '' || $type == '')
        {
            return dd('Parameter Missing');
        }
        $edi = Utility::find($id);
        $edi->response = $type;
        $edi->status = 'done';
        $edi->save();
        $this->emitTo("sidenav", "resetVars", "util");
        return $this->emit('feelingSent', $type);
    }

    public function cancelReq($id = '')
    {
        if($id !== '')
        {
            return Utility::find($id)->delete();
        }        
    }

    public function render()
    {        
        $this->getUtil();
        return view('livewire.utilities',['utliti'=>$this->util]);
    }
}
