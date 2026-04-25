<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SimpleResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.forgot-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            
            return redirect()->route('login')
                ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
        }
        
        return back()->withErrors(['email' => 'Email tidak ditemukan']);
    }
}