<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableOrderDesign;
use App\Models\TableOrderPrint;

class UserOrderController extends Controller
{
    public function index()
    {
        return view('user.order', ["title" => "Order"]);
    }

    public function ambildatatabeldesign(Request $request)
    {
        $user_id = auth()->id(); // Get the authenticated user's id
        $order = $request->get('order', 'desc'); // Default order is descending
        $tableorderdesignuser = TableOrderDesign::where('id_user', $user_id)
            ->orderBy('tanggal_pesan', $order)
            ->orderBy('jam_pesan', $order)
            ->get();
        $title = 'Design Orders';
        return view('user.order', compact('tableorderdesignuser', 'title', 'order'));
    }

    public function ambildatatabelprint(Request $request)
    {
        $user_id = auth()->id(); // Get the authenticated user's id
        $order = $request->get('order', 'desc'); // Default order is descending
        $tableorderprintuser = TableOrderPrint::where('id_user', $user_id)
            ->orderBy('tanggal_pesan', $order)
            ->orderBy('jam_pesan', $order)
            ->get();
        $title = 'Print Orders';
        return view('user.order', compact('tableorderprintuser', 'title', 'order'));
    }

    public function acceptPrint(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'file_resi' => 'required|file',
        ]);

        // Simpan file resi dengan nama asli
        $fileResi = $request->file('file_resi')->getClientOriginalName();
        $fileResiPath = $request->file('file_resi')->storeAs('/fileresi3dprinting', $fileResi);

        // Panggil metode updateStatus untuk memperbarui status dan menyimpan nama file resi
        $this->updateStatus($id, 'checking', $fileResiPath, TableOrderPrint::class);

        // Redirect kembali ke halaman pesanan pengguna
        return redirect()->back()->with('success', 'Receipt uploaded successfully.');
    }

    public function acceptDesign(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'file_resi' => 'required|file',
        ]);

        // Simpan file resi dengan nama asli
        $fileResi = $request->file('file_resi')->getClientOriginalName();
        $fileResiPath = $request->file('file_resi')->storeAs('/fileresidesign', $fileResi);

        // Panggil metode updateStatus untuk memperbarui status dan menyimpan nama file resi
        $this->updateStatus($id, 'checking', $fileResiPath, TableOrderDesign::class);

        // Redirect kembali ke halaman pesanan pengguna
        return redirect()->back()->with('success', 'Receipt uploaded successfully.');
    }


    private function updateStatus($id, $status, $fileResiPath, $model)
    {
        try {
            $order = $model::find($id);

            if ($order) {
                // Perbarui status
                $order->status = $status;

                // Simpan nama file resi ke dalam model jika ada
                $order->file_resi = $fileResiPath;

                $order->save();
            }

            return response()->json(['message' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update status'], 500);
        }
    }

    public function declineOrder($id)
    {
        try {
            $order = TableOrderPrint::findOrFail($id);
            $order->status = 'Rejected';
            $order->save();

            return redirect()->back()->with('success', 'Order declined successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to decline order');
        }
    }

    public function declineDesignOrder($id)
    {
        try {
            $order = TableOrderDesign::findOrFail($id);
            $order->status = 'Rejected';
            $order->save();

            return redirect()->back()->with('success', 'Design order declined successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to decline design order');
        }
    }
}
