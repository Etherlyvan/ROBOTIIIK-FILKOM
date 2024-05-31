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


}
