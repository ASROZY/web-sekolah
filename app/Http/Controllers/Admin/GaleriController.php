<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Galeri;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function indexAlbum()
    {
        $album = Album::paginate(10);

        return view('admin.galeri.album', compact('album'));
    }

    public function storeAlbum(Request $request)
    {
        $request->validate([
            'album' => 'required'
        ], [
            'album.required' => 'Album harus diisi'
        ]);

        $album = new Album;
        $album->album = $request->album;
        $album->save();

        return redirect()->back()->with('status', 'Album Disimpan');
    }

    public function updateAlbum(Request $request, Album $album)
    {
        $request->validate([
            'album' => 'required'
        ], [
            'album.required' => 'Album harus diisi'
        ]);

        $album->album = $request->album;
        $album->save();

        return redirect()->back()->with('status', 'Album Disimpan');
    }

    public function statusAlbum(Request $request)
    {
        $album = Album::find($request->id);
        $album->status = $album->status == 0 ? 1 : 0;
        $album->save();

        return json_encode([
            'success' => true,
            'message' => 'Album berhasil disimpan'
        ]);
    }

    public function deleteAlbum(Request $request)
    {
        $album = Album::find($request->id);
        $galeri = Galeri::where('album_id', $request->id)->get();
        foreach ($galeri as $item) {
            $item->delete();
        }
        $album->delete();


        return json_encode([
            'success' => true,
            'message' => 'Album berhasil dihapus'
        ]);
    }

    public function indexGaleri(Album $album)
    {
        $galeri = Galeri::where('album_id', $album->id)->paginate(10);

        return view('admin.galeri.galeri', compact('album', 'galeri'));
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'foto' => 'required|image',
            'keterangan' => 'required'
        ], [
            'foto.required' => 'Foto harus diisi',
            'foto.image' => 'Format Foto salah',
            'keterangan.required' => 'Keterangan harus diisi'
        ]);

        $item = $request->file('foto');
        $galeri = new Galeri;
        if ($item) {
            $folder = '/images/galeri/' . $request->album_id . '/';
            $name = 'IMG_' . Carbon::now()->format('dmY') . '-' . Str::random(6) . '.' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $galeri->img = $folder . $name;
        }

        $galeri->album_id = $request->album_id;
        $galeri->keterangan = $request->keterangan;
        $galeri->save();

        return redirect()->back()->with('status', 'Galeri Disimpan');
    }

    public function updateGaleri(Request $request, Galeri $galeri)
    {
        $request->validate([
            'foto' => 'nullable|image',
            'keterangan' => 'required'
        ], [
            'foto.image' => 'Format Foto salah',
            'keterangan.required' => 'Keterangan harus diisi'
        ]);

        $item = $request->file('foto');
        if ($item) {
            if (file_exists(public_path($galeri->img))) {
                unlink(public_path() . $galeri->img);
            }
            $folder = '/images/galeri/' . $request->album_id . '/';
            $name = 'IMG_' . Carbon::now()->format('dmY') . '-' . Str::random(6) . '.' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $galeri->img = $folder . $name;
        }

        $galeri->keterangan = $request->keterangan;
        $galeri->save();

        return redirect()->back()->with('status', 'Galeri Disimpan');
    }

    public function deleteGaleri(Request $request)
    {
        $galeri = Galeri::find($request->id);
        if (file_exists(public_path($galeri->img))) {
            unlink(public_path() . $galeri->img);
        }
        $galeri->delete();

        return json_encode([
            'success' => true,
            'message' => 'Foto berhasil dihapus'
        ]);
    }
}
