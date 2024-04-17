<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Denda;
use App\Models\DetailPeminjaman;
use Carbon\Carbon;
use DB;
use Alert;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::whereDate('batas_peminjaman', '<', Carbon::now()->toDateString())->get();

        if ($peminjaman->isNotEmpty()) {
            $peminjaman->each(function ($data) {
                $d = $data->where('jatuh_tempo', false);
                if ($d->get()->isNotEmpty()) {
                    $d->update([
                        'jatuh_tempo' => true
                    ]);

                    $id_buku = DetailPeminjaman::where('id_peminjaman', $data->id)->first()->id_buku;
                    $telat = Carbon::now()->diffInDays($data->batas_waktu);
                    Denda::create([
                        'id_user' => $data->id_user,
                        'id_buku' => $id_buku,
                        'telat' => $telat ?? 1,
                        'total_denda' => ($telat ?? 1) * 3000,
                    ]);
                }
            });
        }


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
                "jumlah_buku" => "required",
            ]);

            $pinjam = Peminjaman::create([
                "id_user" => auth()->user()->id,
                "tanggal_peminjaman" => Carbon::now(),
                "jumlah_buku" => $request->jumlah_buku,
            ]);

            DetailPeminjaman::create([
                "id_peminjaman" => $pinjam->id,
                "id_buku" => $request->id,
            ]);

            DB::commit();
            Alert::success('Success', 'Peminjaman berhasil dilakukan dan sedang menunggu konfirmasi');
            return redirect('/buku');
        } catch (\Throwable $th) {
            return $th;
            DB::rollback();
            Alert::error('Error', 'Peminjaman gagal dilakukan');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        try {
            Peminjaman::findOrFail(base64_decode($id))->delete();

            Alert::success('Success', 'Data peminjaman berhasil dihapus');
            return redirect('/peminjaman');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Data peminjaman gagal dihapus');
            return redirect()->back();
        }
    }

    public function pinjam(String $id)
    {
        return view('peminjaman.pinjam', [
            "title" => "Peminjaman Buku",
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
                "status_peminjaman" => true,
                "durasi_peminjaman" => 7,
                "batas_peminjaman" => Carbon::now()->addDay(7),
            ]);

            DB::commit();
            Alert::success('Success', 'Peminjaman berhasil dikonfirmasi');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Peminjaman gagal dikonfirmasi');
            return redirect()->back();
        }
    }

    public function kembalikan(String $id)
    {
        try {
            Peminjaman::findOrFail(base64_decode($id))->update([
                "status" => "Dikembalikan"
            ]);

            Alert::success('Success', 'Buku berhasil dikembalikan dan sedang menunggu konfirmasi');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', 'Buku gagal dikembalikan');
            return redirect()->back();
        }
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
            Alert::success('Success', 'Pengembalian berhasil dikonfirmasi');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Pengembalian gagal dikonfirmasi');
            return redirect()->back();
        }

    }
}
