<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;
use DB;
use Alert;

class KategoriController extends Controller
{
    public function index() {
        $data1 = Kategori::latest()->get();
        $data2 = Buku::select('id_kategori', DB::raw('count(*) as total'))->groupBy('id_kategori')->get();

        $res = $data1->map(function ($data) use ($data2) {
            $d = $data2->where('id_kategori', $data->id)->first();

            return [
                "id" => $data->id,
                "kategori_buku" => $data->kategori_buku,
                "total" => $d ? $d->total : 0
            ];
        });

        return view('kategori.index', [
            "title" => "Kategori",
            "data" => $res,
        ]);
    }

    public function create() {
        return view('kategori.tambah', [
            "title" => "Tambah Kategori",
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "kategori" => "required|string",
            ]);

            Kategori::create([
                "kategori_buku" => $request->kategori,
            ]);

            Alert::success('Success', 'Kategori baru berhasil ditambahkan');
            return redirect('/kategori');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Kategori baru gagal ditambahkan');
            return redirect()->back();
        }
    }

    public function edit(string $id) {
        return view('kategori.edit', [
            "title" => "Edit Kategori",
            "data" => Kategori::findOrFail(base64_decode($id))
        ]);
    }

    public function update(String $id, Request $request)
    {
        try {
            $validated = $request->validate([
                "kategori" => "required|string",
            ]);

            Kategori::findOrFail(base64_decode($id))->update([
                "kategori_buku" => $request->kategori,
            ]);

            Alert::success('Success', 'Kategori berhasil diubah');
            return redirect('/kategori');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Kategori gagal diubah');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        try {
            Kategori::findOrFail(base64_decode($id))->delete();

            Alert::success('Success', 'Kategori berhasil dihapus');
            return redirect('/kategori');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Kategori gagal dihapus');
            return redirect()->back();
        }
    }
}
