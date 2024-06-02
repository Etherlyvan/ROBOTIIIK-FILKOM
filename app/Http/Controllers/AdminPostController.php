<?php

namespace App\Http\Controllers;

use App\Models\TableOrderPrint;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\TableOrderPrint;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        $dateOrder = $request->get('date_order', 'desc');
        $statusOrder = $request->get('status_order', 'asc'); // Urutan status berdasarkan ascending

        $tableorderprintQuery = TableOrderPrint::query();

        // Menambahkan pengurutan berdasarkan tanggal jika diinginkan
        if ($dateOrder && $statusOrder !== 'desc') {
            $tableorderprintQuery->orderBy('tanggal_pesan', $dateOrder);
        }

        // Menambahkan pengurutan berdasarkan status jika diinginkan
        if ($statusOrder) {
            $customOrder = [
                'waiting',
                'payment',
                'checking',
                'processing',
                'ready to take',
                'done'
            ];

            $tableorderprintQuery->orderByRaw("FIELD(status, '" . implode("','", $customOrder) . "') $statusOrder");
        }

        // Jika urutan status descending, pastikan tanggal tidak dipertimbangkan dalam pengurutan
        if ($statusOrder === 'desc') {
            $tableorderprintQuery->orderBy('status', $statusOrder);
        }

        $tableorderprint = $tableorderprintQuery->get();

        $title = 'Print Orders';
        return view('admin.index', compact('tableorderprint', 'title', 'dateOrder', 'statusOrder'));
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $dateOrder = $request->get('date_order', 'desc');
        $statusOrder = $request->get('status_order', 'asc');

        $tableorderprintQuery = TableOrderPrint::query();

        // Menambahkan filter pencarian jika ada
        if ($search) {
            $tableorderprintQuery->where('nama', 'like', "%{$search}%")
                ->orWhere('kontak', 'like', "%{$search}%");
        }

        // Menambahkan pengurutan berdasarkan tanggal jika diinginkan
        if ($dateOrder && $statusOrder !== 'desc') {
            $tableorderprintQuery->orderBy('tanggal_pesan', $dateOrder);
        }

        // Menambahkan pengurutan berdasarkan status jika diinginkan
        if ($statusOrder) {
            $customOrder = [
                'waiting',
                'payment',
                'checking',
                'processing',
                'ready to take',
                'done'
            ];

            $tableorderprintQuery->orderByRaw("FIELD(status, '" . implode("','", $customOrder) . "') $statusOrder");
        }

        // Jika urutan status descending, pastikan tanggal tidak dipertimbangkan dalam pengurutan
        if ($statusOrder === 'desc') {
            $tableorderprintQuery->orderBy('status', $statusOrder);
        }

        $tableorderprint = $tableorderprintQuery->get();

        $title = 'Print Orders';
        return view('admin.index', compact('tableorderprint', 'title', 'dateOrder', 'statusOrder', 'search'));
    }



    public function updatePrintStatus(Request $request, $id_orderprint)
    {
        return $this->updateStatus($request, $id_orderprint, TableOrderPrint::class);
    }

    private function updateStatus(Request $request, $id, $model)
    {
        $status = $request->input('status');

        try {
            $order = $model::find($id);

            if ($order) {
                $order->status = $status;
                $order->save();
            }

            return response()->json(['message' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update status'], 500);
        }
    }
    public function acceptPrintAdmin(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required|integer',
        ]);

        $harga = $request->input('harga');

        $order = TableOrderPrint::find($id);
        $order->harga = $harga;
        $order->status = 'payment';
        $order->save();

        return redirect()->back()->with('success', 'Order confirmed successfully.');
    }
    public function acceptPaymentAdmin(Request $request, $id)
    {

        $order = TableOrderPrint::find($id);
        if ($order) {
            $order->status = 'processing';
            $order->save();
        }

        return redirect()->back()->with('success', 'Status updated to ready to take.');
    }
    public function doneprinting(Request $request, $id)
    {
        $order = TableOrderPrint::find($id);
        if ($order) {
            $order->status = 'ready to take';
            $order->save();
        }

        return redirect()->back()->with('success', 'Status updated to ready to take.');
    }

    public function finishorder(Request $request, $id)
    {
        $order = TableOrderPrint::find($id);
        if ($order) {
            $order->status = 'done';
            $order->save();
        }

        return redirect()->back()->with('success', 'Order finished.');
    }
}
