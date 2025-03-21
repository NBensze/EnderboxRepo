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
       <form action="{{route('upload.delete', $UploadValue->File_hash)}}" method="post">
          @csrf
          @method('DELETE')
          <button>Delete file</button><br>
       </form>
       <form action="{{route('upload.download', $UploadValue->id)}}" method="get">
          @csrf
          <button>Download file</button>
       </form>
    @endforeach
</body>
</html>