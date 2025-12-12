<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Quick login for development (disable in production)
     */
    public function quickLogin(Request $request)
    {
        // ⚠️ تأكد من تعطيل هذا في الإنتاج
        if (config('app.env') === 'production') {
            abort(404);
        }

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'المستخدم غير موجود']);
        }

        // تسجيل الدخول مباشرة
        Auth::login($user, true);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Handle login with 2FA support
     */
    protected function authenticated(Request $request, $user)
    {
        // التحقق إذا كان التحقق من خطوتين مفعلاً
        if ($user->two_factor_enabled) {
            // تسجيل خروج مؤقت
            Auth::logout();

            // حفظ معرف المستخدم في الجلسة
            Session::put('2fa:user:id', $user->id);
            Session::put('2fa:remember', $request->boolean('remember'));

            // توليد وإرسال الرمز
            $user->generateTwoFactorCode();

            try {
                Mail::to($user->email)->send(new TwoFactorCodeMail($user));
            } catch (\Exception $e) {
                \Log::error('2FA Email Error: ' . $e->getMessage());
            }

            return redirect()->route('2fa.show')
                ->with('status', 'تم إرسال رمز التحقق إلى بريدك الإلكتروني');
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
