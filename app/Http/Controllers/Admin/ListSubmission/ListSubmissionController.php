<?php


namespace App\Http\Controllers\Admin\ListSubmission;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ListSubmissions;
use App\Models\Transaksi;
use App\Models\HistoryTransaction;
use App\Models\History;
use App\Models\Branch;
use Auth;
use PDF;
use Illuminate\Support\Arr;


class ListSubmissionController extends Controller
{
   
    public function index()
    {
        return view('admin.listsubmission.index');
    }

    public function dataIndex(Request $request)
    {
        $data = ListSubmissions::getAll()->orderBy('id','DESC')->groupBy('ship_date')->get();  

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='/dashboard/daftar-kiriman/print?start_date={$row->start_date}&nopol={$row->nopol}'>
                        <i class='bx bx-printer'></i>
                    </a>
                </div>";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    { 
        $supir = User::getAll()->where('role_id',3)->get();

        return view('admin.listsubmission.create',compact('supir'));
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
        $transaction = Transaksi::getAll()->where('ship_date', $request->ship_date)->orderBy('id','DESC')->get();  

        $branch = Branch::getAll()->where('branch.id',Auth::user()->branch_id)->first();

        foreach ($transaction as $key => $value) {
            ListSubmissions::insert([
                'ship_date' => $request->ship_date,
                'user_id' => $request->user_id,
                'disctric_id' => $request->disctric_id,
                'transaction_id' => $value->id,
            ]);

            History::where('transaction_id',$value->id)->update([
                "goods_entry_port" => date("Y-m-d"), 
                "status_id" => 4,
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);

            // store history transaction
            HistoryTransaction::create([
                "transaction_id" => $value->id,
                "status_id" => 4, 
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);

        }

        return redirect('/dashboard/daftar-kiriman');
        
    }


    public function print()
    {
 
        $data = ListSubmissions::getPrint()->where('start_date', \Request::get('start_date'))->where('nopol',\Request::get('nopol'))->get()->toArray(); 
    
        
        return view("admin.listsubmission.print", ["data"=>$data]);

    }

  
}