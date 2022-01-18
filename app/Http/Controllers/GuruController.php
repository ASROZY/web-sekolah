<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function guru()
    {
        $absen = Absen::get();
        $guru = guru::get();

        return view('/guru/guru', compact('guru', 'absen'));
    }
    public function guruTambah(Request $request)
    {
        $this->validate($request, [
            // 'fotoProduk' => 'required|nullable',
            'fotoProduk.*' => 'image|max:2048|mimes:jpeg,png,jpg,svg',
            'nama' => 'required',
            'kategori' => 'required',
            // 'supplier' => 'required',
            'berat' => 'required',
        ],[
            // 'fotoProduk.required' => 'Foto Produk Belum diisi',
            'fotoProduk.*.image' => 'Format Gambar Salah ',
            'fotoProduk.*.mimes' => 'Format Gambar harus: jpeg, png, jpg, svg ',
            'fotoProduk.*.max' => 'Gambar Terlalu Besar ',
            'uploaded' => 'Gambar Gagal Diupload',
            'nama.required' => 'Nama Produk harus diisi',
            'kategori.required' => 'Kategori harus dipilih',
            // 'supplier.required' => 'Supplier belum dipilih',
            'berat.required' => 'Berat guru belum diisi',
        ]);

        try {
            $image[] = array();
            if($request->file('fotoProduk'))
             {
                foreach($request->file('fotoProduk') as $i => $foto)
                {
                    $name = Str::random(5).'_'.$i.'_'.time().'.'.$foto->extension();
                    $image[$i] = [
                        'image' => url('/').'/images/guru/'.$name,
                        'storage' => '/images/guru/'.$name,
                    ];
                    $foto->move(public_path().'/images/guru/', $name);
                }
            }else{
                $image[0] = [
                    'image' => url('/').'/images/browse.png',
                    'storage' => '/images/browse.png',
                ];
            }

            $guru = new Guru;
            $guru->image = json_encode($image);
            $guru->nama = $request->nama;
            $guru->absen_id = $request->kategori;
            $guru->berat = $request->berat;
            $guru->keterangan = $request->keterangan;
            $guru->save();

            return redirect()->back()->with('status','Produk Tersimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status',$th);
        }
    }

    public function guruEdit(Guru $guru, Request $request)
    {
        $this->validate($request, [
            // 'fotoProduk' => 'required|nullable',
            'fotoProduk.*' => 'image|max:2048|mimes:jpeg,png,jpg,svg',
            'nama' => 'required',
            'kategori' => 'required',
            // 'supplier' => 'required',
            'berat' => 'required',
        ],[
            // 'fotoProduk.required' => 'Foto Produk Belum diisi',
            'fotoProduk.*.image' => 'Format Gambar Salah ',
            'fotoProduk.*.mimes' => 'Format Gambar harus: jpeg, png, jpg, svg ',
            'fotoProduk.*.max' => 'Gambar Terlalu Besar ',
            'uploaded' => 'Gambar Gagal Diupload',
            'nama.required' => 'Nama Produk harus diisi',
            'kategori.required' => 'Kategori harus dipilih',
            // 'supplier.required' => 'Supplier belum dipilih',
            'berat.required' => 'Berat guru belum diisi',
        ]);

        $image[] = array();
        if($request->file('fotoProduk'))
         {
            foreach($request->file('fotoProduk') as $i => $foto)
            {
                $name = Str::random(5).'_'.$i.'_'.time().'.'.$foto->extension();
                $image[$i] = [
                    'image' => url('/').'/images/guru/'.$name,
                    'storage' => '/images/guru/'.$name,
                ];
                $foto->move(public_path().'/images/guru/', $name);
            }
        }elseif($guru->image){
            $image = json_decode($guru->image);
        }else{
            $image[0] = [
                'image' => url('/').'/images/browse.png',
                'storage' => '/images/browse.png',
            ];
        }

        $guru->image = json_encode($image);
        $guru->nama = $request->nama;
        $guru->kategori_id = $request->kategori;
        $guru->berat = $request->berat;
        $guru->keterangan = $request->keterangan;
        $guru->save();

        return redirect()->back()->with('status','Produk Tersimpan');
    }

    public function produkStok(Produk $guru)
    {
        // $kategori = Kategori::get();

        $stok = $guru->stok->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });
        return view('/guru/stok', compact('guru','stok'));
    }

    public function produkStokSave(Produk $guru, Request $request)
    {
        $stok = $guru->stok->whereIn('id',json_decode($request->ids));
        foreach($stok as $item){
            $item->harga_jual = $request->harga_jual;
            $item->status = 1;
            $item->save();
        }
        if($guru->status==0){
            $guru->status = 1;
            $guru->save();
        }
        return redirect()->back()->with('status','Stok guru Tersimpan');
    }

    public function produkUpdate(Produk $guru, Request $request)
    {
        $this->validate($request, [
            'fotoProduk' => 'nullable',
            'fotoProduk.*' => 'image|max:2048|mimes:jpeg,png,jpg,svg',
            'nama' => 'required',
            'kategori' => 'required',
            // 'supplier' => 'required',
            'berat' => 'required',
        ],[
            // 'fotoProduk.required' => 'Foto Produk Belum diisi',
            'fotoProduk.*.image' => 'Format Gambar Salah ',
            'fotoProduk.*.mimes' => 'Format Gambar harus: jpeg, png, jpg, svg ',
            'fotoProduk.*.max' => 'Gambar Terlalu Besar ',
            'uploaded' => 'Gambar Gagal Diupload',
            'nama.required' => 'Nama Produk harus diisi',
            'kategori.required' => 'Kategori harus dipilih',
            // 'supplier.required' => 'Supplier belum dipilih',
            'berat.required' => 'Berat guru belum diisi',
        ]);

        if($request->has('fotoProduk'))
        {
            $image[] = array();
            $imageLama = json_decode($guru->image);
            if($request->file('fotoProduk'))
            {
                foreach($request->file('fotoProduk') as $i => $foto)
                {
                    $name = Str::random(5).'_'.$i.'_'.time().'.'.$foto->extension();
                    $image[$i] = [
                        'image' => url('/').'/images/guru/'.$name,
                        'storage' => '/images/guru/'.$name,
                    ];
                    $foto->move(public_path().'/images/guru/', $name);
                }
            }
            $imageBaru = array_merge($imageLama,$image);
            $gambar = json_encode($imageBaru);
        }else{
            $gambar = $guru->image;
        }

        $guru->image = $gambar;
        $guru->nama = $request->nama;
        $guru->kategori = $request->kategori;
        $guru->berat = $request->berat;
        $guru->keterangan = $request->keterangan;
        $guru->save();

        return redirect()->back()->with('status','Produk Tersimpan');
    }

    public function produkDelete(Produk $guru)
    {
        foreach (json_decode($guru->image) as $item)
        {
            if($item->image != url('/').'/images/browse.png'){
                if(file_exists(public_path($item->storage)))
                {
                    unlink(public_path() . $item->storage);
                }
            }
        }
        $guru->delete();

        return redirect()->back()->with('status','Produk Terhapus');
    }
}


}
