<?php

namespace App\Livewire\Entreprise;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Livewire\UtilsSweetAlert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class EntrepriseProfile extends Component
{
    use WithFileUploads, UtilsSweetAlert;

    // Informations générales
    public $name;
    public $phone;
    public $email;
    public $type;
    public $address_line;
    public $city;
    public $country;
    public $logo;
    public $newLogo;

    // Changement de mot de passe
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // États
    public $editingGeneral = false;
    public $editingPassword = false;

    public function mount()
    {
        $entreprise = auth('entreprise')->user();

        $this->name = $entreprise->name;
        $this->phone = $entreprise->phone;
        $this->email = $entreprise->email;
        $this->type = $entreprise->type;
        $this->logo = $entreprise->logo;

        $address = $entreprise->address ?? [];
        $this->address_line = $address['line'] ?? '';
        $this->city = $address['city'] ?? '';
        $this->country = $address['country'] ?? 'Côte d\'Ivoire';
    }

    public function toggleEditGeneral()
    {
        $this->editingGeneral = !$this->editingGeneral;

        if (!$this->editingGeneral) {
            $this->mount();
        }
    }

    public function toggleEditPassword()
    {
        $this->editingPassword = !$this->editingPassword;

        if (!$this->editingPassword) {
            $this->resetPasswordFields();
        }
    }

    public function updateGeneral()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'type' => 'required|string',
            'address_line' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
        ]);

        $entreprise = auth('entreprise')->user();

        $entreprise->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'type' => $this->type,
            'address' => [
                'line' => $this->address_line,
                'city' => $this->city,
                'country' => $this->country,
            ],
        ]);

        $this->editingGeneral = false;

        $this->send_event_at_sweetAlerte('Profil mis à jour avec succès !', 'votre profil a bien été mis à jour', 'success');
    }

    public function updateLogo()
    {
        $this->validate([
            'newLogo' => 'required|image|max:2048',
        ]);

        try {
            $entreprise = auth('entreprise')->user();

            $uploadedFileUrl =  Cloudinary::upload($this->newLogo->getRealPath(), [
                'folder' => 'ivoireTransmission',
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill',
                    'quality' => 'auto',
                ]
            ])->getSecurePath();

            if ($entreprise->logo) {
                $publicId = $this->extractPublicId($entreprise->logo);
                if ($publicId) {
                     Cloudinary::destroy($publicId);
                }
            }

            $entreprise->update(['logo' => $uploadedFileUrl]);

            $this->logo = $uploadedFileUrl;
            $this->newLogo = null;

            $this->send_event_at_sweetAlerte('Logo mis à jour avec succès !', 'Votre logo a bien été mis à jour', 'success');

        } catch (\Exception $e) {
            $this->error('Erreur lors de l\'upload du logo : ' . $e->getMessage());
        }
    }

    public function removeLogo()
    {
        $entreprise = auth('entreprise')->user();

        if ($entreprise->logo) {
            try {
                $publicId = $this->extractPublicId($entreprise->logo);
                if ($publicId) {
                     Cloudinary::destroy($publicId);
                }
            } catch (\Exception $e) {
                // Continuer même si la suppression échoue
            }

            $entreprise->update(['logo' => null]);
            $this->logo = null;

            $this->send_event_at_sweetAlerte('Logo supprimé avec succès !', 'Votre logo a bien été supprimé', 'success');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $entreprise = auth('entreprise')->user();

        if (!Hash::check($this->current_password, $entreprise->password)) {
            $this->addError('current_password', 'Le mot de passe actuel est incorrect.');
            return;
        }

        $entreprise->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->resetPasswordFields();
        $this->editingPassword = false;

        $this->send_event_at_sweetAlerte('Mot de passe modifié avec succès !', 'votre mot de passe a bien été modifié', 'success');
    }

    private function resetPasswordFields()
    {
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->resetErrorBag();
    }

    private function extractPublicId($url)
    {
        if (preg_match('/\/ivoireTransmission\/([^\/\.]+)/', $url, $matches)) {
            return 'ivoireTransmission/' . $matches[1];
        }
        return null;
    }

    public function render()
    {
        return view('livewire.entreprise.entreprise-profile');
    }
}
