<?php
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



new Class extends Component {

    public $email;
    public $password;
    public $messageError;


    public function login(){
        $this->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required',],
            ],[
                'email.required' => 'L\'adresse Email est obligatoire',
                'password.required' => 'Le mot de passe est obligatoire',
                'email.email' => 'Email n\'est pas valide',
                'email.string' => 'Email n\'est pas valide',
            ]);


            if($this->email){
                $user = User::where('email', $this->email)->first();
            }elseif($this->phone){
                $user = User::where('phone', $this->phone)->first();
            }

            if(!$user){
                $this->messageError = "Ce compte n'existe pas !!";
                return false;
            }

            if (auth('web')->attempt(['email' => $this->email, 'password' => $this->password])) {
                // Log
                // ActivityLog("Connexion via email et mot de passe", "Admin");

                return  redirect()->route('dashboard.home');
            }else{
                $this->messageError = "Les informations que vous avez entrez ne correspondent pas !!";
            }
    }

    public function with(): array
    {
        return [

        ];
    }
}

?>



 <!-- auth-page content -->
 <div class="auth-page-content overflow-hidden pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="p-lg-5 p-4 auth-one-bg h-100">
                                <div class="bg-overlay"></div>
                                <div class="position-relative h-100 d-flex flex-column">
                                    <div class="mb-4">
                                        <a href="/" class="d-block">
                                           <img src="{{ asset('logo.jpg') }}" style="width: 25%;" alt="">
                                        </a>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="mb-3">
                                            <i class="ri-double-quotes-l display-4 text-success"></i>
                                        </div>

                                        <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <div class="carousel-inner text-center text-white-50 pb-5">
                                                <div class="carousel-item active">
                                                    <p class="fs-15 fst-italic">" Profitez d'un accès privilégié à votre tableau de bord d'administration! "</p>
                                                </div>
                                                <div class="carousel-item">
                                                    <p class="fs-15 fst-italic">" gérer efficacement les tâches et les données en temps réel."</p>
                                                </div>
                                                <div class="carousel-item">
                                                    <p class="fs-15 fst-italic">" Accédez à toutes les informations nécessaires pour prendre des décisions rapides et assurer le bon fonctionnement de votre système! "</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="p-lg-5 p-4">
                                <div>
                                    <h5 class="text-primary">De retour sur IVOIRE TRANSMISSION !</h5>
                                    <p class="text-muted mb-4">Connectez-vous pour continuer sur IVOIRE TRANSMISSION</p>

                                    @if ($messageError)
                                        <div class="alert alert-danger">
                                            <p>{{ $messageError }}</p>
                                        </div>
                                    @endif

                                </div>

                                <div class="mt-4">
                                    <form wire:submit.prevent="login">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" wire:model="email" id="email" placeholder="Entrer votre addresse email...">
                                            @error('email')
                                                <span class="feedback-text">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-pass-reset-cover.html" class="text-muted">mot de passe oublié?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Mot de passe</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" wire:model="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                @error('password')
                                                <span class="feedback-text">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">se souvenir de moi</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Connexion</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title"><a href="auth-signup-cover.html" class="fw-semibold text-primary text-decoration-underline"> Rénitialiser mon mot de passe</a></h5>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end auth page content -->

@push('styles')
    <style>
        .feedback-text{
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #f06548;
        }
    </style>
@endpush
