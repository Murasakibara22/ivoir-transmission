<?php

namespace App\Livewire\Entreprise;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordModal extends Component
{
    public $showModal = false;
    public $isFirstLogin = false;

    public $ancien_mdp = '';
    public $nouveau_mdp = '';
    public $confirmation_mdp = '';

    public $isLoading = false;
    public $errorMessage = '';
    public $showAncienPassword = false;
    public $showNouveauPassword = false;
    public $showConfirmationPassword = false;

    // Critères de sécurité
    public $hasMinLength = false;
    public $hasUppercase = false;
    public $hasLowercase = false;
    public $hasNumber = false;
    public $hasSpecialChar = false;
    public $passwordsMatch = false;

    protected $rules = [
        'ancien_mdp' => 'required',
        'nouveau_mdp' => 'required|min:10',
        'confirmation_mdp' => 'required|same:nouveau_mdp',
    ];

    protected $messages = [
        'ancien_mdp.required' => 'L\'ancien mot de passe est obligatoire',
        'nouveau_mdp.required' => 'Le nouveau mot de passe est obligatoire',
        'nouveau_mdp.min' => 'Le mot de passe doit contenir au moins 10 caractères',
        'confirmation_mdp.required' => 'La confirmation est obligatoire',
        'confirmation_mdp.same' => 'Les mots de passe ne correspondent pas',
    ];

    public function mount()
    {
        $entreprise = Auth::guard('entreprise')->user();

        // Vérifier si c'est la première connexion
        if ($entreprise && !$entreprise->changed_first_password) {
            $this->showModal = true;
            $this->isFirstLogin = true;
        }
    }

    public function updatedNouveauMdp($value)
    {
        // Vérifier la longueur minimale (10 caractères)
        $this->hasMinLength = strlen($value) >= 10;

        // Vérifier la présence de majuscules
        $this->hasUppercase = preg_match('/[A-Z]/', $value);

        // Vérifier la présence de minuscules
        $this->hasLowercase = preg_match('/[a-z]/', $value);

        // Vérifier la présence de chiffres
        $this->hasNumber = preg_match('/[0-9]/', $value);

        // Vérifier la présence de caractères spéciaux
        $this->hasSpecialChar = preg_match('/[^A-Za-z0-9]/', $value);

        // Vérifier la correspondance avec la confirmation
        if ($this->confirmation_mdp) {
            $this->passwordsMatch = $value === $this->confirmation_mdp;
        }
    }

    public function updatedConfirmationMdp($value)
    {
        // Vérifier la correspondance
        $this->passwordsMatch = $this->nouveau_mdp === $value;
    }

    public function toggleAncienPassword()
    {
        $this->showAncienPassword = !$this->showAncienPassword;
    }

    public function toggleNouveauPassword()
    {
        $this->showNouveauPassword = !$this->showNouveauPassword;
    }

    public function toggleConfirmationPassword()
    {
        $this->showConfirmationPassword = !$this->showConfirmationPassword;
    }

    public function changePassword()
    {
        $this->isLoading = true;
        $this->errorMessage = '';

        try {
            // Valider tous les critères
            if (!$this->hasMinLength || !$this->hasUppercase || !$this->hasLowercase ||
                !$this->hasNumber || !$this->hasSpecialChar || !$this->passwordsMatch) {
                $this->errorMessage = 'Veuillez respecter tous les critères de sécurité.';
                $this->isLoading = false;
                return;
            }

            $this->validate();

            $entreprise = Auth::guard('entreprise')->user();

            // Vérifier l'ancien mot de passe
            if (!Hash::check($this->ancien_mdp, $entreprise->password)) {
                $this->addError('ancien_mdp', 'L\'ancien mot de passe est incorrect.');
                $this->isLoading = false;
                return;
            }

            // Vérifier que le nouveau mot de passe est différent de l'ancien
            if (Hash::check($this->nouveau_mdp, $entreprise->password)) {
                $this->errorMessage = 'Le nouveau mot de passe doit être différent de l\'ancien.';
                $this->isLoading = false;
                return;
            }

            // Mettre à jour le mot de passe
            $entreprise->password = Hash::make($this->nouveau_mdp);
            $entreprise->changed_first_password = true;
            $entreprise->save();

            // Fermer le modal et notifier
            $this->showModal = false;
            $this->reset(['ancien_mdp', 'nouveau_mdp', 'confirmation_mdp']);

            session()->flash('success', 'Mot de passe modifié avec succès !');

            $this->dispatch('password-changed');

        } catch (\Exception $e) {
            $this->errorMessage = 'Une erreur est survenue. Veuillez réessayer.';
            \Log::error('Erreur changement mot de passe: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function closeModal()
    {
        if ($this->isFirstLogin) {
            // Ne pas permettre de fermer si c'est la première connexion
            $this->errorMessage = 'Vous devez changer votre mot de passe pour continuer.';
            return;
        }

        $this->showModal = false;
        $this->reset(['ancien_mdp', 'nouveau_mdp', 'confirmation_mdp', 'errorMessage']);
    }

    public function render()
    {
        return view('livewire.entreprise.change-password-modal');
    }
}
