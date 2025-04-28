<div>
    <div class="page-content">
        <div class="container-fluid">

            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="{{ asset('assets/images/profile-bg.jpg')}}" class="profile-wid-img" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img @if(auth()->user()->photo_url) src="{{ asset('images/Admin/'.auth()->user()->photo_url) }}" @else src="https://api.dicebear.com/7.x/initials/svg?seed={{ auth()->user()->username }}" @endif class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                                <p class="text-muted mb-0">{{ auth()->user()->email  }}</p>
                            </div>
                        </div>
                    </div>


                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if($currentPage == 'profile') active @endif" wire:click="toggleSection('profile')" href="javascript:void(0);" role="tab">
                                        <i class="fas fa-home"></i> Détail Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if($currentPage == 'password') active @endif" wire:click="toggleSection('password')" href="javascript:void(0);" role="tab">
                                        <i class="far fa-user"></i> Change Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if($currentPage == 'privacy') active @endif" wire:click="toggleSection('privacy')" href="javascript:void(0);" role="tab">
                                        <i class="far fa-envelope"></i> Privacy Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane  @if($currentPage == 'profile') active @endif"  role="tabpanel">
                                    <form wire:submit.prevent="updateProfile">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="firstnameInput" placeholder="Entrer votre nom" wire:model="nom">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="lastnameInput" class="form-label">Prenoms</label>
                                                    <input type="text" class="form-control" id="lastnameInput" placeholder="Entrer votre prenom" wire:model="prenom">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">CVC</label>
                                                                <select  class="form-select mb-3" wire:model='dial_code'>
                                                                    <option value="">Select</option>
                                                                        <option value="+225">
                                                                           +225
                                                                        </option>
                                                                </select>
                                                                @error('dial_code')
                                                                <div class="feedback-text">{{ $message }}</div>
                                                                @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Contact</label>
                                                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Entrer votre contact" wire:model="phone_number">
                                                    @error('phone_number')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="emailInput" placeholder="Entrer votre email" wire:model="email">
                                                    @error('email')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="JoiningdatInput" class="form-label">Genre</label>
                                                    <select class="form-select" id="JoiningdatInput" wire:model="gender">
                                                        <option selected>Select</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane @if($currentPage == 'password') active @endif"  role="tabpanel">
                                    <form wire:submit.prevent="updatePassword">
                                        <div class="row g-2">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="oldpasswordInput" class="form-label">Mot de passe actuel*</label>
                                                    <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password" wire:model="old_password">
                                                    @error('old_password')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">Nouveau mot de passe*</label>
                                                    <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password" wire:model="new_password">
                                                    @error('new_password')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirmer le mot de passe*</label>
                                                    <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" wire:model="confirm_password">
                                                    @error('confirm_password')
                                                        <div class="feedback-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                    <div class="mt-4 mb-3 border-bottom pb-2">
                                        <div class="float-end">
                                            <a href="javascript:void(0);" class="link-primary">Voir tous </a>
                                        </div>
                                        <h5 class="card-title">Historique d'activiter</h5>
                                    </div>
                                    @if($historique_login && $historique_login->count() > 0)
                                    @foreach($historique_login as $login)
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                    <i class="ri-smartphone-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6>{{ $login->device }}</h6>
                                                <p class="text-muted mb-0">{{ $login->libelle_mouvement }} - {{ date('d, M Y H:i:s', strtotime($login->created_at)) }}</p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);">Logout</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif

                                </div>
                                <!--end tab-pane-->

                                <div class="tab-pane @if($currentPage == 'privacy') active show @endif"  role="tabpanel">
                                    <div class="mb-4 pb-2">
                                        <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                                <p class="text-muted">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Enable Two-facor Authentication</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                                <p class="text-muted">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set up secondary method</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Backup Codes</h6>
                                                <p class="text-muted mb-sm-0">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Generate backup codes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="directMessage" class="form-check-label fs-14">Direct messages</label>
                                                    <p class="text-muted">Messages from people you follow</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="directMessage" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="desktopNotification">
                                                        Show desktop notifications
                                                    </label>
                                                    <p class="text-muted">Choose the option you want as your default setting. Block a site: Next to "Not allowed to send notifications," click Add.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="desktopNotification" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="emailNotification">
                                                        Show email notifications
                                                    </label>
                                                    <p class="text-muted"> Under Settings, choose Notifications. Under Select an account, choose the account to enable notifications for. </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="emailNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="chatNotification">
                                                        Show chat notifications
                                                    </label>
                                                    <p class="text-muted">To prevent duplicate mobile notifications from the Gmail and Chat apps, in settings, turn off Chat notifications.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="chatNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="purchaesNotification">
                                                        Show purchase notifications
                                                    </label>
                                                    <p class="text-muted">Get real-time purchase alerts to protect yourself from fraudulent charges.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="purchaesNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-decoration-underline mb-3">Delete This Account:</h5>
                                        <p class="text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account :</p>
                                        <div>
                                            <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" value="make@321654987" style="max-width: 265px;">
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <a href="javascript:void(0);" class="btn btn-soft-danger">Close & Delete This Account</a>
                                            <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->


                <!-- <div wire:loading>
                    <div class="modal" style="display: block" tabindex="-1"  role="dialog" aria-hidden="true" >
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content" style="background: none; border: none;">
                            <div class="modal-body text-center">
                                <img src="{{asset('../load.gif')}}" alt="gif" class="w-160">
                            </div>
                        </div>
                        </div>
                    </div>
                </div> -->


        <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="confirm_otp" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                        <div class="modal-body text-center p-4">

                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card mt-4">

                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <div class="avatar-lg mx-auto">
                                                    <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                                        <i class="ri-mail-line"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 mt-4">
                                                <div class="text-muted text-center mb-4 mx-lg-3">
                                                    <h4>Entrer le code de vérification a 6 chiffres</h4>
                                                    <p>S'il vous plaît entrer le code de vérification que nous avons envoyé sur votre adresse email :<span class="fw-semibold">{{ $email }}</span></p>
                                                </div>

                                                <form wire:submit.prevent="SubmitConfirmOTP">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(1, event)" maxLength="1" id="digit1-input" wire:model="one_digits">
                                                                @error('one_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->

                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(2, event)" maxLength="1" id="digit2-input" wire:model="two_digits">
                                                                @error('two_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->

                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(3, event)" maxLength="1" id="digit3-input" wire:model="three_digits">
                                                                @error('three_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->

                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(4, event)" maxLength="1" id="digit4-input" wire:model="four_digits">
                                                                @error('four_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->

                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit5-input" class="visually-hidden">Digit 4</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(5, event)" maxLength="1" id="digit5-input"  wire:model="five_digits">
                                                                @error('five_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->

                                                        <div class="col-2">
                                                            <div class="mb-3">
                                                                <label for="digit6-input" class="visually-hidden">Digit 4</label>
                                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(6, event)" maxLength="1" id="digit6-input" wire:model="six_digits">
                                                                @error('six_digits') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div><!-- end col -->
                                                    </div>


                                                <div class="mt-3">
                                                    <button type="Submit" class="btn btn-success w-100">Confirm</button>
                                                </div>
                                                </form><!-- end form -->
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Vous n'avez pas recu le code ? <a href="javascript:void(0);" wire:click="resend_OTP" class="fw-semibold text-primary text-decoration-underline">Reenvoyer</a> </p>
                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



    </div>




    @push('styles')
    <style>
        .feedback-text{
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #f06548;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    @endpush

    @push('scripts')
    <!-- particles js -->
        <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
        <!-- particles app js -->
        <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
        <!-- two-step-verification js -->
        <script src="{{ asset('assets/js/pages/two-step-verification.init.js') }}"></script>

    @endpush
