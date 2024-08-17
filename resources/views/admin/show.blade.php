<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $news->judul }} - News Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .news-img {
            max-height: 400px; /* Atur tinggi maksimal gambar */
            object-fit: cover; /* Agar gambar tetap proporsional */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">News Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ url('/') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-arrow-left"></i> Back to News List
                </a>
                <div class="card">
                    @if($news->image)
                        <img src="{{ asset('images/' . $news->image) }}" class="card-img-top news-img" alt="{{ $news->judul }}">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img-top news-img" alt="Placeholder image">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $news->judul }}</h1>
                        <p class="card-text">{!! $news->deskripsi !!}</p>
                        <p class="text-muted">Published on {{ \Carbon\Carbon::parse($news->tanggal_publikasi)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
