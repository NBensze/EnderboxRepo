<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<style>
    .form-control::placeholder {
        color: #bac2c9 !important; 
        opacity: 1 !important; 
    }
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
    .form-check-input:checked {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
    }
    .form-check-input:checked::before{
        background-color: white !important;
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25) !important;
        border-color: #6c757d !important;
    }
    .form-check-input:focus::before {
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25) !important;
        border-color: #6c757d !important;
    }
</style>
<body class="bg-dark text-light">
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
                <a class="nav-link text-light" href="{{ url('/profile') }}">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/index') }}">Admin</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <form action="{{ route('admin.searchbyuser') }}" method="get" class="d-inline">
            @csrf
            <div class="mb-3">
                <label for="SearchINP" class="form-label">Search by person name</label>
                <input type="text" onchange="ChangeBtnContent()" class="form-control" id="SearchINP" name="SearchINP" style="width: 450px;">
                <button type="submit" id="SearchBTN" class="btn btn-success btn-sm mt-2">Search</button>
            </div>
        </form>

        
        @if ($AllFiles->count() == 0)
            <h2 class="h2">No files found!</h2>
        @endif
    </div>



        @foreach ($AllFiles as $FileValue)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $FileValue->File_name }}</h5>
                <p class="card-text">{{ $FileValue->File_comment }}</p>
                <p>Extension: .{{ $FileValue->File_extension }}</p>
                <p>Uploaddate: {{ $FileValue->File_uploaddate }}</p>
                <p>Size: {{ $FileValue->File_size }} in megabytes</p>
                
                <form action="{{ route('admin.delete', $FileValue->File_hash) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete fileeee</button>
                </form>

                
                <button class="btn btn-success btn-sm" onclick="OpenLink('{{$FileValue->File_hash}}')">Open link</button>
                
                
                <form action="{{ route('upload.download', $FileValue->id) }}" method="get" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Download file</button>
                </form>

                
                <span onclick="CopyLink('{{$FileValue->File_hash}}')" class="text-primary text-decoration-underline" style="cursor: pointer;">Copy link</span>
            </div>
        </div>
        @endforeach



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

        <script>
        function CopyLink(FileHash)
        {
            navigator.clipboard.writeText("http://127.0.0.1:8000/view/" + FileHash);
            alert("Link copied");
        }

        function OpenLink(FileHash)
        {
            window.open("http://127.0.0.1:8000/view/" + FileHash);
        }

        function ChangeBtnContent()
        {
            let Inp = document.getElementById("SearchINP");
            let Btn = document.getElementById("SearchBTN");

            if (Inp.value == "")
            {
                Btn.value = "Get all";
                return;
            }
            
            return Btn.value = "Search";
        }
    </script> 
</body>
</html>