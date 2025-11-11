<?php

namespace App\Livewire\Dashboard\Notification;

use App\Models\Contrat;
use Livewire\Component;
use App\Models\Reservation;
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


    function viewReservation($notif)  {

        if($notif['meta_data_type'] == Reservation::class) {
             $meta_data_id = NotificationAdmin::find($notif['id'])->meta_data_id;
            // {{ route('admin.reservations.show', App\Models\Reservation::find($selected_notification->notif)->slug) }}

            if($meta_data_id == null) {
                return redirect()->route('dashboard.reservations.index');
            }

            return redirect()->route('dashboard.reservations.show', Reservation::where('slug',$meta_data_id)->first()->slug);
        }


        if($notif['meta_data_type'] == Contrat::class) {
             $meta_data_id = NotificationAdmin::find($notif['id'])->meta_data_id;
            // {{ route('admin.reservations.show', App\Models\Reservation::find($selected_notification->notif)->slug) }}

            if($meta_data_id == null) {
                return redirect()->route('dashboard.notifications.index');
            }
            return redirect()->route('dashboard.contrats.show', Contrat::where('slug',$meta_data_id)->first()->slug);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.notification.allnotification', [
            'list_notification' => NotificationAdmin::where('title', 'like', '%' . $this->search . '%')->OrderBy('created_at', 'desc')->paginate(12),
        ]);
    }
}
