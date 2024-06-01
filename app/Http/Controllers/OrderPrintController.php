<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableOrderPrint;
use Illuminate\Support\Facades\Auth;

class OrderPrintController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'kontak' => 'required|string',
            'nama' => 'required|string',
            'material' => 'required|string',
            'file_name' => 'required|file',
            // Tambahkan validasi untuk file_resi jika diperlukan
            // 'file_resi' => 'nullable|file',
        ]);

        // Simpan file ke dalam storage dengan nama asli di direktori yang baru
        $fileName = $request->file('file_name')->getClientOriginalName();
        $file = $request->file('file_name')->storeAs('public/fileformat3dprinting', $fileName);

        // Mengambil ID pengguna yang sedang memesan
        $userId = Auth::id();
        $statusDefault = "waiting";
        $hargaDefault = "0";

        // Simpan data ke dalam database
        TableOrderPrint::create([
            'id_user' => $userId,
            'kontak' => $validatedData['kontak'],
            'nama' => $validatedData['nama'],
            'material' => $validatedData['material'],
            'file_name' => $file,
            'status' => $statusDefault,
            'harga' => $hargaDefault,
        ]);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('dashboard');
    }
}
