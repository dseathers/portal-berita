<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit News</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Quill CSS -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Edit News</h1>
    
            <form action="{{ url('/news/update/' . $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="form-group">
                    <label for="judul">Title</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $news->judul) }}" required>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $news->author) }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal_publikasi">Date</label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="form-control" value="{{ old('tanggal_publikasi', $news->tanggal_publikasi) }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Description</label>
                    <!-- Container for Quill editor -->
                    <div id="quill-editor-container" style="height: 200px;">
                        <div id="quill-editor"></div>
                    </div>
                    <input type="hidden" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $news->deskripsi) }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if ($news->image)
                        <img src="{{ asset('images/' . $news->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update News</button>
            </form>
        </div>
    
        <!-- Quill JS -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            // Initialize Quill editor
            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': '1' }, { 'header': '2' }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link'],
                        [{ 'align': [] }]
                    ]
                }
            });

            // Set initial content
            var initialContent = document.getElementById('deskripsi').value;
            quill.root.innerHTML = initialContent;

            // Update hidden input on form submit
            document.querySelector('form').addEventListener('submit', function() {
                document.getElementById('deskripsi').value = quill.root.innerHTML;
            });
        </script>
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
