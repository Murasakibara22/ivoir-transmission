<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\EntrepriseOTP;

new class extends Component {

    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    public bool $isLoading = false;
    public string $errorMessage = '';

    // OTP
    public bool $showOtpSection = false;
    public array $otpDigits = ['', '', '', '', '', ''];
    public string $otpError = '';
    public int $otpResendCountdown = 0;
    public $tempEntreprise = null;
    public bool $showPassword = false;

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
        $this->validateOnly($propertyName);

        if ($this->errorMessage) {
            $this->errorMessage = '';
        }
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function login()
    {
        $this->isLoading = true;
        $this->errorMessage = '';

        try {
            $this->validate();

            $credentials = [
                'email' => $this->email,
                'password' => $this->password,
            ];

            if (Auth::guard('entreprise')->attempt($credentials, false)) {
                $entreprise = Auth::guard('entreprise')->user();

                if (!$entreprise) {
                    Auth::guard('entreprise')->logout();
                    throw ValidationException::withMessages([
                        'email' => 'Accès réservé aux comptes entreprise.',
                    ]);
                }

                if ($entreprise->status !== 'ACTIVATED') {
                    Auth::guard('entreprise')->logout();
                    $this->errorMessage = 'Votre compte n\'est pas encore activé. Contactez l\'administrateur.';
                    $this->isLoading = false;
                    return;
                }

                Auth::guard('entreprise')->logout();

                $this->tempEntreprise = $entreprise;
                $this->sendOTP($entreprise);

                $this->showOtpSection = true;
                $this->isLoading = false;
                $this->dispatch('focusFirstOtpInput');

            } else {
                $this->errorMessage = 'Email ou mot de passe incorrect.';
                $this->isLoading = false;
            }

        } catch (ValidationException $e) {
            $this->errorMessage = $e->getMessage();
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Une erreur est survenue. Veuillez réessayer.';
            $this->isLoading = false;
        }
    }

    private function sendOTP($entreprise)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $entreprise->otp = $otp;
        $entreprise->otp_expired_at = now()->addMinutes(10);
        $entreprise->save();

        try {
            Mail::to($entreprise->email)->send(new EntrepriseOTP($entreprise, $otp));
        } catch (\Exception $e) {
            \Log::error('Erreur envoi OTP: ' . $e->getMessage());
        }

        $this->otpResendCountdown = 60;
        $this->dispatch('startOtpCountdown');
    }

    public function decrementCountdown()
    {
        if ($this->otpResendCountdown > 0) {
            $this->otpResendCountdown--;
        }
    }

    public function verifyOTP()
    {
        $this->isLoading = true;
        $this->otpError = '';

        $otpCode = implode('', $this->otpDigits);

        if (strlen($otpCode) !== 6) {
            $this->otpError = 'Veuillez saisir les 6 chiffres du code.';
            $this->isLoading = false;
            return;
        }

        $entreprise = \App\Models\Entreprise::find($this->tempEntreprise->id);

        if ($entreprise->otp_expired_at && now()->greaterThan($entreprise->otp_expired_at)) {
            $this->otpError = 'Le code a expiré. Veuillez demander un nouveau code.';
            $this->isLoading = false;
            return;
        }

        if ($entreprise->otp === $otpCode) {
            $entreprise->otp_validated_at = now();
            $entreprise->otp = null;
            $entreprise->otp_expired_at = null;
            $entreprise->save();

            Auth::guard('entreprise')->login($entreprise, $this->remember);
            session()->regenerate();

            // if (!$entreprise->changed_first_password) {
            //     return redirect()->route('entreprise.profile.index')
            //         ->with('first_login', true)
            //         ->with('message', 'Bienvenue ! Pour votre sécurité, veuillez modifier votre mot de passe.');
            // }

            return redirect()->route('entreprise.dashboard.index');

        } else {
            $this->otpError = 'Code incorrect. Veuillez réessayer.';
            $this->isLoading = false;
        }
    }

    public function resendOTP()
    {
        if ($this->otpResendCountdown > 0) {
            return;
        }

        $this->otpError = '';
        $entreprise = \App\Models\Entreprise::find($this->tempEntreprise->id);

        if ($entreprise) {
            $this->sendOTP($entreprise);
            $this->otpDigits = ['', '', '', '', '', ''];
            $this->dispatch('focusFirstOtpInput');
        }
    }

    public function backToLogin()
    {
        $this->showOtpSection = false;
        $this->otpDigits = ['', '', '', '', '', ''];
        $this->otpError = '';
        $this->tempEntreprise = null;
    }

    public function mount()
    {
        if (Auth::guard('entreprise')->check()) {
            $this->redirectRoute('entreprise.dashboard.index');
        }
    }

}; ?>

