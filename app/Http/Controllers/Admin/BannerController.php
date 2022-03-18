<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::paginate(10);

        return view('admin.banner.index', compact('banner'));
    }

    public function tambah()
    {
        return view('admin.banner.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'banner' => 'required|image',
        ], [
            'judul.required' => 'Judul belum diisi',
            'keterangan.required' => 'Isi Banner belum diisi',
            'banner.required' => 'Thumbnail belum diisi',
            'banner.image' => 'Format Thumbnail harus berupa Gambar',
        ]);

        $img = '';
        $item = $request->file('banner');
        if ($item) {
            $folder = '/images/banner/';
            $name = 'IMG-' . Carbon::now()->format('dmY') . '-' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $img = $folder . $name;
        }

        $banner = new Banner;
        $banner->judul = $request->judul;
        $banner->keterangan = $request->keterangan;
        $banner->img = $img;
        $banner->save();

        return redirect('admin/banner')->with('status', 'Banner Disimpan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Banner $banner, Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'banner' => 'image|nullable',
        ], [
            'judul.required' => 'Judul belum diisi',
            'keterangan.required' => 'Isi Banner belum diisi',
            'banner.image' => 'Format Thumbnail harus berupa Gambar',
        ]);

        $item = $request->file('banner');
        if ($item) {
            if (file_exists(public_path($banner->img))) {
                unlink(public_path() . $banner->img);
            }
            $folder = '/images/banner/';
            $name = 'IMG-' . Carbon::now()->format('dmY') . '-' . Str::random(5) . $item->extension();
            $item->move(public_path() . $folder, $name);
            $img = $folder . $name;
            $banner->img = $img;
        }

        $banner->judul = $request->judul;
        $banner->keterangan = $request->keterangan;
        $banner->save();

        return redirect('admin/banner')->with('status', 'Banner Disimpan');
    }

    public function delete(Request $request)
    {
        $banner = Banner::find($request->id);
        $banner->delete();

        return json_encode([
            'success' => true,
            'message' => 'banner berhasil dihapus'
        ]);
    }
}
