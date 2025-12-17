<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Password hardcoded sesuai soal
        $email = 'admin@dompetku.com';
        $password = 'admin123';

        if ($request->email == $email && $request->password == $password) {
            // Simpan status login di session
            session(['is_logged_in' => true, 'user_name' => 'Administrator']);
            return redirect('/')->with('success', 'Berhasil Login!');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect('/login')->with('success', 'Berhasil Logout.');
    }
}