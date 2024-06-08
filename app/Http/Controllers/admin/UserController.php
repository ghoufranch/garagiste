<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::oldest();


        if (!empty($request->get('keyword'))) {
            $users = $users->where('name', 'like', '%' . $request->get('keyword') . '%');
            $users = $users->orWhere('email', 'like', '%' . $request->get('keyword') . '%');
        }
        $users = $users->paginate(10);

        return view('admin.users.list', [
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',

            'email' => 'required|email|unique:users',

            'phone' => 'required',
            'password' => 'required|min:5',
            'address' => 'required',
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();

            $message = 'user added susccefully';

            session()->flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if ($user == null) {
            $message = 'user not found';

            session()->flash('error', $message);
            return redirect()->route('users.index');
        }

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if ($user == null) {
            $message = 'user not found';

            session()->flash('error', $message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $id . ',id',

            'phone' => 'required',

            'address' => 'required',
        ]);

        if ($validator->passes()) {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->password != "") {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $message = 'user updated susccefully';

            session()->flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if ($user == null) {
            $message = 'User not found';

            session()->flash('error', $message);

            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        $user->delete();

        $message = 'User deleted successfully';

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }


    public function import_data(Request $request){
        $request->validate([
            'excel_file'=>'required|mimes:xls,xlsx'
        ]);
        Excel::import(new UsersImport, $request->file('excel_file'));
        return redirect('/admin/users')->with('success', 'Data Imported successfully');
    }

    public function export_data(){
        return Excel::download(new UsersExport, 'users-data.xlsx');
    }

    public function export_pdf(){
        $users=User::get();
    $pdf = Pdf::loadView('admin.pdf.users',['users' => $users]);
    return $pdf->download('users.pdf');
    }

}
