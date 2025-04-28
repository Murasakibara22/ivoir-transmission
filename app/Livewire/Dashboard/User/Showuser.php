<?php

namespace App\Livewire\Dashboard\User;

use App\Models\Note;
use App\Models\Favoris;
use App\Models\Produit;
use Livewire\Component;
use App\Models\Commande;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;

class Showuser extends Component
{
    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $show_user;

    public $currentPage = "Order";

    public function mount($user)  {
        $this->show_user = $user;
    }

    public function togglecurrentPage($name) {
        if($name != "Note" && $name != "Favoris"){
            $this->currentPage = "Order";
        }else{
            $this->currentPage = $name ;
        }
    }



    public function render()
    {
        return view('livewire.dashboard.user.showuser',[
            'list_order_user' => Commande::where('user_id',$this->show_user->id)->OrderBy('created_at','DESC')->paginate(20),
            'list_favoris_user' => Produit::select('produits.*', 'favoris.id as idFav', 'favoris.produit_id', 'favoris.user_id')
                                    ->join('favoris', 'favoris.produit_id', '=', 'produits.id')
                                    ->where('favoris.user_id','=',$this->show_user->id)
                                    ->paginate(20),
            'list_avis' =>  Note::where('user_id',$this->show_user->id)->OrderBy('created_at','DESC')->paginate(20)
        ]);
    }
}
