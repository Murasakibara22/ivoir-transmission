<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

class Allcontact extends Component
{
    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Locked]
    public $id_contact ;

    public $search = '';
    public $selected_contact ;

    public function viewContact($id)  {
        $contact = Contact::find($id);
        if(!$contact) {
            $this->send_event_at_toast('Contact inexistant', 'error', 'top-right');
            return ;
        }
        $this->id_contact = $id;
        $this->selected_contact = $contact;
    }

    public function deleteContact($id)  {
        $contact = Contact::find($id);
        if(!$contact) {
            $this->send_event_at_toast('Contact inexistant', 'error', 'top-right');
            return ;
        }

        $this->id_contact = $id;
        $this->sweetAlert_confirm_options($contact, 'Suppression du contact', 'Etes-vous sur de vouloir supprimer ce contact : '.$contact->nom.' ?', 'destroyContact', 'error');
    }

    #[On('destroyContact')]
    public function destroyContact()  {
        $contact = Contact::find($this->id_contact);
        if(!$contact) {
            $this->send_event_at_toast('Contact inexistant', 'error', 'top-right');
            return ;
        }
        if($contact->id == $this->selected_contact->id) {
            $this->selected_contact = null;
        }
        $contact->delete();
        $this->send_event_at_toast('Contact supprimé avec succès', 'success', 'top-right');
    }

    public function render()
    {
        return view('livewire.dashboard.contact.allcontact', [
            'list_contact' => Contact::OrderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
