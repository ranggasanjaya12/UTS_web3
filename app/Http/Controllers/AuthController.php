<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index(){

        return view('auth.login');
    }

    public function auth(Request $request){
        //  dd($request->all());
      
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            $notification = array(
                'status' => 'toast_success',
                'title' => 'Login Berhasil',
                'message' => 'Login Berhasil',

            );  
            
            $id = Auth::user()->id;

            $update = User::find($id);
            $update->updated_at = now();
            $update->save();

            return redirect()->intended('/dashboard')->with($notification);
        }

        $notification = array(
                'status' => 'error',
                'title' => 'Login Gagal',
                'message' => 'Username / Password Salah',
        );
        return back()->with($notification);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'status' => 'toast_success',
            'title' => 'Logout berhasil',
            'message' => 'Terima kasih telah menggunakan aplikasi kami'
        );

        return redirect('/login')->with($notification);
    }   
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $request->session()->regenerate();

        $notification = [
            'status' => 'toast_success',
            'title' => 'Registrasi Berhasil',
            'message' => 'Akun Anda berhasil dibuat. Selamat datang!',
        ];

        return redirect()->intended('/dashboard')->with($notification);
    }

}