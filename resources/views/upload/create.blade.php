<!-- resources/views/upload/create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Bootstrap CSS link -->
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
                <a class="nav-link active" aria-current="page" href="{{ url('/upload') }}">Upload</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/main') }}">Uploaded files</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/profile') }}">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/admin/index') }}">Admin</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">{{ __('Upload') }}</h2>
                <h4 class="card-subtitle mb-2 text-muted">Upload your files here</h4>
                <!-- <p class="card-text">You can upload files up to 100MB in size.</p> -->
                <form id="UploadFORM" action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
        
                    <!-- File Name Input -->
                    <div class="mb-3">
                        <label for="FileNameINP" class="form-label">File Name</label>
                        <input maxlength="50" type="text" id="FileNameINP" name="FileNameINP" class="form-control" placeholder="Enter file name">
                    </div>
        
                    <!-- File Upload Input PROBLÉMÁS -->
                    <div class="mb-3">
                        <label for="FileUploadINP" class="form-label">Choose File</label>
                        <input type="file" id="FileUploadINP" name="FileUploadINP" class="form-control file-input" required/>
                    </div>
        
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label for="GeneratePasswordCHBOX" class="form-label">Password protected</label> 
                            <input id="GeneratePasswordCHBOX" type="checkbox" role="switch" value="Generate password" class="form-check-input" onchange="GeneratePassword()"/>
                        </div>
                        <label for="PasswordLengthSLCT" class="form-label">Password length</label>
                        <select id="PasswordLengthSLCT" class="form-select mb-3" style="width: 75px" onchange="GeneratePassword()">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <input type="text" class="form-control" id="FilePasswordINP" name="FilePasswordINP" readonly/>
                    </div>
        
                    <!-- File Comment Textarea -->
                    <div class="mb-3">
                        <label for="FileCommentTAREA" class="form-label">File Comment</label>
                        <textarea maxlength="200" id="FileCommentTAREA" name="FileCommentTAREA" class="form-control" rows="3" placeholder="Enter comments about the file"></textarea>
                    </div>
        
                    <input type="submit" class="btn btn-secondary" onclick="CheckAll()" value="Upload"/>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('upload_session') == 'success')
        <div class="alert alert-light alert-dismissible fade show mt-4" role="alert">
            <strong>Successful upload!</strong> Click <a href="{{ route('upload.index') }}">here</a> to view your uploaded files.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
<script>
    function CheckFileName() {
        let Name = document.getElementById('FileNameINP').value;

        const SpecialCharRegex = /^[a-zA-Z0-9]*$/;

        if (Name == "") {
            alert('File name is empty');
            return false;
        }

        if (SpecialCharRegex.test(Name) == false) {
            alert('File name bad format');
            return false;
        }

        return true;
    }

    function CheckUpload() {
        let Upload = document.getElementById('FileUploadINP');
        const File = Upload.files[0];

        if (File.size > 100000000) {
            alert('File is too large');
            return false;
        }

        return true;
    }

    function CheckAll() {
        //document.getElementById("UploadFORM").submit();
        console.log(CheckFileName());
        console.log(CheckUpload());


        if (CheckFileName() == true && CheckUpload() == true) {
            //console.log("XDD");
            document.getElementById("UploadFORM").submit();
        }
    }

    function GeneratePassword() {


        let IsChecked = document.getElementById("GeneratePasswordCHBOX").checked;
        let PasswordLength = document.getElementById("PasswordLengthSLCT").value;
        console.log(PasswordLength);

        document.getElementById("FilePasswordINP").value = "";
        document.getElementById("FilePasswordINP").readOnly = true;

        if (IsChecked == true) 
        {
            document.getElementById("FilePasswordINP").readOnly = false;
            const PasswordChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let Result = '';
            for (let i = 0; i < PasswordLength; i++) {
                Result += PasswordChars[Math.floor(Math.random() * PasswordChars.length)];
            }
            document.getElementById("FilePasswordINP").value = Result;
        }
    }
    
</script>

</html>

