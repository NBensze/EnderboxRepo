<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Upload</h1>
    <form action="{{route('upload.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <input type="text" id="FileNameINP" name="FileNameINP">
    <input type="file" id="FileUploadINP" name="FileUploadINP">
    <textarea id="FileCommentTAREA" name="FileCommentTAREA"></textarea>
    <button id="FileUploadBTN">Upload</button>
    </form>
</body>
</html>