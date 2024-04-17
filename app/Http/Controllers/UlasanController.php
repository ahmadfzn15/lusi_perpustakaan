<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use Alert;

class UlasanController extends Controller
{
    public function index() {
        return view('ulasan.index', [
            "title" => "Ulasan",
            "data" => Ulasan::with(['user', 'buku'])->latest()->get(),
        ]);
    }

    public function tambah(String $id) {
        return view('ulasan.tambah', [
            "title" => "Buat Ulasan",
            "id_buku" => $id
        ]);
    }

    public function store(Request $request)
    {
        try {
            Ulasan::create([
                "id_user" => auth()->user()->id,
                "id_buku" => base64_decode($request->id_buku),
                "ulasan" => $request->ulasan,
            ]);

            Alert::success('Success', 'Terima kasih telah memberikan ulasan.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', 'Gagal memberikan ulasan silahkan coba lagi.');
            return redirect()->back();
        }
    }
}
