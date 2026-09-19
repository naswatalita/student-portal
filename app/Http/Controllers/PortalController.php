<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAbsen;
use App\Models\DataTugas;
use Illuminate\Support\Facades\Storage;

class PortalController extends Controller
{
    // ==================== ABSEN ====================
    public function formAbsen()
    {
        return view('absen');
    }

    public function simpanAbsen(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim'  => 'required',
        ]);

        DataAbsen::create([
            'nama' => $request->nama,
            'nim'  => $request->nim,
        ]);

        return redirect()->route('tampil.absen')->with('success', 'Absen berhasil disimpan!');
    }

    public function tampilAbsen(Request $request)
    {
        $search = $request->input('search');

        $absen = DataAbsen::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nim', 'like', "%{$search}%");
        })->get();

        return view('tampil_absen', compact('absen', 'search'));
    }

    public function hapusAbsen($id)
    {
        $absen = DataAbsen::findOrFail($id);
        $absen->delete();

        return redirect()->route('tampil.absen')->with('success', 'Data absen berhasil dihapus!');
    }

    // ==================== TUGAS ====================
    public function formTugas()
    {
        return view('tugas');
    }

    public function simpanTugas(Request $request)
    {
        $request->validate([
            'nama'       => 'required',
            'nim'        => 'required',
            'file_tugas' => 'required|mimes:pdf|max:10240',
        ]);

        $file     = $request->file('file_tugas');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $path     = $file->storeAs('tugas', $namaFile, 'public');

        DataTugas::create([
            'nama'         => $request->nama,
            'nim'          => $request->nim,
            'nama_file'    => $namaFile,
            'path_file'    => $path,
            'waktu_kumpul' => now(),
        ]);

        return redirect()->route('tampil.tugas')->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function tampilTugas(Request $request)
    {
        $search = $request->input('search');

        $tugas = DataTugas::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nim', 'like', "%{$search}%")
                         ->orWhere('nama_file', 'like', "%{$search}%");
        })->get();

        return view('tampil_tugas', compact('tugas', 'search'));
    }

    public function hapusTugas($id)
    {
        $tugas = DataTugas::findOrFail($id);

        if (Storage::disk('public')->exists($tugas->path_file)) {
            Storage::disk('public')->delete($tugas->path_file);
        }

        $tugas->delete();

        return redirect()->route('tampil.tugas')->with('success', 'Data tugas dan file PDF berhasil dihapus!');
    }

    // ==================== EDIT TUGAS ====================
    public function editTugas($id)
    {
        $tugas = DataTugas::findOrFail($id);
        return view('edit_tugas', compact('tugas'));
    }

    public function updateTugas(Request $request, $id)
    {
        $tugas = DataTugas::findOrFail($id);

        $request->validate([
            'nama'       => 'required',
            'nim'        => 'required',
            'file_tugas' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = [
            'nama' => $request->nama,
            'nim'  => $request->nim,
        ];

        if ($request->hasFile('file_tugas')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($tugas->path_file)) {
                Storage::disk('public')->delete($tugas->path_file);
            }

            // Upload file baru
            $file     = $request->file('file_tugas');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('tugas', $namaFile, 'public');

            $data['nama_file'] = $namaFile;
            $data['path_file'] = $path;
        }

        $tugas->update($data);

        return redirect()->route('tampil.tugas')->with('success', 'Data tugas berhasil diperbarui!');
    }

    // ==================== LIHAT PDF ====================
    public function lihatPdf($id)
    {
        $tugas = DataTugas::findOrFail($id);
        $path  = storage_path('app/public/' . $tugas->path_file);

        if (!file_exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        return response()->file($path);
    }
}