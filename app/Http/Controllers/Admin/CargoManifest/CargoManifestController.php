<?php


namespace App\Http\Controllers\Admin\CargoManifest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CargoManifest;
use App\Models\Transaksi;
use App\Models\Branch;
use App\Models\HistoryTransaction;
use App\Models\History;
use App\Models\MasterKapal;
use Auth;
use PDF;
use Illuminate\Support\Arr;


class CargoManifestController extends Controller
{
   
    public function index()
    {

        return view('admin.cargomanifest.index');
    }

    public function dataIndex(Request $request)
    {
        $data = CargoManifest::getAll()->orderBy('id','DESC')->groupBy('start_date')->get();  

        // return $data;
        // die;

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='/dashboard/cargo-manifest/print?start_date={$row->start_date}&nopol={$row->nopol}' target=_blank>
                        <i class='bx bx-printer'></i>
                    </a>
                </div>";
            })
            ->rawColumns(['aksi'])
            ->make(true);
        // return \Yajra\DataTables\DataTables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function($row){
        //         return "
        //         <div class='col6'>
        //             <a href='".route('admin.user.index')."'>
        //                 <i class='bx bx-pencil'></i>

        //             </a>
        //             <a href='#' class='btn-link-danger modal-deletetab1' data-id='".$row->id."'>
        //                 <i class='bx bxs-trash'></i>
        //             </a>
        //             <a href='/dashboard/cargo-manifest/print?start_date={$row->start_date}&nopol={$row->nopol}' target=_blank>
        //                 <i class='bx bx-printer'></i>
        //             </a>
        //         </div>";
        //     })
        //     ->rawColumns(['aksi'])
        //     ->make(true);
    }

    public function create()
    {
        $cekCity = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->first();
        
        $branchDestinations = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->get();

        $branchSource = Branch::getAll()->where('branch.id','=',Auth::user()->branch_id)->get();

        $kapals = MasterKapal::getAll()->get();

        return view('admin.cargomanifest.create',compact('branchDestinations','branchSource','kapals'));
    }


    public function getDataTransaction($date, Request $request)
    {
        $data = Transaksi::getAll()->where('ship_date', $date)->orderBy('id','DESC')->get();  
        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $transaction = Transaksi::getAll()->where('ship_date', $request->start_date)->orderBy('id','DESC')->get();  

        $branch = Branch::getAll()->where('branch.id',Auth::user()->branch_id)->first();

        foreach ($transaction as $key => $value) {
            CargoManifest::insert([
                // 'ship_name' => $request->ship_name,
                'kapal_id' => $request->kapal_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'source_branch_id' => $request->source_branch_id,
                'destination_source_id' => $request->destination_source_id,
                'no_docs' => $request->no_docs,
                'nopol' => $request->nopol,
                'driver' => $request->driver,
                'transaction_id' => $value->id,
            ]);

            History::where('transaction_id',$value->id)->update([
                "goods_entry_port" => date("Y-m-d"), 
                "status_id" => 3,
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);

            // store history transaction
            HistoryTransaction::create([
                "transaction_id" => $value->id,
                "status_id" => 2, 
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);
            // store history transaction
            HistoryTransaction::create([
                "transaction_id" => $value->id,
                "status_id" => 3, 
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);

        }

        return redirect('/dashboard/cargo-manifest');
        
    }


    public function print()
    {
 
        $data = CargoManifest::getPrint()->where('start_date', \Request::get('start_date'))->where('nopol',\Request::get('nopol'))->get()->toArray(); 
            
        return view("admin.cargomanifest.print", ["data"=>$data]);




    }
}