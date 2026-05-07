<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //LIST USER + SEARCH + PAGINATION
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function($query) use ($search){
                    $query->where('name','like',"%$search%")
                          ->orWhere('username','like',"%$search%")
                          ->orWhere('email','like',"%$search%");
                })
                ->latest()
                ->paginate(15); // pagination aktif

        $totalUser  = User::count();
        $activeUser = User::where('status',1)->count();

        return view('admin.users',
            compact('users','totalUser','activeUser','search'));
    }

    //FORM TAMBAH USER
    public function create()
    {
        return view('admin.tambah-user');
    }

    //SIMPAN USER BARU
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|max:15',
            'password' => 'required|min:5',
            'role'     => 'required|in:admin,barber,customer',
            'status'   => 'required|in:active,inactive'
        ]);

        $statusValue = $request->status == 'active' ? 1 : 0;

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $statusValue
        ]);

        return redirect('/admin/users')->with('success','User berhasil ditambahkan!');
    }

    //FORM EDIT USER
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    //UPDATE USER
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        //ignore id agar email/username lama tidak bentrok
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email'    => 'required|email|unique:users,email,'.$id,
            'phone'    => 'required',
            'role'     => 'required|in:admin,barber,customer',
            'status'   => 'required|in:active,inactive'
        ]);

        $statusValue = $request->status == 'active' ? 1 : 0;

        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'status'   => $statusValue
        ]);

        return redirect('/admin/users')->with('success','User berhasil diupdate!');
    }

    //HAPUS USER
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/admin/users')->with('success','User berhasil dihapus!');
    }
}
