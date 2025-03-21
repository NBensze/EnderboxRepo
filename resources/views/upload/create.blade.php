<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload</h1>
        
        <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- File Name Input -->
            <div class="form-group">
                <label for="FileNameINP">File Name</label>
                <input maxlength="50" type="text" id="FileNameINP" name="FileNameINP" class="form-control" placeholder="Enter file name">
            </div>

            <!-- File Upload Input -->
            <div class="form-group">
                <label for="FileUploadINP">Choose File</label>
                <input type="file" id="FileUploadINP" name="FileUploadINP" class="form-control-file">
            </div>

            <!-- File Comment Textarea -->
            <div class="form-group">
                <label for="FileCommentTAREA">File Comment</label>
                <textarea maxlength="100" id="FileCommentTAREA" name="FileCommentTAREA" class="form-control" rows="4" placeholder="Enter comments about the file"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="FileUploadBTN" class="btn btn-primary btn-block" onclick="CheckUpload()">Upload</button>
        </form>

        <!-- Success Message -->
        @if (session('upload_session') == 'success')
            <div class="alert alert-success mt-4">
                <a href="{{ route('upload.index') }}" class="btn btn-link">My Files</a>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    function CheckFileName()
    {
        let Name = document.getElementById('FileNameINP').value;

        const SpecialCharRegex = /^[a-zA-Z0-9]*$/;

        if (Name == "")
        {
            alert('File name is empty');
            return;
        }

        if (SpecialCharRegex.test(Name) == false)
        {
           alert('File name bad format');
           return;
        }
    }

    function CheckUpload()
    {
        let Upload = document.getElementById('FileUploadINP');
        const File = Upload.files[0];

        if (File.size > 10000000)
        {
           alert('File is too large');
           return;
        }
    }
</script>

</html>
