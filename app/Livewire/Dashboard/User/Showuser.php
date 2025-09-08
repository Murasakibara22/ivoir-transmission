<?php

namespace App\Livewire\Dashboard\User;


use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;
use App\Models\User;

class Showuser extends Component
{
    use WithPagination, UtilsSweetAlert;

    public $show_user;
    public $currentPage = 'reservations';

    protected $paginationTheme = 'bootstrap';

    public function mount(User $user)
    {
        $this->show_user = $user;
    }

    public function togglecurrentPage($page)
    {
        $this->currentPage = $page;
        $this->resetPage(); // évite de rester bloqué sur une page inexistante
    }


    public function render()
    {
        return view('livewire.dashboard.user.showuser', [
            'list_reservations' => $this->show_user->reservation()->latest()->paginate(10),
            'list_paiements'    => $this->show_user->paiements()->latest()->paginate(10),
            'list_notes'        => $this->show_user->note()->latest()->get(),
        ]);
    }
}
