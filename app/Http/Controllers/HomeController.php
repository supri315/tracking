<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryTransaction;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cekOngkir()
    {
        return view('cekongkir');
    }

    public function tracking()
    {
        
        return view('tracking');
    }

    public function getDataTracking($awb, Request $request)
    {
        $data = HistoryTransaction::getTracking()->where('transaction.awb', $awb)->orderBy('created_at','ASC')->get();  
        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

}
