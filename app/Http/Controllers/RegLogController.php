<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Provider;

class RegLogController extends Controller
{
    public function create()
    {
        return view('register');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'surname' => $request['surname'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role_id' => 2,
        ]);
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials, true);
        if($user->role_id == 2){
            return redirect(route('profile'));
        } else if($user->role_id == 3){
            return redirect(route('admin'));
        }

        
    }
    public function edit()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials, true)) return back()->withInput()->withErrors(['email' => 'invalid date']);

        return redirect(route('profile'));
    }


    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'surname' => 'required|string',
            'name' => 'required|string',
            'foto' => 'image|mimes:jpg,jpeg,png,webp|max:10000'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . "." . $foto->getClientOriginalExtension();
            $foto->storeAs('/public/avas/', $filename);

            $filePath = storage_path('app/public/avas/' . $user->foto);
            if ($user->foto != null) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                } 
                
            }
            $user->update([
                'foto' => $filename,
            ]);
        };


        $user->update([
            'surname' => $request['surname'],
            'name' => $request['name'],
        ]);
        if ($user->role_id === 3) {
            return redirect(route('admin'));
        } else if ($user->role_id === 2) {
            return redirect(route('profile'));
        }

        // GTHT
    }



    public function edit_password(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $old_pass = $request['old_password'];
        // данные для аутентификации
        $credentials = [
            'email' => $user->email,
            'password' => $old_pass
        ];

        if (!Auth::attempt($credentials, true)) {
            return back()->withInput()->withErrors(['old_password' => 'неверный старый пароль']);
        } else {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
        };
        $user->update([
            'password' => bcrypt($request['password']),
        ]);
        return redirect(route('profile'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
    //
}
