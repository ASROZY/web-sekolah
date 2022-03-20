<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function indexPengurus()
    {
        $pengurus = User::paginate(10);

        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function tambahPengurus()
    {
        return view('admin.pengurus.tambah');
    }

    public function storePengurus(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Nama belum diisi',
            'email.required' => 'Email belum diisi',
            'email.email' => 'Format Email salah',
            'phone.required' => 'No Telephone belum diisi',
            'password.required' => 'Password belum diisi',
        ]);

        $pengurus = new User;
        $pengurus->name = $request->name;
        $pengurus->email = $request->email;
        $pengurus->phone = $request->phone;
        $pengurus->type = $request->type;
        $pengurus->password = Hash::make($request->password);
        $pengurus->save();

        return redirect('admin/pengurus')->with('status', 'Data Disimpan');
    }

    public function editPengurus(User $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function updatePengurus(User $pengurus, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ], [
            'name.required' => 'Nama belum diisi',
            'email.required' => 'Email belum diisi',
            'email.email' => 'Format Email salah',
            'phone.required' => 'No Telephone belum diisi',
        ]);

        $pengurus->name = $request->name;
        $pengurus->email = $request->email;
        $pengurus->phone = $request->phone;
        $pengurus->type = $request->type;
        $pengurus->save();

        return redirect('admin/pengurus')->with('status', 'Data Disimpan');
    }

    public function deletePengurus(Request $request)
    {
        $pengurus = User::find($request->id);
        $pengurus->delete();

        return json_encode([
            'success' => true,
            'message' => 'Pengurus berhasil dihapus'
        ]);
    }
}
