<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <h2>View</h2>
        @foreach ($Uploads as $UploadValue)
        @if ($UploadValue->File_password != "")
        <div id="PasswordDIV" class="form-group">
            <label for="PasswordINP">Password</label>
            <input id="PasswordINP" type="text" class="form-control" />
            <button class="btn btn-primary" onclick="CheckPassword('{{$UploadValue->File_password}}')">View file</button>
            <img src onerror="CheckPassword('{{$UploadValue->File_password}}')" />
        </div>
        @endif
        <div id="FileDIV" class="card mb-4" style="display: block;">
            <div class="card-body">
                <h5 class="card-title">{{ $UploadValue->File_name }}</h5>
                <p class="card-text">{{ $UploadValue->File_comment }}</p>
                     
                <!-- Download Button -->
                <form action="{{ route('upload.download', $UploadValue->id) }}" method="get" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Download file</button>
                </form>
            </div>
        </div>
        @endforeach
        <script>
            function CheckPassword(Password)
            { 
                //Contains password and password is matching
                if (Password == document.getElementById("PasswordINP").value)
                {
                    document.getElementById("FileDIV").style.display = "block";
                    document.getElementById("PasswordDIV").style.display = "none";
                    return;
                }  

                //Contains password 
                if (Password != "")
                {
                    document.getElementById("FileDIV").style.display = "none";
                    return;
                } 
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>