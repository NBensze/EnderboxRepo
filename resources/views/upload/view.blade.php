<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <h2>View</h2>
        @foreach ($Uploads as $UploadValue)
        @if ($UploadValue->File_password != "")
           Password<input id="PasswordINP" type="text"/>
           <button onclick="CheckPassword('{{$UploadValue->File_password}}')">View file</button>
           <img src onerror="CheckPassword('{{$UploadValue->File_password}}')">
        @endif
        <div id="DIV" class="card mb-4" style="display: none;">
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
                if (Password == document.getElementById("PasswordINP").value)
                {
                    alert("Logged in");
                    document.getElementById("DIV").style.display = "block";
                    return;
                }

                if (Password == "")
                {
                    document.getElementById("DIV").style.display = "block";
                }
            }
        </script>
</body>
</html>