<div>
    @if(!$showOtpSection)
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
                        {{ $isLoading ? 'disabled' : '' }}
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
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                    Mot de passe
                </label>
                <div class="relative">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        id="password"
                        wire:model.live.debounce.300ms="password"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 input-focus transition-all duration-300 @error('password') border-red-500/50 @enderror"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        {{ $isLoading ? 'disabled' : '' }}
                    >
                    <button
                        type="button"
                        wire:click="togglePassword"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                        {{ $isLoading ? 'disabled' : '' }}
                    >
                        @if($showPassword)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        @endif
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
                        {{ $isLoading ? 'disabled' : '' }}
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
                {{ $isLoading ? 'disabled' : '' }}
            >
                <span class="flex items-center justify-center">
                    @if($isLoading)
                        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Connexion...</span>
                    @else
                        <span>Se connecter</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    @endif
                </span>
            </button>
        </form>
    @else
        <!-- OTP Verification Section -->
        <div class="space-y-6">
            <!-- Header -->
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Vérification de sécurité</h3>
                <p class="text-gray-400 text-sm">
                    Nous avons envoyé un code à 6 chiffres à<br>
                    <span class="text-blue-400 font-medium">{{ $tempEntreprise->email }}</span>
                </p>
            </div>

            <!-- OTP Error Message -->
            @if($otpError)
                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-red-400 text-sm">{{ $otpError }}</span>
                    </div>
                </div>
            @endif

            <!-- OTP Input Fields -->
            <div class="flex justify-center gap-3">
                @foreach(range(0, 5) as $index)
                    <input
                        type="text"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]"
                        wire:model="otpDigits.{{ $index }}"
                        id="otp-{{ $index }}"
                        class="w-12 h-14 text-center text-2xl font-bold bg-white/5 border-2 border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition-all duration-300"
                        {{ $isLoading ? 'disabled' : '' }}
                    >
                @endforeach
            </div>

            <!-- Verify Button -->
            <button
                wire:click="verifyOTP"
                class="w-full py-3 px-4 btn-primary text-white font-medium rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
                {{ $isLoading ? 'disabled' : '' }}
            >
                <span class="flex items-center justify-center">
                    @if($isLoading)
                        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Vérification...</span>
                    @else
                        <span>Vérifier le code</span>
                    @endif
                </span>
            </button>

            <!-- Resend & Back -->
            <div class="text-center space-y-3">
                <div>
                    @if($otpResendCountdown > 0)
                        <span class="text-sm text-gray-500">
                            Renvoyer dans <span id="countdown">{{ $otpResendCountdown }}</span>s
                        </span>
                    @else
                        <button
                            wire:click="resendOTP"
                            class="text-sm text-blue-400 hover:text-blue-300 transition-colors"
                        >
                            Renvoyer le code
                        </button>
                    @endif
                </div>

                <button
                    wire:click="backToLogin"
                    class="text-sm text-gray-400 hover:text-white transition-colors flex items-center justify-center mx-auto"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la connexion
                </button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
// Variable globale pour le timer
let otpCountdownTimer = null;

