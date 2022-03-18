<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::paginate(8);
        $banner = Banner::get();

        return view('home', compact('berita', 'banner'));
    }

    public function berita($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        // return $berita;
        return view('berita', compact('berita'));
    }
}
