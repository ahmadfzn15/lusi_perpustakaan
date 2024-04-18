<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;
use Carbon\Carbon;
use DB;
use Alert;

class DendaController extends Controller
{
    public function index() {
        return view('denda.index', [
            "title" => "Denda",
            "data_admin" => Denda::with(['user', 'buku'])->latest()->get(),
            "data_peminjam" => Denda::with(['user', 'buku'])->where('id_user', auth()->user()->id)->latest()->get()
        ]);
    }

    public function bayar(String $id)
    {
        DB::beginTransaction();
        try {
            $denda = Denda::findOrFail($id);
            $denda->update([
                "status" => true,
                "tanggal_bayar" => Carbon::now()
            ]);

            DB::commit();
            Alert::success('Success', 'Denda berhasil dibayar, tunggu konfirmasi dari admin');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Error', 'Denda gagal dibayar');
            return redirect()->back();
        }
    }
}
