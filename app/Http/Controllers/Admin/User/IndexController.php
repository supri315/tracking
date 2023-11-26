<?php


namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;


class IndexController extends Controller
{
   
    public function index()
    {

        return view('admin.user.index');
    }

    public function dataIndex(Request $request)
    {
        $data = User::getAll()->orderBy('id','DESC')->get();  

        return \Yajra\DataTables\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                return "
                <div class='col6'>
                    <a href='".route('admin.user.edit',$row->id)."'>
                        <i class='bx bx-pencil'></i>

                    </a>
                    <a href='".route('admin.user.delete',$row->id)."'>
                        <i class='bx bxs-trash'></i></a>

                    </a>
                </div>";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    
    public function create()
    {
        $roles = Role::getAll()->get();
        
        $branchs = Branch::getAll()->get();

        return view('admin.user.create',compact('roles','branchs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required",
            "role_id" => "required",
            "branch_id" => "required",
            "phone_number" => "required",
            "password" => "required",
            
        ],[
            'name.required'=>'nama Harus Diisi',
            'email.required'=>'Email Harus Diisi',
            'role.required'=>'Peran Harus Diisi',
            'branch.required'=>'Cabang Harus Diisi',
            'phone.required'=>'No Telp Harus Diisi',
            'password.required'=>'Sandi Harus Diisi'
        ]);

        
        $input = Arr::only($request->all(), [
            'name',
            'email',
            'role_id',
            'branch_id',
            'phone_number',
            'password'
        ]);

        $input['password'] = Hash::make($request->password);  

        $result = User::create($input);

        if($result){
            return redirect('/dashboard/users');
        }
    }

    public function edit($id)
    {
        $roles = Role::getAll()->get();
        
        $branchs = Branch::getAll()->get();

        $data = User::getAll()->find($id);
        
        return view('admin.user.edit',compact('data','roles','branchs'));
    }

    public function update(Request $request, $id)
    {
        $detail = User::find($id);

        $input = Arr::only($request->all(), [
            'name',
            'email',
            'role_id',
            'branch_id',
            'phone_number',
            // 'password'
        ]);

        $result = $detail->update($input);
        if($result){
            return redirect('/dashboard/users');
        }

    }

    public function delete($id)
    {
        $data = User::find($id);
        
        $data->delete();

        return redirect('/dashboard/users');

    }
}


