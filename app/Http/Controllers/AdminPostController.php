<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\TableOrderDesign;
use App\Models\TableOrderPrint;

use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function ambildatatabeldesign(Request $request)
    {
        $order = $request->get('order', 'desc');
        $tableorderdesign = TableOrderDesign::orderBy('tanggal_pesan', $order)
            ->orderBy('jam_pesan', $order)
            ->get();
        $title = 'Design Orders';
        $defaultStatus = TableOrderDesign::first()->status;
        return view('admin.index', compact('tableorderdesign', 'title', 'order', 'defaultStatus'));
    }

    public function ambildatatabelprint(Request $request)
    {
        $order = $request->get('order', 'desc');
        $tableorderprint = TableOrderPrint::orderBy('tanggal_pesan', $order)
            ->orderBy('jam_pesan', $order)
            ->get();
        $title = 'Print Orders';
        $defaultStatus = TableOrderPrint::first()->status;
        return view('admin.index', compact('tableorderprint', 'title', 'order', 'defaultStatus'));
    }
    public function updateDesignStatus(Request $request, $id_orderdesign)
    {
        return $this->updateStatus($request, $id_orderdesign, TableOrderDesign::class);
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
    
}