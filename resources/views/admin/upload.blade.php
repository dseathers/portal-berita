<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('tanggal_publikasi');
            const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
            dateInput.value = today;
            dateInput.setAttribute('readonly', true); // Set field as read-only
        });
    </script>
</head>
<body>
    <div class="mt-5 container">
        <h1>UPLOAD BERITA</h1>
        <form action="{{ url('/uploadnews') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">IMAGE</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="judul">JUDUL</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">AUTHOR</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal_publikasi">TANGGAL</label>
                <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">DESKRIPSI</label>
                <x-quill-editor name="deskripsi" id="deskripsi" class="form-control" required/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
