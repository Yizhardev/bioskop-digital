<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(){
        $users = User::get();
        return view('admin.user', compact('users'));
    }
    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|',
            'password' => 'required|min:6|string',
            'role' => 'required|in:admin,pegawai'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.user')->with('Succes', 'data berhasil di tambahkan');
    }

    public function hapus($id){
        $users = User::findOrfail($id);
        $users->delete();
        return redirect()->route('admin.user')->with('Succes', 'User berhasil di hapus');
    }

    public function editUser($id){
        $users = User::findOrFail($id);
        return view('admin.edit', compact('users'));
    }

    public function edit(Request $request, $id){
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|',
            'password' => 'nullable|min:6|string',
        ]);

        $users = User::findOrFail($id);
        $users->name = $validated['name'];
        $users->email = $validated['email'];

        if($request->filled('password')){
            $users->password = Hash::make($validated['password']);
        }

        $users->save();
        return redirect()->route('user')->with('success', 'Data berhasil diperbarui');
    }
}
