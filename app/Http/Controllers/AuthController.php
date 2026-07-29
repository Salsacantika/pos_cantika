<?php 

namespace App\Http\Controllers; 

use App\Http\Requests\LoginRequest; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 
// PERBAIKAN 1: Wajib menambahkan import Request di sini untuk fungsi logout
use Illuminate\Http\Request; 

class AuthController extends Controller 
{ 
    public function index() 
    { 
        return view('login'); 
    } 

    public function auth(LoginRequest $request) 
    { 
        if (Auth::attempt($request->validated())) { 
            
            $request->session()->regenerate(); 
            
            return redirect()->route('dashboard')->with('success', 'Selamat Datang, ' . Auth::user()->name); 
        } 

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email'); 
    } 

    // PERBAIKAN 2: Mengubah 'Reuest' menjadi 'Request' yang benar
    public function logout(Request $request) 
    { 
        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.'); 
    }
}
