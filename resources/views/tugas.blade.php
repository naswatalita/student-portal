@extends('layout')

@section('content')
<h3>Pengumpulan Tugas (PDF)</h3>

<form action="{{ route('simpan.tugas') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Upload File Tugas (PDF, maks 10MB)</label>
        <input type="file" name="file_tugas" class="form-control" accept="application/pdf" required>
    </div>
    <button type="submit" class="btn btn-success">Kirim Tugas</button>
</form>
@endsection