<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;

class DendaController extends Controller
{
    public function index() {
        return view('denda.index', [
            "title" => "Denda",
            "data_admin" => Denda::with(['user', 'buku'])->latest()->get(),
            "data_peminjam" => Denda::with(['user', 'buku'])->where('id_user', auth()->user()->id)->latest()->get()
        ]);
    }
}
