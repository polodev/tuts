<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <form action="/upload" method="post" enctype="multipart/form-data" > 
    <div class="form-group">
        {{csrf_field()}}
        <label for="file">Upload</label>
        <input type="text" name="file" id="file" class="form-control">
        <input type="submit" class="btn btn-info">
    </div>
    
  </form>
</body>
</html>