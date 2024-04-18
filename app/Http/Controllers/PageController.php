<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Alert;

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

    public function profilUpdate(Request $request)
    {
        try {
            $checkFoto = $request->user()->foto;
            $imageName;
            if ($request->hasFile('foto')) {
                if ($checkFoto) {
                    Storage::delete('img/'.$checkFoto);
                    $image = $request->file('foto');
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public/img', $imageName);
                }
                $image = $request->file('foto');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/img', $imageName);

                $request->user()->fill([
                    "foto" => $imageName,
                    "nama" => $request->nama,
                    "email" => $request->email,
                    "no_tlp" => $request->no_tlp,
                    "jenis_kelamin" => $request->jenis_kelamin,
                ]);
                $request->user()->save();
            } else {
                $request->user()->fill([
                    "nama" => $request->nama,
                    "email" => $request->email,
                    "no_tlp" => $request->no_tlp,
                    "jenis_kelamin" => $request->jenis_kelamin,
                ]);
                $request->user()->save();
            }

            Alert::success('Success', 'Profil berhasil diubah');
            return redirect("/");
        } catch (\Throwable $th) {
            Alert::error('Error', 'Profil gagal diubah');
            return redirect()->back();
        }
    }
}
