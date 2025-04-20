<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Uploaded Files</h1>

        @if (empty($AllFiles))
        
           <h2>Nem talalhatoak fajlok!</h2>
        @endif

        @foreach ($Uploads as $UploadValue)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $UploadValue->File_name }}</h5>
                <p class="card-text">{{ $UploadValue->File_comment }}</p>
                
                <!-- Delete Button -->
                <form action="{{ route('upload.delete', $UploadValue->File_hash) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete fileeee</button>
                </form>

                <!-- Open Button -->
                <button class="btn btn-success btn-sm" onclick="OpenLink('{{$UploadValue->File_hash}}')">Open link</button>
                
                <!-- Download Button -->
                <form action="{{ route('upload.download', $UploadValue->id) }}" method="get" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Download file</button>
                </form>

                <!--Copy link-->
                <span onclick="CopyLink('{{$UploadValue->File_hash}}')" class="text-primary text-decoration-underline" style="cursor: pointer;">Copy link</span>
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

        function OpenLink(FileHash)
        {
            window.open("http://127.0.0.1:8000/view/" + FileHash);
        }
    </script>
</body>
</html>
