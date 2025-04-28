<?php

namespace App\Livewire\Dashboard\Produit;

use App\Models\Note;
use Livewire\Component;
use App\Models\VarianteProduit;
use App\Livewire\UtilsSweetAlert;

class Showproduit extends Component
{
    use UtilsSweetAlert;

    public $show_produit;
    public $show_couleurs, $view_video;


    public function mount($produit) {
        $this->show_produit = $produit;

        $couleurs = VarianteProduit::where('produit_id', $produit->id)->pluck('couleurs')
                ->flatMap(function ($json) {
                    return json_decode($json, true);
                })
                ->unique()
                ->values();

    $this->show_couleurs = $couleurs;
    // dd($this->show_produit->link_video);
    }

    public function render()
    {
        return view('livewire.dashboard.produit.showproduit',[
            'list_note' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->get(),
            'moyenne_note' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->avg('note'),
            'nb_person_note_five' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->where('note',5)->count(),
            'nb_person_note_four' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->where('note',4)->count(),
            'nb_person_note_three' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->where('note',3)->count(),
            'nb_person_note_two' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->where('note',2)->count(),
            'nb_person_note_one' => Note::where('produit_id', $this->show_produit->id)->where('status',Note::ACTIVATED)->where('note',1)->count(),
        ]);
    }
}
