<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar { width: 250px; background-color: #343a40; color: white; padding-top: 20px; }
        .sidebar h4 { color: white; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #0d6efd; }
        .content { flex: 1; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4">Student Portal</h4>
        <a href="{{ route('form.absen') }}" class="{{ request()->routeIs('form.absen') ? 'active' : '' }}">Absen Masuk</a>
        <a href="{{ route('form.tugas') }}" class="{{ request()->routeIs('form.tugas') ? 'active' : '' }}">Pengumpulan Tugas</a>
        <a href="{{ route('tampil.absen') }}" class="{{ request()->routeIs('tampil.absen') ? 'active' : '' }}">Tampil Data Absen</a>
        <a href="{{ route('tampil.tugas') }}" class="{{ request()->routeIs('tampil.tugas') ? 'active' : '' }}">Tampil Data Tugas</a>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>