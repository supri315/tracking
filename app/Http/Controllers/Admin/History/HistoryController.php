<?php


namespace App\Http\Controllers\Admin\History;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\History;

class HistoryController extends Controller
{
   
    public function index()
    {
        return view('admin.history.index');
    }

    public function dataIndex(Request $request)
    {
        $data = History::getAll()->orderBy('id','DESC')
        ->get();  

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    
}


