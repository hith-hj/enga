<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class notifier implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $reciver;
    public $type;
    public $content;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender = '' , $reciver = '' , $type = '' , $content = '')
    {
        $this->sender = $sender;
        $this->reciver = $reciver;
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notifi');
    }
}
