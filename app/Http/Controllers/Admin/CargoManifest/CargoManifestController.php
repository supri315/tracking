<?php


namespace App\Http\Controllers\Admin\CargoManifest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CargoManifest;
use App\Models\Transaksi;
use App\Models\Branch;
use Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;


class CargoManifestController extends Controller
{
   
    public function index()
    {

        return view('admin.cargomanifest.index');
    }

    public function dataIndex(Request $request)
    {
        $data = CargoManifest::getAll()->orderBy('id','DESC')->get();  

        return $data;
        die;

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='".route('admin.user.index')."'>
                        <i class='bx bx-pencil'></i>

                    </a>
                    <a href='#' class='btn-link-danger modal-deletetab1' data-id='".$row->id."'>
                        <i class='bx bxs-trash'></i></a>
                </div>";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $cekCity = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->first();
        
        $branchDestinations = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->get();

        $branchSource = Branch::getAll()->where('branch.id','=',Auth::user()->branch_id)->get();

        return view('admin.cargomanifest.create',compact('branchDestinations','branchSource'));
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
        
    }
}