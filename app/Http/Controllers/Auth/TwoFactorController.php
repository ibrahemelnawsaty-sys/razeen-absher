<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends Controller
{
    /**
     * عرض صفحة إدخال رمز التحقق
     */
    public function show()
    {
        if (!Session::has('2fa:user:id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor');
    }

    /**
     * إرسال رمز التحقق
     */
    public function sendCode(User $user)
    {
        $user->generateTwoFactorCode();

        try {
            Mail::to($user->email)->send(new TwoFactorCodeMail($user));
            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to send 2FA code: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * التحقق من الرمز
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ], [
            'code.required' => 'الرجاء إدخال رمز التحقق',
            'code.size' => 'رمز التحقق يجب أن يكون 6 أرقام',
        ]);

        $userId = Session::get('2fa:user:id');

        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'انتهت الجلسة، يرجى تسجيل الدخول مجدداً');
        }

        $user = User::find($userId);

        if (!$user) {
            Session::forget('2fa:user:id');
            return redirect()->route('login')
                ->with('error', 'المستخدم غير موجود');
        }

        if ($user->isValidTwoFactorCode($request->code)) {
            $user->clearTwoFactorCode();
            Session::forget('2fa:user:id');
            
            Auth::login($user, Session::get('2fa:remember', false));
            Session::forget('2fa:remember');

            return redirect()->intended(route('dashboard'))
                ->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        return back()->withErrors([
            'code' => 'رمز التحقق غير صحيح أو منتهي الصلاحية',
        ]);
    }

    /**
     * إعادة إرسال الرمز
     */
    public function resend()
    {
        $userId = Session::get('2fa:user:id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if ($user) {
            $this->sendCode($user);
        }

        return back()->with('status', 'تم إرسال رمز جديد إلى بريدك الإلكتروني');
    }

    /**
     * تفعيل/تعطيل التحقق من خطوتين
     */
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->save();

        $status = $user->two_factor_enabled ? 'تم تفعيل' : 'تم تعطيل';

        return back()->with('success', "{$status} التحقق من خطوتين بنجاح");
    }
}
