<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;

class PageController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            "title" => "Beranda",
            "buku" => Buku::all(),
            "user" => User::where('role', 'peminjam')->get()
        ]);
    }

    public function profil()
    {
        return view('profile.index', [
            "title" => "Profil",
        ]);
    }
}
