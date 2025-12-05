<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز التحقق</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #003366, #0055AA);
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .code-box {
            background: linear-gradient(135deg, #f0f7ff, #e8f4fd);
            border: 2px dashed #003366;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }
        .code {
            font-size: 42px;
            font-weight: bold;
            color: #003366;
            letter-spacing: 10px;
            font-family: 'Courier New', monospace;
        }
        .expires {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 15px;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 13px;
            color: #856404;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 رمز التحقق</h1>
        </div>
        
        <div class="content">
            <p class="greeting">مرحباً {{ $user->name }}،</p>
            
            <p>لقد طلبت تسجيل الدخول إلى حسابك. استخدم الرمز التالي:</p>
            
            <div class="code-box">
                <div class="code">{{ $code }}</div>
                <p class="expires">⏰ ينتهي خلال 10 دقائق</p>
            </div>
            
            <div class="warning">
                ⚠️ <strong>تنبيه أمني:</strong> لا تشارك هذا الرمز مع أي شخص. فريقنا لن يطلب منك هذا الرمز أبداً.
            </div>
        </div>
        
        <div class="footer">
            <p>هذا البريد تم إرساله تلقائياً من {{ config('app.name') }}</p>
            <p>إذا لم تطلب هذا الرمز، يرجى تجاهل هذا البريد.</p>
        </div>
    </div>
</body>
</html>
