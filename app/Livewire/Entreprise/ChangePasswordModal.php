<?php

namespace App\Livewire\Entreprise;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Livewire\UtilsSweetAlert;

class ChangePasswordModal extends Component
{
    use UtilsSweetAlert;

    public $showModal = false;
    public $ancien_mdp = '';
    public $nouveau_mdp = '';
    public $confirmation_mdp = '';

    // Critères de validation
    public $hasMinLength = false;
    public $hasUppercase = false;
    public $hasLowercase = false;
    public $hasNumber = false;
    public $hasSpecialChar = false;

    protected $rules = [
        'ancien_mdp' => 'required',
        'nouveau_mdp' => 'required|min:10',
        'confirmation_mdp' => 'required|same:nouveau_mdp',
    ];

    protected $messages = [
        'ancien_mdp.required' => 'L\'ancien mot de passe est requis',
        'nouveau_mdp.required' => 'Le nouveau mot de passe est requis',
        'nouveau_mdp.min' => 'Le mot de passe doit contenir au moins 10 caractères',
        'confirmation_mdp.required' => 'La confirmation est requise',
        'confirmation_mdp.same' => 'Les mots de passe ne correspondent pas',
    ];

    public function mount()
    {
        $entreprise = Auth::guard('entreprise')->user();

        if ($entreprise && !$entreprise->changed_first_password) {
            $this->showModal = true;
        }
    }

    public function updatedNouveauMdp($value)
    {
        $this->checkPasswordStrength($value);
    }

    private function checkPasswordStrength($password)
    {
        $this->hasMinLength = strlen($password) >= 10;
        $this->hasUppercase = preg_match('/[A-Z]/', $password);
        $this->hasLowercase = preg_match('/[a-z]/', $password);
        $this->hasNumber = preg_match('/[0-9]/', $password);
        $this->hasSpecialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
    }

    public function changePassword()
    {
        dd('here');

        $this->validate();

        $entreprise = Auth::guard('entreprise')->user();

        // Vérifier l'ancien mot de passe
        if (!Hash::check($this->ancien_mdp, $entreprise->password)) {
            $this->addError('ancien_mdp', 'L\'ancien mot de passe est incorrect');
            return;
        }

        // Vérifier tous les critères
        if (!$this->isPasswordValid()) {
            $this->send_event_at_toast('Le mot de passe ne respecte pas tous les critères', 'error', 'top-end');
            return;
        }

        // Mettre à jour le mot de passe
        $entreprise->update([
            'password' => Hash::make($this->nouveau_mdp),
            'changed_first_password' => true,
        ]);

        session()->regenerate();

        $this->showModal = false;
        $this->reset(['ancien_mdp', 'nouveau_mdp', 'confirmation_mdp']);

        $this->send_event_at_toast('Mot de passe modifié avec succès !', 'success', 'top-end');
    }

    private function isPasswordValid()
    {
        return $this->hasMinLength &&
               $this->hasUppercase &&
               $this->hasLowercase &&
               $this->hasNumber &&
               $this->hasSpecialChar;
    }

    public function render()
    {
        return view('livewire.entreprise.change-password-modal');
    }
}
