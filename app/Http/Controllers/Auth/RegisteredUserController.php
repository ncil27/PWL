<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_user' => ['required', 'string', 'max:9', 'unique:users,id_user'],
            'username' => ['required', 'string', 'max:9', 'unique:users,username'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Debugging: Lihat apakah data diterima dengan benar
        Log::info('Register Request:', $request->all());

        $user = User::create([
            'id_user' => $request->username,
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password, ['rounds' => 10]),
            'role' => 'mahasiswa',
            'status' => 'aktif',
        ]);
    

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}