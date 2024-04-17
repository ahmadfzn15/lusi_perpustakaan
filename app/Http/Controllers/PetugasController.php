<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Alert;

class PetugasController extends Controller
{
    public function index() {
        return view('petugas.petugas', [
            "title" => "Petugas",
            "data" => User::where('role', 'petugas')->latest()->get()
        ]);
    }

    public function create() {
        return view('petugas.tambah', [
            "title" => "Tambah Petugas",
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "nama" => "required|string",
                "email" => "required|string|unique:users",
                "no_tlp" => "nullable|string",
                "password" => "required",
            ]);

            User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "no_tlp" => $request->no_tlp,
                "password" => Hash::make($request->password),
                "role" => 'petugas',
            ]);

            Alert::success('Success', 'Petugas baru berhasil ditambahkan');
            return redirect('/petugas');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Petugas baru gagal ditambahkan');
            return redirect()->back();
        }
    }

    public function edit(string $id) {
        return view('petugas.edit', [
            "title" => "Edit Petugas",
            "data" => User::findOrFail(base64_decode($id))
        ]);
    }

    public function update(String $id, Request $request)
    {
        try {
            $validated = $request->validate([
                "nama" => "required|string",
                "email" => "required|string",
                "no_tlp" => "nullable|string",
                "password" => "required",
            ]);

            User::findOrFail(base64_decode($id))->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "no_tlp" => $request->no_tlp,
            ]);

            Alert::success('Success', 'Petugas berhasil diubah');
            return redirect('/petugas');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Petugas gagal ditambahkan');
            return redirect()->back();
        }
    }
}
