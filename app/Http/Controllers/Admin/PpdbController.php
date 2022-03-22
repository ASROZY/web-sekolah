<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index()
    {
        $pendaftar = User::where('type', 3)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ppdb.index', compact('pendaftar'));
    }

    public function register()
    {
        return view('admin.ppdb.register');
    }

    public function ppdbStore(Request $request)
    {
        $request->validate([
            'foto' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'nokk' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'no_akta_kelahiran' => 'required',
            'ttl' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'anak_ke' => 'required',
            'jml_saudara' => 'required',
            'hobi' => 'required',
            'cita' => 'required',
            'asal_sekolah' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'nama_ayah' => 'required',
            'nik_ayah' => 'required',
            'ttl_ayah' => 'required',
            'status_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'phone_ayah' => 'required',
            'alamat_ayah' => 'required',
            'nama_ibu' => 'required',
            'nik_ibu' => 'required',
            'ttl_ibu' => 'required',
            'status_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'phone_ibu' => 'required',
            'alamat_ibu' => 'required',
            'nama_wali' => 'required',
            'nik_wali' => 'required',
            'ttl_wali' => 'required',
            'status_wali' => 'required',
            'pendidikan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'penghasilan_wali' => 'required',
            'phone_wali' => 'required',
            'alamat_wali' => 'required',
        ], [
            'foto.required' => 'Foto harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'Nisn harus diisi',
            'nokk.required' => 'Nokk harus diisi',
            'nik.required' => 'Nik harus diisi',
            'gender.required' => 'Gender harus diisi',
            'no_akta_kelahiran.required' => 'No akta kelahiran harus diisi',
            'ttl.required' => 'Ttl harus diisi',
            'agama.required' => 'Agama harus diisi',
            'status_keluarga.required' => 'Status keluarga harus diisi',
            'anak_ke.required' => 'Anak ke harus diisi',
            'jml_saudara.required' => 'Jumlah saudara harus diisi',
            'hobi.required' => 'Hobi harus diisi',
            'cita.required' => 'Cita-cita harus diisi',
            'asal_sekolah.required' => 'Asal sekolah harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'phone.required' => 'No Telephone harus diisi',
            'nama_ayah.required' => 'Nama ayah harus diisi',
            'nik_ayah.required' => 'Nik ayah harus diisi',
            'ttl_ayah.required' => 'Ttl ayah harus diisi',
            'status_ayah.required' => 'Status ayah harus diisi',
            'pendidikan_ayah.required' => 'Pendidikan ayah harus diisi',
            'pekerjaan_ayah.required' => 'Pekerjaan ayah harus diisi',
            'penghasilan_ayah.required' => 'Penghasilan ayah harus diisi',
            'phone_ayah.required' => 'No Telephone ayah harus diisi',
            'alamat_ayah.required' => 'Alamat ayah harus diisi',
            'nama_ibu.required' => 'Nama ibu harus diisi',
            'nik_ibu.required' => 'Nik ibu harus diisi',
            'ttl_ibu.required' => 'Ttl ibu harus diisi',
            'status_ibu.required' => 'Status ibu harus diisi',
            'pendidikan_ibu.required' => 'Pendidikan ibu harus diisi',
            'pekerjaan_ibu.required' => 'Pekerjaan ibu harus diisi',
            'penghasilan_ibu.required' => 'Penghasilan ibu harus diisi',
            'phone_ibu.required' => 'No Telephone ibu harus diisi',
            'alamat_ibu.required' => 'Alamat ibu harus diisi',
            'nama_wali.required' => 'Nama wali harus diisi',
            'nik_wali.required' => 'Nik wali harus diisi',
            'ttl_wali.required' => 'Ttl wali harus diisi',
            'status_wali.required' => 'Status wali harus diisi',
            'pendidikan_wali.required' => 'Pendidikan wali harus diisi',
            'pekerjaan_wali.required' => 'Pekerjaan wali harus diisi',
            'penghasilan_wali.required' => 'Penghasilan wali harus diisi',
            'phone_wali.required' => 'No Telephone wali harus diisi',
            'alamat_wali.required' => 'Alamat wali harus diisi',
        ]);

        $ppdb = new Formulir;
        $ppdb->user_id = Auth::user()->id;

        $item = $request->file('foto');
        if ($item) {
            $folder = '/images/ppdb/';
            $name = 'IMG-' . Carbon::now()->format('dmY') . '-' . Str::random(6) . '.' . $item->extension();
            $item->move(public_path() . $folder, $name);
            $ppdb->foto = $folder . $name;
        }

        $ppdb->nama = $request->nama;
        $ppdb->phone = $request->phone;
        $ppdb->nisn = $request->nisn;
        $ppdb->nokk = $request->nokk;
        $ppdb->nik = $request->nik;
        $ppdb->gender = $request->gender;
        $ppdb->no_akta_kelahiran = $request->no_akta_kelahiran;
        $ppdb->ttl = $request->ttl;
        $ppdb->agama = $request->agama;
        $ppdb->status_keluarga = $request->status_keluarga;
        $ppdb->anak_ke = $request->anak_ke;
        $ppdb->jml_saudara = $request->jml_saudara;
        $ppdb->hobi = $request->hobi;
        $ppdb->cita = $request->cita;
        $ppdb->asal_sekolah = $request->asal_sekolah;
        $ppdb->alamat = $request->alamat;
        $ppdb->nama_ayah = $request->nama_ayah;
        $ppdb->nik_ayah = $request->nik_ayah;
        $ppdb->ttl_ayah = $request->ttl_ayah;
        $ppdb->status_ayah = $request->status_ayah;
        $ppdb->pendidikan_ayah = $request->pendidikan_ayah;
        $ppdb->pekerjaan_ayah = $request->pekerjaan_ayah;
        $ppdb->penghasilan_ayah = $request->penghasilan_ayah;
        $ppdb->phone_ayah = $request->phone_ayah;
        $ppdb->alamat_ayah = $request->alamat_ayah;
        $ppdb->nama_ibu = $request->nama_ibu;
        $ppdb->nik_ibu = $request->nik_ibu;
        $ppdb->ttl_ibu = $request->ttl_ibu;
        $ppdb->status_ibu = $request->status_ibu;
        $ppdb->pendidikan_ibu = $request->pendidikan_ibu;
        $ppdb->pekerjaan_ibu = $request->pekerjaan_ibu;
        $ppdb->penghasilan_ibu = $request->penghasilan_ibu;
        $ppdb->phone_ibu = $request->phone_ibu;
        $ppdb->alamat_ibu = $request->alamat_ibu;
        $ppdb->nama_wali = $request->nama_wali;
        $ppdb->nik_wali = $request->nik_wali;
        $ppdb->ttl_wali = $request->ttl_wali;
        $ppdb->status_wali = $request->status_wali;
        $ppdb->pendidikan_wali = $request->pendidikan_wali;
        $ppdb->pekerjaan_wali = $request->pekerjaan_wali;
        $ppdb->penghasilan_wali = $request->penghasilan_wali;
        $ppdb->phone_wali = $request->phone_wali;
        $ppdb->alamat_wali = $request->alamat_wali;
        $ppdb->save();

        return redirect()->back()->with('status', 'Pendaftaran Berhasil');
    }

    public function detailPpdb($id)
    {
        $data = Formulir::where('user_id', $id)->first();

        return view('admin.ppdb.formulir', compact('data'));
    }

    public function detailData()
    {
        $data = Formulir::where('user_id', Auth::user()->id)->first();

        return view('admin.ppdb.formulir', compact('data'));
    }

    public function statusPpdb(Request $request)
    {
        $ppdb = Formulir::where('user_id', $request->id)->first();
        $ppdb->status = $request->status;
        $ppdb->save();
        $status = $request->status == 1 ? 'diterima' : 'ditolak';

        return json_encode([
            'success' => true,
            'message' => 'Status PPDB berhasil ' . $status
        ]);
    }

    public function deletePpdb(Request $request)
    {
        $pengurus = User::find($request->id);
        $ppdb = Formulir::where('user_id', $request->id)->first();
        if ($ppdb) {
            if (file_exists(public_path($ppdb->foto))) {
                unlink(public_path() . $ppdb->foto);
            }
            $ppdb->delete();
        }
        $pengurus->delete();

        return json_encode([
            'success' => true,
            'message' => 'Data PPDB berhasil dihapus'
        ]);
    }
}
