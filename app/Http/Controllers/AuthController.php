<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view ('auth/login');
    }

    public function signup()
    {
        return view('auth/signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLogin(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
            );

            $user = [
                'name' => $request->username,
                'password' => $request->password,
            ];

            if (Auth::attempt($user)) {
                return redirect('/products');
            } else {
                return redirect('/login')->with('error', 'Username atau Password Salah');
            }
    }

    public function storeSignup(Request $request)
    {
        // return $request;
        $request->validate(
        [
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ],
        [
            'email.required'=> 'jangan lupa isi email',
            'email.email' => 'email tidak valid',
            'email.unique' => 'email sudah digunakan',
            'username.required' => 'username tidak boleh kosong',
            'username.min' => 'username minimal 5 karakter',
            'password.required' => 'password nya di isi',
            'password.same' => 'password tidak sama',
            'confirm_password.required' => 'jangan lupa di confirm ya password nya',
            'confirm_password.min' => 'konfirmasi password minimal 5'
            ]
    );

    User::create([
        'name'=>$request->username,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);

        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
