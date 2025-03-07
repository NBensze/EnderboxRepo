<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Index</h1>
    @foreach ($Uploads as $UploadValue)
    @csrf
       {{ $UploadValue->File_name}}
       {{ $UploadValue->File_comment}}
       <form action="{{route('upload.delete', $UploadValue->id)}}" method="post">
          @method('DELETE')
          <button>Delete file</button><br>
       </form>
    @endforeach
</body>
</html>