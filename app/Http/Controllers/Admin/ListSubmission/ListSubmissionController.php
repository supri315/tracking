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
// use App\Models\User;
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
        $data = ListSubmissions::getAll()->orderBy('id','DESC')->groupBy('end_date')->get();  

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='/dashboard/daftar-kiriman/print?end_date={$row->end_date}&nopol={$row->nopol}' target=_blank>
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
        $data = Transaksi::getTransaction()->whereDate('end_date', $date)->orderBy('id','DESC')->get();  
        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $transaction = Transaksi::getTransaction()->where('end_date', $request->end_date)->orderBy('id','DESC')->get();  

        $branch = Branch::getAll()->where('branch.id',Auth::user()->branch_id)->first();

        $kurir = User::where('id', $request->user_id)->first();

        foreach ($transaction as $key => $value) {
            ListSubmissions::insert([
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
                'disctric_id' => $value->disctric_id,
                'transaction_id' => $value->id,
            ]);

            History::where('transaction_id',$value->id)->update([
                "goods_arrive_port" => date("Y-m-d"), 
                "sorting_process_destination" => date("Y-m-d"), 
                "process_send_destination" => date("Y-m-d"), 
                "status_id" => 4,
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude 
            ]);

            // store history transaction
            HistoryTransaction::create([
                "transaction_id" => $value->id,
                "status_id" => 4, 
                "latitude" => $branch->latitude,
                "longitude" => $branch->longitude,
                "courier" => $kurir->name,  
            ]);

        }

        return redirect('/dashboard/daftar-kiriman');
        
    }


    public function print()
    {
 
        $data = ListSubmissions::getPrint()->where('end_date', \Request::get('end_date'))->get()->toArray(); 

        return view("admin.listsubmission.print", ["data"=>$data]);

    }

  
}