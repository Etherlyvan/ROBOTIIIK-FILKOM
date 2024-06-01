<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableOrderDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderDesignController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'kontak' => 'required|string',
            'nama' => 'required|string',
            'penjelasan' => 'required|string|min:10', // Atur panjang minimal teks yang diizinkan
            'file_name' => 'required|file',
            // Jika Anda ingin memvalidasi file_resi pada saat ini, tambahkan aturan validasi di sini
            // 'file_resi' => 'nullable|file',
        ]);

        // Simpan file ke dalam storage dengan nama asli di direktori yang baru
        $fileName = $request->file('file_name')->getClientOriginalName();
        $file = $request->file('file_name')->storeAs('public/fileformatdesign', $fileName);

        // Simpan file_resi jika ada
        $fileResi = null;
        if ($request->hasFile('file_resi')) {
            $fileResiName = $request->file('file_resi')->getClientOriginalName();
            $fileResi = $request->file('file_resi')->storeAs('public/fileresi', $fileResiName);
        }

        // Mengambil ID pengguna yang sedang memesan
        $userId = Auth::id();
        $statusDefault = "waiting";
        $hargaDefault = "0";

        // Simpan data ke dalam database
        TableOrderDesign::create([
            'id_user' => $userId,
            'kontak' => $validatedData['kontak'],
            'nama' => $validatedData['nama'],
            'penjelasan' => $validatedData['penjelasan'],
            'file_name' => $file,
            'status' => $statusDefault,
            'harga' => $hargaDefault,
            // Jika Anda menyimpan file_resi ke dalam database
            // 'file_resi' => $fileResi,
        ]);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('dashboard');
    }
}
