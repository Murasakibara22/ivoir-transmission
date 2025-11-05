<?php

use Livewire\Volt\Component;

new class extends Component {


    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    public bool $isLoading = false;
    public string $errorMessage = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email' => 'Veuillez saisir une adresse email valide.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
    ];

    public function updated($propertyName)
    {
        // Validation en temps réel
        $this->validateOnly($propertyName);

        // Réinitialiser le message d'erreur quand l'utilisateur tape
        if ($this->errorMessage) {
            $this->errorMessage = '';
        }
    }

    public function login()
    {
        $this->isLoading = true;
        $this->errorMessage = '';

        try {
            // Validation des données
            $this->validate();

            // Tentative de connexion
            $credentials = [
                'email' => $this->email,
                'password' => $this->password,
            ];

            if (Auth::guard('entreprise')->attempt($credentials, $this->remember)) {
                // session()->regenerate();

                // Vérifier le rôle utilisateur (entreprise)
                $user = Auth::guard('entreprise')->user();
                if (!$user) {
                    Auth::guard('entreprise')->logout();
                    throw ValidationException::withMessages([
                        'email' => 'Accès réservé aux comptes entreprise.',
                    ]);
                }

                // Redirection vers le dashboard
                return redirect()->route('entreprise.dashboard.index');

            } else {
                $this->errorMessage = 'Email ou mot de passe incorrect.';
            }

        } catch (ValidationException $e) {
            $this->errorMessage = $e->getMessage();
        } catch (\Exception $e) {
            $this->errorMessage = 'Une erreur est survenue. Veuillez réessayer.'. $e->getMessage();
        } finally {
            $this->isLoading = false;
        }
    }

    public function mount()
    {
        // Rediriger si déjà connecté
        if (Auth::guard('entreprise')->check()) {
            $this->redirectRoute('entreprise.dashboard');
        }
    }

}; ?>

<div>


      <!-- Login Form -->
                <form wire:submit="login" class="space-y-6">
        <!-- Message d'erreur global -->
        @if($errorMessage)
            <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-red-400 text-sm">{{ $errorMessage }}</span>
                </div>
            </div>
        @endif

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                Email
            </label>
            <div class="relative">
                <input
                    type="email"
                    id="email"
                    wire:model.live.debounce.300ms="email"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 input-focus transition-all duration-300 @error('email') border-red-500/50 @enderror"
                    placeholder="votre@email.com"
                    autocomplete="email"
                    :disabled="$wire.isLoading"
                >
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
            </div>
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                Mot de passe
            </label>
            <div class="relative">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    id="password"
                    wire:model.live.debounce.300ms="password"
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 input-focus transition-all duration-300 @error('password') border-red-500/50 @enderror"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    :disabled="$wire.isLoading"
                >
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                    :disabled="$wire.isLoading"
                >
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    wire:model="remember"
                    class="w-4 h-4 bg-white/5 border-white/10 rounded focus:ring-blue-500 text-blue-600"
                    :disabled="$wire.isLoading"
                >
                <label for="remember" class="ml-2 text-sm text-gray-300">
                    Se souvenir
                </label>
            </div>
            <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                Mot de passe oublié ?
            </a>
        </div>

        <!-- Login Button -->
        <button
            type="submit"
            class="w-full py-3 px-4 btn-primary text-white font-medium rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
            :disabled="$wire.isLoading"
        >
            <span class="flex items-center justify-center">
                <!-- Loading Spinner -->
                <svg
                    x-show="$wire.isLoading"
                    class="animate-spin -ml-1 mr-3 h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    style="display: none;"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <span x-show="!$wire.isLoading">Se connecter</span>
                <span x-show="$wire.isLoading" style="display: none;">Connexion...</span>

                <svg x-show="!$wire.isLoading" class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </span>
        </button>
    </form>


</div>
