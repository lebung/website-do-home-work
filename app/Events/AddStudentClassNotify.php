<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddStudentClassNotify
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public mixed $title;

    public mixed $class;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $data)
    {
        $this->title = $data['title'];
        $this->class = $data['class'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('send-student-class');
        // return ['send-student-class'];
    }
}
