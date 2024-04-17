<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Alert;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if ($request->query('search')) {
            $data = Buku::where('judul_buku', "LIKE", "%" . $request->query('search') . "%")->latest()->get();
        } else {
            $data = Buku::latest()->get();
        }

        return view('buku.index', [
            "title" => "Buku",
            "data" => $data
        ]);
    }

    public function show($id)
    {
        return view('buku.detail', [
            "title" => "Detail  Buku",
            "data" => Buku::findOrFail(base64_decode($id)),
            "ulasan" => Ulasan::with(['user', 'buku'])->where('id_buku', base64_decode($id))->get()
        ]);
    }

    public function create()
    {
        return view('buku.tambah', [
            "title" => "Form Tambah Buku",
            "kategori" => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "cover" => "nullable|image|mimes:png,jpg,jpeg,webp",
                "judul_buku" => "required|string",
                "penulis" => "required|string",
                "penerbit" => "required|string",
                "jumlah_halaman" => "nullable|numeric",
                "stok" => "required|numeric",
                "id_kategori" => "required|numeric",
            ]);

            $imageName = null;
            if ($request->hasFile('cover')) {
                $image = $request->file('cover');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/img', $imageName);
            }

            Buku::create([
                "cover" => $imageName,
                "judul_buku" => $request->judul_buku,
                "penulis" => $request->penulis,
                "penerbit" => $request->penerbit,
                "jumlah_halaman" => $request->jumlah_halaman,
                "stok" => $request->stok,
                "id_kategori" => $request->id_kategori,
            ]);

            Alert::success('Success', 'Buku berhasil ditambahkan');
            return redirect('/buku');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal ditambahkan');
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        return view('buku.edit', [
            "title" => "Form Edit Buku",
            "data" => Buku::findOrFail(base64_decode($id)),
            "kategori" => Kategori::all()
        ]);
    }

    public function update(string $id, Request $request)
    {
        try {
            $validated = $request->validate([
                "cover" => "nullable|image|mimes:png,jpg,jpeg",
                "judul_buku" => "required|string",
                "penulis" => "required|string",
                "penerbit" => "required|string",
                "jumlah_halaman" => "nullable|numeric",
                "id_kategori" => "required|numeric",
            ]);

            $checkCover = Buku::findOrFail(base64_decode($id))->cover;
            $imageName;
            if ($request->hasFile('cover')) {
                if ($checkCover) {
                    Storage::delete('img/'.$checkCover);
                    $image = $request->file('cover');
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public/img', $imageName);
                }
                $image = $request->file('cover');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/img', $imageName);

                Buku::findOrFail(base64_decode($id))->update([
                    "cover" => $imageName,
                    "judul_buku" => $request->judul_buku,
                    "penulis" => $request->penulis,
                    "penerbit" => $request->penerbit,
                    "jumlah_halaman" => $request->jumlah_halaman,
                    "id_kategori" => $request->id_kategori,
                ]);
            } else {
                Buku::findOrFail(base64_decode($id))->update([
                    "judul_buku" => $request->judul_buku,
                    "penulis" => $request->penulis,
                    "penerbit" => $request->penerbit,
                    "jumlah_halaman" => $request->jumlah_halaman,
                    "id_kategori" => $request->id_kategori,
                ]);
            }


            Alert::success('Success', 'Buku berhasil diubah');
            return redirect('/buku');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal diubah');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        try {
            Buku::findOrFail(base64_decode($id))->delete();

            Alert::success('Success', 'Buku berhasil dihapus');
            return redirect('/buku');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal dihapus');
            return redirect()->back();
        }
    }
}
