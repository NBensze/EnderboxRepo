<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
        <form action="{{ route('admin.searchbyuser') }}" method="get" class="d-inline">
            @csrf
            <input type="text" onchange="ChangeBtnContent()" id="SearchINP" name="SearchINP">
            <button type="submit" id="SearchBTN" class="btn btn-success btn-sm">Search</button>
        </form>

        @if ($AllFiles->count() == 0)
                <h2>Nem talalhatoak fajlok!</h2>
            @endif

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