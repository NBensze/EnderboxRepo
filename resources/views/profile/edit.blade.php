<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
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
        <div class="card" >
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
                <input class="form-control" id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input class="form-control" aria-describedby="emailHelp" id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username">
            </div>
        </form>
  </div>
    </div>
</div>
</body>
</html>







