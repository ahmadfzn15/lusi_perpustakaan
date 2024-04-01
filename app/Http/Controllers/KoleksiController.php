<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koleksi;

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
        $koleksi = Koleksi::where('id_buku', $request->id_buku)->where('id_user', auth()->user()->id)->get();
        if (!$koleksi->count()) {
            Koleksi::create([
                "id_user" => auth()->user()->id,
                "id_buku" => $request->id_buku,
            ]);

        }
        return redirect('/buku');
    }

    public function destroy(string $id)
    {
        Koleksi::findOrFail(base64_decode($id))->delete();

        return redirect('/koleksi');
    }
}