// Initialiser les inputs OTP
function initOtpInputs() {
    const otpInputs = document.querySelectorAll('[id^="otp-"]');

    if (otpInputs.length === 0) return;

    otpInputs.forEach((input, index) => {
        // Retirer les anciens listeners pour éviter les doublons
        const newInput = input.cloneNode(true);
        input.parentNode.replaceChild(newInput, input);

        // Ajouter les nouveaux listeners
        newInput.addEventListener('input', function(e) {
            // Ne garder que les chiffres
            this.value = this.value.replace(/[^0-9]/g, '');

            // Dispatch l'événement Livewire
            this.dispatchEvent(new Event('input', { bubbles: true }));

            // Passer au champ suivant si rempli
            if (this.value.length === 1 && index < 5) {
                const nextInput = document.getElementById(`otp-${index + 1}`);
                if (nextInput) {
                    nextInput.focus();
                    nextInput.select();
                }
            }
        });

        newInput.addEventListener('keydown', function(e) {
            // Retour arrière - revenir au champ précédent
            if (e.key === 'Backspace') {
                if (!this.value && index > 0) {
                    const prevInput = document.getElementById(`otp-${index - 1}`);
                    if (prevInput) {
                        prevInput.focus();
                        prevInput.select();
                    }
                }
            }

            // Flèches gauche/droite
            if (e.key === 'ArrowLeft' && index > 0) {
                document.getElementById(`otp-${index - 1}`).focus();
            }
            if (e.key === 'ArrowRight' && index < 5) {
                document.getElementById(`otp-${index + 1}`).focus();
            }
        });

        newInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');

            // Remplir les champs avec les données collées
            for (let i = 0; i < Math.min(pastedData.length, 6); i++) {
                const input = document.getElementById(`otp-${i}`);
                if (input) {
                    input.value = pastedData[i];
                    // Trigger Livewire update
                    const event = new Event('input', { bubbles: true });
                    input.dispatchEvent(event);
                }
            }

            // Focus sur le dernier champ rempli ou le suivant
            const lastFilledIndex = Math.min(pastedData.length - 1, 5);
            const targetIndex = pastedData.length < 6 ? Math.min(pastedData.length, 5) : 5;
            const targetInput = document.getElementById(`otp-${targetIndex}`);
            if (targetInput) {
                targetInput.focus();
                targetInput.select();
            }
        });
    });
}

// Fonction pour démarrer le compte à rebours
function startOtpCountdown() {
    // Nettoyer l'ancien timer s'il existe
    if (otpCountdownTimer) {
        clearInterval(otpCountdownTimer);
    }

    let countdown = 60;
    const countdownElement = document.getElementById('countdown');

    if (countdownElement) {
        countdownElement.textContent = countdown;
    }

    otpCountdownTimer = setInterval(() => {
        countdown--;

        if (countdownElement) {
            countdownElement.textContent = countdown;
        }

        if (countdown <= 0) {
            clearInterval(otpCountdownTimer);
            otpCountdownTimer = null;

            // Notifier Livewire
            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch('countdown-finished');
            }
        }
    }, 1000);
}

// Écouter les événements Livewire
document.addEventListener('livewire:init', () => {
    // Événement pour focus sur premier input
    Livewire.on('focusFirstOtpInput', () => {
        setTimeout(() => {
            initOtpInputs();
            const firstInput = document.getElementById('otp-0');
            if (firstInput) {
                firstInput.focus();
                firstInput.select();
            }
        }, 100);
    });

    // Événement pour démarrer le compte à rebours
    Livewire.on('startOtpCountdown', () => {
        setTimeout(() => {
            startOtpCountdown();
        }, 100);
    });
});

// Réinitialiser les inputs après chaque update Livewire
document.addEventListener('livewire:update', () => {
    const otpInputs = document.querySelectorAll('[id^="otp-"]');
    if (otpInputs.length > 0) {
        initOtpInputs();
    }
});

// Initialisation au chargement de la page
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initOtpInputs);
} else {
    initOtpInputs();
}
</script>
@endpush
