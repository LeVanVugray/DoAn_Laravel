<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('crud_user.forgot_password');
    }

    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $code = rand(100000, 999999);

        Session::put('reset_code', $code);
        Session::put('email', $request->email);

        // Send email (using simple mail stub here)
        Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset Code');
        });

        return redirect()->route('forgot.verifyCode')->withSuccess('Code sent to your email.');
    }

    public function showVerifyForm()
    {
        return view('crud_user.verify_code');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'password' => 'required|confirmed|min:6|regex:/^(?=.*[A-Z])(?=.*[\W\d]).+$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter and one special character or number.',
        ]);

        if ($request->code != Session::get('reset_code')) {
            return back()->withErrors(['code' => 'Invalid code.']);
        }

        $email = Session::get('email');

        if (!$email) {
            return redirect()->route('forgot.show')->withErrors(['email' => 'Session expired. Please request a new code.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot.show')->withErrors(['email' => 'User not found.']);
        }

        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'New password cannot be the same as the old password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Session::forget(['reset_code', 'email']);

        return redirect()->route('login')->withSuccess('Password reset successful!');
    }

}

?>