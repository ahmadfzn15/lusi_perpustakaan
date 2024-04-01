<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if ($request->query('search')) {
            $data = Buku::where('judul_buku', "LIKE", "%" . $request->query('search') . "%")->get();
        } else {
            $data = Buku::all();
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
        $validated = $request->validate([
            "cover" => "required|image|mimes:png,jpg,jpeg",
            "judul_buku" => "required|string",
            "penulis" => "required|string",
            "penerbit" => "required|string",
            "jumlah_halaman" => "nullable|numeric",
            "id_kategori" => "required|numeric",
        ]);

        $imageName;
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
            "id_kategori" => $request->id_kategori,
        ]);

        return redirect('/buku');
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
        $validated = $request->validate([
            "cover" => "required|image|mimes:png,jpg,jpeg",
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
        }

        Buku::findOrFail(base64_decode($id))->update([
            "cover" => $imageName,
            "judul_buku" => $request->judul_buku,
            "penulis" => $request->penulis,
            "penerbit" => $request->penerbit,
            "jumlah_halaman" => $request->jumlah_halaman,
            "id_kategori" => $request->id_kategori,
        ]);

        return redirect('/buku');
    }

    public function destroy(string $id)
    {
        Buku::findOrFail(base64_decode($id))->delete();

        return redirect('/buku');
    }
}
