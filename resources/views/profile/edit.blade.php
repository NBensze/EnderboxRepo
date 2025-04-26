<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    
    <title>Edit profile</title>
</head>
<body class="bg-dark text-light">
    <style>
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25) !important;
            border-color: #6c757d !important;
            outline: none !important;
        }
        body {
            background-color: #343a40;
        }
        .card {
            background-color: #495057;
            border-radius: 0.5rem;
        }
        .card-body {
            color: #f8f9fa;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-subtitle {
            font-size: 1rem;
            color: #adb5bd;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            background-color: #495057;
            color: #f8f9fa;
            border: 1px solid #6c757d;
        }
        .form-control:focus {
            background-color: #495057;
            color: #f8f9fa;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .text-muted {
            color: #adb5bd !important;
        }
        .text-light {
            color: #f8f9fa !important;
        }
        .text-dark {
            color: #212529 !important;
        }
        .bg-body-tertiary {
            background-color: #343a40 !important;
        }
        .active{
            color:rgb(168, 168, 168) !important;
        }
    </style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="" width="50" height="44">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item text-light">
          <a class="nav-link text-light" aria-current="page" href="{{ url('/upload') }}">Upload</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/main') }}">Uploaded files</a>
          </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ url('/profile') }}">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="{{ url('/admin/index') }}">Admin</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="nav-link text-light" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </li>
        </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="card mt-3" >
    <div class="card-body">
        <h2 class="card-title">{{ __('Profile Information') }}</h2>
        <h6 class="card-subtitle mb-2 text-muted">{{ __("Update your account's profile information and email address.") }}</h6>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">{{__('Name')}}</label>
                <input class="form-control" id="name" name="name" type="text" :value="old('name', $user->name)" required autocomplete="name">
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div class="mb-3"> 
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input class="form-control" aria-describedby="emailHelp" id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="">
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-secondary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="mb-3">
                <button class="btn btn-secondary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class=""
                >{{ __('Saved.') }}</p>
            @endif
        </div>
        </form>
  </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h2 class="card-title">{{ __('Update Password') }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</h6>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input class="form-control" id="update_password_current_password" name="current_password" type="password" required autocomplete="current-password">
                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                </div>
                <div class="mb-3">
                    <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                    <input class="form-control" id="update_password_password" name="password" type="password" required autocomplete="new-password">
                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                </div>
                <div>
                    <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input class="form-control" id="update_password_password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
                    <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                </div>
                <div class="mt-3">
                    <button class="btn btn-secondary">{{ __('Save') }}</button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class=""
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h2 class="card-title">{{ __('Delete Account') }}</h2>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</h6>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                    <x-input-error class="mt-2" :messages="$errors->userDeletion->get('password')" />
                </div>

                <div class="mt-3">
                    <p>
                    {{ __('Are you sure you want to delete your account?') }}
                    </p>
                    <button class="btn btn-danger">{{ __('Delete Account') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</html>







