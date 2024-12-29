<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function showLoginForm()
    {
        $user = User::all();
        return view('admin.user.login', compact('user'));
    }

    // Menangani proses login
    public function login(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // If authentication fails, return with an error
        return back()->withErrors(['username' => 'Username atau password yang Anda masukkan salah.']);
    }

    public function index()
    {
        $user = User::all();
        return view('admin.user.index', [
            'users' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('added', '');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'nullable',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('updated', '');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('deleted', '');
    }

    // Menangani proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
