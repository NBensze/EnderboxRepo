<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Uploaded Files</h1>

        @foreach ($Uploads as $UploadValue)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $UploadValue->File_name }}</h5>
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

                <span onclick="CopyLink('{{$UploadValue->File_hash}}')" class="text-primary text-decoration-underline" style="cursor: pointer;">Copy link</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function CopyLink(FileHash)
        {
            navigator.clipboard.writeText("http://127.0.0.1:8000/view/" + FileHash);
        }

        function OpenLink(FileHash)
        {
            window.open("http://127.0.0.1:8000/view/" + FileHash);
        }
    </script>
</body>
</html>
