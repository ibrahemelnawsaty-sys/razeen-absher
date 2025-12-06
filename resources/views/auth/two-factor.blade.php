@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-12 px-4">
    <div class="max-w-md w-full">
        
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6 text-center">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-4xl">🔐</span>
                </div>
                <h1 class="text-2xl font-bold text-white">التحقق من خطوتين</h1>
                <p class="text-indigo-100 mt-2 text-sm">أدخل الرمز المرسل إلى بريدك الإلكتروني</p>
            </div>
            
            <!-- Body -->
            <div class="p-8">
                
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">✅</span>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">❌</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('2fa.verify') }}" id="2fa-form">
                    @csrf
                    
                    <!-- Code Input -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3 text-center">
                            رمز التحقق
                        </label>
                        
                        <div class="flex justify-center gap-2" dir="ltr">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" maxlength="1" 
                                       class="code-input w-12 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
                                       data-index="{{ $i }}" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                            @endfor
                        </div>
                        
                        <input type="hidden" name="code" id="full-code">
                    </div>
                    
                    <!-- Timer -->
                    <div class="text-center mb-6">
                        <p class="text-sm text-gray-500">
                            ⏰ الرمز صالح لمدة <span id="timer" class="font-bold text-indigo-600">10:00</span>
                        </p>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" id="verify-btn" disabled
                            class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl disabled:opacity-50">
                        ✓ تحقق من الرمز
                    </button>
                </form>
                
                <!-- Resend -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500 mb-2">لم تستلم الرمز؟</p>
                    <form method="POST" action="{{ route('2fa.resend') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-indigo-600 hover:text-indigo-800 font-bold text-sm hover:underline">
                            📧 إعادة إرسال الرمز
                        </button>
                    </form>
                </div>
                
                <!-- Back to Login -->
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                        ← العودة لتسجيل الدخول
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.code-input');
    const fullCodeInput = document.getElementById('full-code');
    const verifyBtn = document.getElementById('verify-btn');
    
    inputs[0].focus();
    
    inputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateFullCode();
        });
        
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
            for (let i = 0; i < Math.min(pastedData.length, inputs.length); i++) {
                inputs[i].value = pastedData[i];
            }
            updateFullCode();
            const nextIndex = Math.min(pastedData.length, inputs.length - 1);
            inputs[nextIndex].focus();
        });
    });
    
    function updateFullCode() {
        let code = '';
        inputs.forEach(input => code += input.value);
        fullCodeInput.value = code;
        verifyBtn.disabled = code.length !== 6;
    }
    
    // Timer
    let timeLeft = 600;
    const timerElement = document.getElementById('timer');
    
    const countdown = setInterval(() => {
        timeLeft--;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            timerElement.textContent = 'منتهي';
            timerElement.classList.add('text-red-600');
        }
    }, 1000);
});
</script>
@endsection
