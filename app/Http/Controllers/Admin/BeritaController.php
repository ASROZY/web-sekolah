<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::paginate(10);

        return view('admin.berita.index', compact('berita'));
    }

    public function tambah()
    {
        $kategori = Kategori::get();

        return view('admin.berita.tambah', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'keterangan' => 'required',
            'thumbnail' => 'required|image',
        ], [
            'judul.required' => 'Judul belum diisi',
            'kategori_id.required' => 'Kategori belum diisi',
            'keterangan.required' => 'Isi Berita belum diisi',
            'thumbnail.required' => 'Thumbnail belum diisi',
            'thumbnail.image' => 'Format Thumbnail harus berupa Gambar',
        ]);

        $thumbnail = '';
        $item = $request->file('thumbnail');
        if ($item) {
            $folder = '/images/berita/';
            $name = 'IMG_' . Carbon::now()->format('dmY') . '-' . Str::random(6) . '.' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $thumbnail = $folder . $name;
        }

        $berita = new Berita;
        $berita->judul = $request->judul;
        $berita->slug =  Str::slug($request->judul, '-');
        $berita->kategori_id = $request->kategori_id;
        $berita->keterangan = $request->keterangan;
        $berita->thumbnail = $thumbnail;
        $berita->penulis_id = Auth::user()->id;
        $berita->save();

        return redirect('admin/berita')->with('status', 'Berita Disimpan');
    }

    public function edit(Berita $berita)
    {
        $kategori = Kategori::get();

        return view('admin.berita.edit', compact('kategori', 'berita'));
    }

    public function update(Berita $berita, Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'keterangan' => 'required',
            'thumbnail' => 'image|nullable',
        ], [
            'judul.required' => 'Judul belum diisi',
            'kategori_id.required' => 'Kategori belum diisi',
            'keterangan.required' => 'Isi Berita belum diisi',
            'thumbnail.image' => 'Format Thumbnail harus berupa Gambar',
        ]);

        $item = $request->file('thumbnail');
        if ($item) {
            if (file_exists(public_path($berita->thumbnail))) {
                unlink(public_path() . $berita->thumbnail);
            }
            $folder = '/images/berita/';
            $name = 'IMG_' . Carbon::now()->format('dmY') . '-' . Str::random(6) . '.' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $thumbnail = $folder . $name;
            $berita->thumbnail = $thumbnail;
        }

        $berita->judul = $request->judul;
        $berita->slug =  Str::slug($request->judul, '-');
        $berita->kategori_id = $request->kategori_id;
        $berita->keterangan = $request->keterangan;
        $berita->penulis_id = Auth::user()->id;
        $berita->save();

        return redirect('admin/berita')->with('status', 'Berita Disimpan');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Kategori belum diisi',
        ]);

        $kat = new Kategori;
        $kat->kategori = $request->kategori;
        $kat->save();

        return redirect()->back()->with('status', 'Kategori Disimpan');
    }

    public function delete(Request $request)
    {
        $berita = Berita::find($request->id);
        if (file_exists(public_path($berita->thumbnail))) {
            unlink(public_path() . $berita->thumbnail);
        }
        $berita->delete();

        return json_encode([
            'success' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }
}
