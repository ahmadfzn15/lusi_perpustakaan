<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koleksi;
use Alert;

class KoleksiController extends Controller
{
    public function index()
    {
        return view('koleksi.index', [
            "title" => "Koleksi",
            "data" => Koleksi::with('buku')->where('id_user', auth()->user()->id)->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $koleksi = Koleksi::where('id_buku', $request->id_buku)->where('id_user', auth()->user()->id)->get();
            if (!$koleksi->count()) {
                Koleksi::create([
                    "id_user" => auth()->user()->id,
                    "id_buku" => $request->id_buku,
                ]);

            }

            Alert::success('Success', 'Buku berhasil ditambahkan kedalam koleksi');
            return redirect('/buku');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal ditambahkan kedalam koleksi');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        try {
            Koleksi::findOrFail(base64_decode($id))->delete();

            Alert::success('Success', 'Buku berhasil dihapus dari koleksi');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal dihapus dari koleksi');
            return redirect()->back();
        }
    }
}
