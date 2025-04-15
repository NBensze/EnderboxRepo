<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    
    <title>Edit profile</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="" width="50" height="44">
        </a>
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
                <input class="form-control" aria-describedby="emailHelp" id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username">
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







