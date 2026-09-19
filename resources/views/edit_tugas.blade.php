@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Tugas</h3>

    <form action="{{ route('update.tugas', $tugas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $tugas->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ $tugas->nim }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">File Tugas PDF (Kosongkan jika tidak ingin mengganti file)</label>
            <input type="file" name="file_tugas" class="form-control" accept="application/pdf">
            <small class="text-muted">File saat ini: {{ $tugas->nama_file }}</small>
        </div>

        <button type="submit" class="btn btn-success">Update Data</button>
        <a href="{{ route('tampil.tugas') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection