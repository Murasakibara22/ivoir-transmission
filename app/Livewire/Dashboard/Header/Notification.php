<?php

namespace App\Livewire\Dashboard\Header;

use Livewire\Component;
use App\Models\NotificationAdmin;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.dashboard.header.notification',[
            'list_notification' => NotificationAdmin::where('is_read', false)->OrderByDesc('created_at')->get(),
        ]);
    }
}
