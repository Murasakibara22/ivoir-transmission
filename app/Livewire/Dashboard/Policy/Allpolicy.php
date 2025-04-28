<?php

namespace App\Livewire\Dashboard\Policy;

use App\Models\Privacy;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\UtilsSweetAlert;

class Allpolicy extends Component
{
    use UtilsSweetAlert, WithFileUploads;

    public $description;

    public function addPrivacy()  {
        $this->resetSummernote("descriptionPrivacy");
        $this->launch_modal('add_privacy');
    }

    public function store(){
        $this->validate([
            'description' => 'required',
        ],[
            'description.required' => 'La description est obligatoire',
        ]);

        Privacy::create([
            'name' => 'Privacy Policy',
            'content' => $this->description
        ]);

        $this->send_event_at_toast('La politique de confidentialité a été ajouté avec succès', 'success', 'bottom-right');
        $this->reset();

        $this->resetSummernote("descriptionPrivacy");
    }

    public function edit(){
        $this->description = Privacy::where('name','Privacy Policy')->first()->content;

        $this->launch_modal('add_privacy');
    }

    public function updatePrivacy(){
        $this->validate([
            'description' => 'required',
        ],[
            'description.required' => 'La description est obligatoire',
        ]);

        Privacy::where('name','Privacy Policy')->first()->update([
            'content' => $this->description
        ]);

        $this->send_event_at_toast('La politique de confidentialité a été mise à jour avec succès', 'success', 'bottom-right');
        $this->reset();

        $this->resetSummernote("descriptionPrivacy");
    }


    public function render()
    {
        return view('livewire.dashboard.policy.allpolicy', [
            'list_privacy' => Privacy::where('name','Privacy Policy')->first()
        ]);
    }
}
