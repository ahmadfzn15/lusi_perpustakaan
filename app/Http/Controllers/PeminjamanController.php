<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Carbon\Carbon;
use DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('peminjaman.index', [
            "title" => "Peminjaman",
            "data_admin" => DetailPeminjaman::with(['peminjaman', 'buku', 'peminjaman.user'])->latest()->get(),
            "data_user" => DetailPeminjaman::with(['peminjaman', 'buku', 'peminjaman.user'])->whereRelation('peminjaman', 'id_user', auth()->user()->id)->latest()->get()
        ]);
    }

    public function show(String $id)
    {
        return view('peminjaman.detail', [
            "title" => "Detail Buku",
            "data" => Buku::findOrFail(base64_decode($id))
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                "jumlah" => "required|numeric",
            ]);

            $pinjam = Peminjaman::create([
                "id_user" => auth()->user()->id,
                "jumlah_buku" => $request->jumlah,
                "tanggal_peminjaman" => Carbon::now(),
            ]);

            DetailPeminjaman::create([
                "id_peminjaman" => $pinjam->id,
                "id_buku" => $request->id,
            ]);

            DB::commit();
            return redirect('/buku');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        Peminjaman::findOrFail(base64_decode($id))->delete();

        return redirect('/buku');
    }

    public function pinjam(String $id)
    {
        return view('peminjaman.pinjam', [
            "title" => "Detail Buku",
            "data" => Buku::findOrFail(base64_decode($id))
        ]);
    }

    public function konfirmasiPeminjaman(String $id)
    {
        DB::beginTransaction();
        try {
            $detail = DetailPeminjaman::where('id_peminjaman', base64_decode($id))->first();
            $peminjaman = Peminjaman::findOrFail(base64_decode($id));

            $buku = Buku::findOrFail($detail->id_buku);
            $buku->update([
                "stok" => $buku->stok - $peminjaman->jumlah_buku
            ]);

            $peminjaman->update([
                "status_peminjaman" => true
            ]);

            DB::commit();
            return redirect('/peminjaman');
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    public function kembalikan(String $id)
    {
        Peminjaman::findOrFail(base64_decode($id))->update([
            "status" => "Dikembalikan"
        ]);

        return redirect('/peminjaman');
    }

    public function konfirmasiPengembalian(String $id)
    {
        DB::beginTransaction();
        try {
            $detail = DetailPeminjaman::where('id_peminjaman', base64_decode($id))->first();
            $peminjaman = Peminjaman::findOrFail(base64_decode($id));

            $buku = Buku::findOrFail($detail->id_buku);
            $buku->update([
                "stok" => $buku->stok + $peminjaman->jumlah_buku
            ]);

            $peminjaman->update([
                "tanggal_pengembalian" => Carbon::now(),
                "status_peminjaman" => false,
                "status_pengembalian" => true,
            ]);

            DB::commit();
            return redirect('/peminjaman');
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return redirect('/peminjaman');
    }
}
