<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function absen()
    {
        $absen = absen::get();

        return view('absen',compact('absen'));
    }

    public function absenTambah(Request $request)
    {
        $absen = new absen;
        $absen->nama = $request->nama;
        $absen->keterangan = $request->keterangan;
        $absen->save();

        return redirect()->back()->with('status', 'absen berhasil disimpan');
    }

    public function absenUpdate(absen $absen, Request $request)
    {
        $absen->nama = $request->nama;
        $absen->keterangan = $request->keterangan;
        $absen->save();

        return redirect()->back()->with('status', 'absen berhasil disimpan');
    }

    public function kategoriHapus(absen $absen)
    {
        $absen->delete();

        return redirect()->back()->with('status', 'absen berhasil dihapus');
    }
}
