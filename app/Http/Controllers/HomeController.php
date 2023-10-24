<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryTransaction;
use App\Models\Disctric;


class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    public function cekOngkir()
    {
        $disctrics = Disctric::getAll()->get();

        return view('cekongkir',compact('disctrics'));
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

    public function DestinationTracking($awb, Request $request)
    {
        $data = HistoryTransaction::getTracking()->where('transaction.awb', $awb)->orderBy('created_at','ASC')->get();  
        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    

}
