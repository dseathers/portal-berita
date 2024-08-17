<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            padding-top: 56px;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            height: 100%;
            padding: 20px;
            background-color: #343a40; /* Dark sidebar background */
            color: #ffffff; /* White text */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #ffffff;
        }
        .sidebar .nav-link.active {
            color: #007bff; /* Highlight color */
            background-color: #495057; /* Darker background on active */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card-title {
            color: #007bff; /* Card title color */
        }
        .card-body {
            background-color: #f8f9fa; /* Light card background */
        }
        .table thead th {
            background-color: #007bff; /* Table header background */
            color: #ffffff; /* Table header text color */
        }
        .table tbody tr:hover {
            background-color: #e9ecef; /* Row hover color */
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $user->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('upload') }}">
                    <i class="fas fa-upload"></i> Upload News
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('listberita') }}">
                    <i class="fas fa-list"></i> News List
                </a>
            </li>
            <!-- Add more links as needed -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="mb-4">Welcome, {{ $user->name }}!</h1>

            <div class="row">
                <!-- Card for Total News -->
                <div class="col-md-4 mb-4">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total News</h5>
                            <p class="card-text">Number of news articles.</p>
                            <h2 class="card-text">45</h2>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent News Table -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Recent News</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentNews as $newsItem)
                                <tr>
                                    <td>{{ $newsItem->judul }}</td>
                                    <td>{{ $newsItem->author }}</td>
                                    <td>{{ $newsItem->tanggal_publikasi }}</td>
                                    <td>
                                        <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
