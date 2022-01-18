<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function mapel()
    {
        $mapel = Mapel::get();

        return view('mapel',compact('mapel'));
    }

    public function mapelTambah(Request $request)
    {
        $mapel = new Mapel;
        $mapel->nama = $request->nama;
        $mapel->keterangan = $request->keterangan;
        $mapel->save();

        return redirect()->back()->with('status', 'Mapel berhasil disimpan');
    }

    public function mapelUpdate(Mapel $mapel, Request $request)
    {
        $mapel->nama = $request->nama;
        $mapel->keterangan = $request->keterangan;
        $mapel->save();

        return redirect()->back()->with('status', 'Mapel berhasil disimpan');
    }

    public function MapelHapus(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->back()->with('status', 'Mapel berhasil dihapus');
    }
}
