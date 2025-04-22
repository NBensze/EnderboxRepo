<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Welcome!</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-center">Welcome to the EnderBox file sharing service</h1>
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="" style="width: 200px; height: 200px; display: block; margin: auto;" class="mt-4">
        </div>
        <div>
            <h4 class="text-center mt-4">Please register to use the service</h4>
            <p class="text-center mt-2">EnderBox is a file sharing service that allows you to upload and share files with others. It is designed to be simple and easy to use, with a focus on security and privacy.</p>
            <p class="text-center mt-2">To get started, please click the button below to register for an account.</p>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/register') }}" class="btn btn-light">Register</a>
        </div>
        <div>
            <h5 class="text-center mt-4">Already have an account?</h5>
            <div class="text-center mt-2">
                <a href="{{ url('/login') }}" class="btn btn-secondary">Login</a>
            </div>
        </div>
        
    </div>
</body>
</html>