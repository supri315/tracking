<?php


namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Branch;
use App\Models\Disctric;
use App\Models\Transaksi;
use App\Models\HistoryTransaction;
use App\Models\History;
use Illuminate\Support\Arr;
use Auth;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;


class TransaksiController extends Controller
{

    public function index()
    {

        return view('admin.transaction.index');
    }

    public function dataIndex(Request $request)
    {
        $data = Transaksi::getAll()->orderBy('id','DESC')->get();  

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='".route('admin.user.index')."'>
                        <i class='bx bx-pencil'></i>

                    </a>
                    <a href='#' class='btn-link-danger modal-deletetab1' data-id='".$row->id."'>
                        <i class='bx bxs-trash'></i>
                    </a>
                    <a href='".route('admin.user.index')."'>
                        <i class='bx bx-printer'></i>
                    </a>
                </div>";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    
    public function create()
    {
        $cekCity = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->first();
        
        $disctrics = Disctric::getAll()->where('city_id', $cekCity->city_id)->get();

        $branchs = Branch::getAll()->where('branch.id','!=',Auth::user()->branch_id)->get();

        return view('admin.transaction.create',compact('branchs','disctrics'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "destination_branch_id" => "required",
            "receiver" => "required",
            "receiver_address" => "required",
            "phone_receiver" => "required",
            "shipper" => "required",
            "shipper_address" => "required",
            "shipper_phone" => "required",
            "kelurahan" => "required",
            "coli_total" => "required",
            "shipping_amount" => "required",
            "discount" => "required",
            "total_amount" => "required",
            "disctric_id" => "required",
            "ship_date" => "required",
            
        ],[
            'destination_branch_id.required'=>'Tujuan Cabang Harus Diisi',
            'receiver.required'=>'Penerima Harus Diisi',
            'receiver_address.required'=>'Alamat Penerima Harus Diisi',
            'phone_receiver.required'=>'No hp Penerima Harus Diisi',
            'shipper.required'=>'Pengirim Harus Diisi',
            'shipper_address.required'=>'Alamat Pengirim Harus Diisi',
            'shipper_phone.required'=>'No hp Pengirim Harus Diisi',
            'kelurahan.required'=>'Kelurahan Harus Diisi',
            'coli_total.required'=>'Total Koli Harus Diisi',
            'shipping_amount.required'=>'Biaya Pengiriman Harus Diisi',
            'discount.required'=>'Diskon Harus Diisi',
            'total_amount.required'=>'total pembayaran Harus Diisi',
            'disctric_id.required'=>'Kecamatan Harus Diisi',
            'ship_date.required'=>'Tanggal pengiriman Harus Diisi',
        ]);

        
        $input = Arr::only($request->all(), [
            "destination_branch_id", 
            "receiver",
            "receiver_address",
            "phone_receiver",
            "shipper",
            "shipper_address",
            "shipper_phone",
            "kelurahan",
            "kecamatan",
            "coli_total",
            "weight_total",
            "volume_total",
            "shipping_amount",
            "discount",
            "total_amount",
            "disctric_id",
            "ship_date",
        ]);


        // start generate no resi
        $branch = Branch::getAll()->where('branch.id',Auth::user()->branch_id)->first();
        
        $kodeAwal = "";
        if ($branch->city_name ==  "surabaya") {
            $kodeAwal = "SUB";
        }else {
            $kodeAwal = "MK";
        }

        $kodeAkhir = "";
        if ($kodeAwal == "SUB") {
            $kodeAkhir = "MK";
        }else {
            $kodeAkhir = "SUB";
        }    
        //end generate no resi

        $input['awb'] = $kodeAwal.$kodeAkhir.date('dmy').mt_rand(1000000,9999999);

        $input['source_branch_id'] = Auth::user()->branch_id;

        $input['code'] = "REG";

        $result = Transaksi::create($input);

        // store history 
        History::create([
            "transaction_id" => $result->id,
            "goods_entry" => date("Y-m-d"), 
            "status_id" => 1,
            "latitude" => $branch->latitude,
            "longitude" => $branch->longitude 
        ]);

        // store history transaction
        HistoryTransaction::create([
            "transaction_id" => $result->id,
            "status_id" => 1, 
            "latitude" => $branch->latitude,
            "longitude" => $branch->longitude 
        ]);

         return redirect('/dashboard/barang-masuk');
        
    }

    public function edit($id)
    {
        $roles = Role::getAll()->get();
        
        $branchs = Branch::getAll()->get();

        $data = User::getAll()->find($id);
        
        return view('admin.user.edit',compact('data','roles','branchs'));

    }

    public function print($id)
    {
        $dataTransaction = Transaksi::getAll()->where('id', $id)->first();

        $generator = new BarcodeGeneratorPNG();

        $barcode = base64_encode($generator->getBarcode($dataTransaction->awb, $generator::TYPE_CODE_128));

        $data = [
            "title" => 'resi barang masuk',
            "barcode" => $barcode
        ];

        return view("admin.transaction.print-resi", ["data"=>$data]);


        // $pdf = PDF::loadView('admin.transaction.print-resi', $data);




        // return $pdf->download('itsolutionstuff.pdf');
    }
}


