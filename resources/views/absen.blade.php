@extends('layout')

@section('content')
<h3>Form Absen Masuk</h3>

<form action="{{ route('simpan.absen') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit Absen</button>
</form>
@endsection