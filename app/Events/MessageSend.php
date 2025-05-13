<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSend implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;
    public $reservationSlug;
    /**
     * Create a new event instance.
     */
    public function __construct($userId, $message, $reservationSlug)
    {
        $this->userId = $userId ;
        $this->message = $message;
        $this->reservationSlug = $reservationSlug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return
            new PrivateChannel("user.{$this->userId}");
    }

    public function broadcastAs()
    {
        return 'private-notification';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'meta_data' => $this->reservationSlug
        ];
    }


}
