<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTugas;

class PengumpulanTugasController extends Controller
{
    public function viewPdf($id)
    {
        $tugas = DataTugas::findOrFail($id);
        $path  = storage_path('app/public/' . $tugas->path_file);

        if (!file_exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        return response()->file($path);
    }
}