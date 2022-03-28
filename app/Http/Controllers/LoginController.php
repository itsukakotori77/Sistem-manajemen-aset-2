<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        switch($request->method())
        {
            case 'GET':
                $title = 'Sistem Manajemen Aset | SMAN 1 Darangdan';
                return view('Auth.login', compact('title'));
            break;

            case 'POST':

                // Validasi
                $messages = [
                    'username.required' => 'Tolong Masukkan Username',
                    'password.required' => 'Tolong Masukkan Password',
                ];

                // Validasi
                $validator = Validator::make($request->all(), [
                    'password' => 'required|string|max:199'
                ], $messages);
                
                // Cek Kontrol
                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }

                // If Super Admin
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 1], $request->remember))
                {
                    // return redirect('/dashboard');
                    return redirect('/dashboard');
                    // return 'Super Admin';
                }

                // If Ketua Kompetensi
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 2], $request->remember))
                {
                    // return redirect('/dashboard');
                    return redirect('/dashboard');
                    // return 'Bagian Sarpras';
                }

                // If Ketua Sarpras
                elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1, 'role_id' => 3], $request->remember))
                {
                    // return redirect('/dashboard');
                    return redirect('/dashboard');
                    // return 'Kepala Sekolah';
                }

                // Redirect Bak
                return back()->with('Status', 'Password salah');

            break;

            default:
                return '404 not found';
            break;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
