<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to News Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            padding-top: 56px;
            background-color: #f8f9fa;
        }
        .news-card {
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            transition: transform 0.2s ease-in-out;
        }
        .news-card:hover {
            transform: scale(1.05);
        }
        .news-card img {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            object-fit: cover;
            height: 200px;
        }
        .news-card-body {
            padding: 1.25rem;
        }
        .news-card-title {
            color: #007bff; /* Title color */
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        .news-card-footer {
            background-color: #e9ecef;
            border-top: 1px solid #ddd;
            padding: 0.75rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
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
            @foreach ($recentNews as $news)
                <div class="col-md-4">
                    <div class="card news-card">
                        @if($news->image)
                            <img src="{{ asset('images/' . $news->image) }}" class="card-img-top" alt="{{ $news->judul }}">
                        @else
                            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Placeholder image">
                        @endif
                        <div class="card-body news-card-body">
                            <h5 class="card-title news-card-title">
                                <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none text-primary">{{ $news->judul }}</a>
                            </h5>
                            <p class="card-text">{!! \Illuminate\Support\Str::limit($news->deskripsi, 100) !!}</p>
                        </div>
                        <div class="card-footer news-card-footer">
                            <small class="text-muted">Published on {{ \Carbon\Carbon::parse($news->tanggal_publikasi)->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
