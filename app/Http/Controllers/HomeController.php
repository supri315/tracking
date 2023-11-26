<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryTransaction;
use App\Models\Disctric;
use App\Models\Transaksi;


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

    public function getDataTracking(Request $request)
    {
        $cekData = HistoryTransaction::getTracking()->where('transaction.awb', $request->awb)->first();
       
        if(!$cekData)
        {
            return redirect()->route('tracking')
                ->with('error','Nomor Resi tidak ditemukan.');
        }
        
        $data = HistoryTransaction::getTracking()->where('transaction.awb', $request->awb)->orderBy('created_at','ASC')->get();  

        $end = Transaksi::where('awb', $request->awb)->first();  
        
        $start = HistoryTransaction::getTracking()->where('transaction.awb', $request->awb)->orderBy('created_at','DESC')->first();  

        return view('tracking', compact('data','end','start'));

    }

    public function DestinationTracking($awb, Request $request)
    {
        $data = HistoryTransaction::getTracking()->where('transaction.awb', $awb)->orderBy('created_at','ASC')->get();  
        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    

}
