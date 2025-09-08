<?php

namespace App\Livewire\Dashboard\Notification;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use App\Models\NotificationAdmin;

class Allnotification extends Component
{

    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Locked]
    public $id_notifications;

    public $search = '';
    public $selected_notification  ;

    public function viewNotification($id)  {
        $notification = NotificationAdmin::find($id);
        if(!$notification) {
            $this->send_event_at_toast('notification inexistant', 'error', 'top-right');
            return ;
        }
        $this->id_notifications = $id;
        $this->selected_notification = $notification;
        $notification->is_read = true;
        $notification->view_by = auth()->user()->id;
        $notification->view_at = now();
        $notification->save();

        $this->render();
    }



    public function deleteNotification($id)  {
        $notification = NotificationAdmin::find($id);
        if(!$notification) {
            $this->send_event_at_toast('notification inexistante', 'error', 'top-right');
            return ;
        }

        $this->id_notifications = $id;
        $this->sweetAlert_confirm_options($notification, 'Suppression du notification', 'Etes-vous sur de vouloir supprimer cette notification : '.$notification->title.' ?', 'destroyNotification', 'error');
    }

    #[On('destroyNotification')]
    public function destroyNotification()  {
        $notification = NotificationAdmin::find($this->id_notifications);
        if(!$notification) {
            $this->send_event_at_toast('notification inexistant', 'error', 'top-right');
            return ;
        }
        if($notification->id == $this->selected_notification?->id) {
            $this->selected_notification = null;
        }
        $notification->delete();
        $this->send_event_at_toast('notification supprimé avec succès', 'success', 'top-right');
    }

    public function render()
    {
        return view('livewire.dashboard.notification.allnotification', [
            'list_notification' => NotificationAdmin::where('title', 'like', '%' . $this->search . '%')->OrderBy('created_at', 'desc')->paginate(12),
        ]);
    }
}
