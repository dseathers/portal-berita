<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table thead th {
            background-color: #007bff; /* Table header background color */
            color: #ffffff; /* Table header text color */
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Row hover color */
        }
        .btn-primary, .btn-danger {
            font-size: 0.875rem; /* Adjust button font size */
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
    <div class="container mt-5">
        <!-- Kembali ke Dashboard Button -->
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary mb-4">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <h1 class="mb-4">News List</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->tanggal_publikasi }}</td>
                        <td>
                            <a href="{{ url('/news/edit/' . $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
