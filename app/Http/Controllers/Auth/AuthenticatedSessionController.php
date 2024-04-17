<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            toast('Login gagal!','error');
            return redirect()->back();
        }

        $request->session()->regenerate();

        toast('Login berhasil!','success');
        if (auth()->user()->role != "peminjam") {
            return redirect("/");
        } else {
            return redirect("/buku");
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            Auth::guard('web')->logout();

            Alert::success('Success', 'Logout berhasil');
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Logout gagal');
            return redirect()->back();
        }
    }
}
