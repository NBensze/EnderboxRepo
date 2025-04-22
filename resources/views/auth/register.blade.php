<x-guest-layout>
    <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" style="color: black;">Name</label>
            <input class="form-control" type="text" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" style="color: black;">Email</label>
            <input class="form-control" type="text" id="email" name="email" :value="old('email')" required autofocus autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" style="color: black;">Password</label>
            <input class="form-control" type="password" id="password" name="password" required autofocus autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" style="color: black;">Password confirmation</label>
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required autofocus autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4"> <!-- Link kek alahuzott vmi a button meg a szokasos -->
            <a style="margin-right: 20px" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
    <script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </script>
</x-guest-layout>
