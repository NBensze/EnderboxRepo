<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded files</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
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
                <a class="nav-link active text-light" href="{{ url('/main') }}">Uploaded files</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/profile') }}">Profile</a>
              </li>
              @if (Auth::user()->User_role === 'admin')
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/admin/index') }}">Admin</a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Uploaded Files</h1>

        @if (!empty($AllFiles))
            @if ( $AllFiles->count() == 0)
                <h2 class="text-center">Nem talalhatoak fajlok!</h2>
            @endif
        @endif

        @foreach ($Uploads as $UploadValue)

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $UploadValue->File_name }}</h5>
                <div id="DataDiv{{ $loop->index }}" style="display: none;">
                <p><b>Extension:</b> .{{ $UploadValue->File_extension }}</p>
                <p><b>Upload date:</b>  {{ $UploadValue->File_uploaddate }}</p>
                <p><b>Size:</b>  {{ $UploadValue->File_size }} in megabytes</p>
                <p><b>Comment:</b>  {{ $UploadValue->File_comment }}</p>
                </div>
                
                <!-- Delete Button -->
                <form action="{{ route('upload.delete', $UploadValue->File_hash) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-3">Delete file</button>
                </form>

                <!-- Open Button -->
                <button class="btn btn-secondary btn-sm mt-3" onclick="OpenLink('{{$UploadValue->File_hash}}')">Open link</button>
 
                <!-- Download Button -->
                <form action="{{ route('upload.download', $UploadValue->id) }}" method="get" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm mt-3 ">Download file</button>
                </form>

                <!-- Expand data div Button -->
                <button id="ExpandBTN" class="btn btn-secondary btn-sm mt-3" onclick="ShowHideDataDiv('{{ $loop->index }}')">Show file data</button>
                <br>

                <!--Copy link-->
                <span onclick="CopyLink('{{$UploadValue->File_hash}}')" class="text-primary text-decoration-underline" style="cursor: pointer;">Copy link</span>

                @if ($UploadValue->File_password != "")
                <!--Copy password-->
                <span onclick="CopyPassword('{{$UploadValue->File_password}}')" class="text-primary text-decoration-underline" style="cursor: pointer;">Copy password</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <script>
        function CopyLink(FileHash)
        {
            navigator.clipboard.writeText("http://127.0.0.1:8000/view/" + FileHash);
            alert("Link copied");
        }

        function CopyPassword(FilePassword)
        {
            navigator.clipboard.writeText(FilePassword);
            alert("Password copied");
        }

        function OpenLink(FileHash)
        {
            window.open("http://127.0.0.1:8000/view/" + FileHash);
        }

        function ShowHideDataDiv(DivIndex)
        {
            //Hide
            if (document.getElementById("DataDiv" + DivIndex).style.display == "block")
            {
                document.getElementById("DataDiv" + DivIndex).style.display = "none";
                return;
            }

            //Show
            document.getElementById("DataDiv" + DivIndex).style.display = "block";
        }
    </script>
</body>
</html>
