<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }


    //Aksi login
    public function login(Request $request)
    {
        //validasi data harus diisi
        $dataLogin = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //jika data username dan password terisi dengan benar
        if (auth()->attempt($dataLogin)) {

            //pengamanan sesi
            $request->session()->regenerate();

            //pengecekan role user
            //jika role user adalah admin
            if (auth()->user()->role == 'admin') {
                //maka menuju ke dashboard admin
                return redirect()->route('admin.dashboard');
            }
            //jika role user adalah manager
            else if (auth()->user()->role == 'manager') {
                //maka menuju halaman manager
                return redirect()->route('manager.dashboard');
            }
            //jika role user bukan admin dan manager
            else {
                //maka meuju ke halaman teknisi
                return redirect()->route('teknisi.index');
            }
        }

        //jika terdapat kesalahan dalam pengisian data username atau password
        else {
            //kembali ke halaman login dengan pesan error
            return redirect()->route('login')
                ->with('error', 'Username atau password salah.');
        }
    }
}
