<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
use App\Models\User;
use App\Services\ActivityService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            ActivityService::log('User', 'Login', $user->id);
            return redirect()->intended(route('users.index'))->with('success', 'Logged in successfully');
        }
    
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        ActivityService::log('User', 'Logout', $user->id);
    
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
    


    public function forgetPassword()
    {
        return view('auth.forgetPassword');
    }
    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        $token = Str::random(64);
    
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );
    
        // Log the password reset request activity
        ActivityService::log('User', 'Password Reset Request', $request->email);
    
        Mail::send('emails.resetLink', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });
    
        return view('auth.checkEmail');
    }
    


    public function resetPassword($token)
    {
        return view('auth.newPassword', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|string|min:8',
            'password_confirmation' => 'required',
        ]);
    
        $updatedPassword = PasswordResetToken::where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();
    
        if (!$updatedPassword) {
            return redirect()->back()->with('error', 'Invalid token');
        }
    
        // Log the password reset activity
        ActivityService::log('User', 'Password Reset', $request->email);
    
        User::where('email', $request->email)->first()->update(['password' => bcrypt($request->password)]);
        PasswordResetToken::where('email', $request->email)->delete();
    
        return redirect()->route('login')->with('success', 'Your password has been reset.');
    }
    
}