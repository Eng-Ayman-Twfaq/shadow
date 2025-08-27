<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ظل الجنوب - تسجيل الدخول</title>
    <!-- Tailwind CSS مع دعم RTL -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a5d7a;
            --primary-dark: #0d3245;
            --accent: #e69500;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-out;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .login-header {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }
        
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 93, 122, 0.2);
            background-color: white;
        }
        
        .btn-login {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: white;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(26, 93, 122, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(26, 93, 122, 0.25);
        }
        
        .btn-login:disabled {
            opacity: 0.8;
            cursor: not-allowed;
        }
        
        .btn-text {
            transition: opacity 0.3s ease;
        }
        
        .btn-loading .btn-text {
            opacity: 0;
        }
        
        .btn-spinner {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 3px solid transparent;
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .btn-loading .btn-spinner {
            opacity: 1;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .divider::before {
            margin-left: 10px;
        }
        
        .divider::after {
            margin-right: 10px;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--primary);
            top: -150px;
            right: -150px;
        }
        
        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--accent);
            bottom: -100px;
            left: -100px;
        }
        
        .shape-3 {
            width: 150px;
            height: 150px;
            background: var(--primary-dark);
            bottom: 20%;
            right: 10%;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group .form-input {
            padding-right: 16px;
            padding-left: 50px;
        }
        
        .toggle-password {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
        }
        
        .toggle-password:hover {
            color: var(--primary);
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            max-width: 300px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <!-- الأشكال العائمة في الخلفية -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- دائرة التحميل -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner mb-4"></div>
            <h3 class="text-lg font-semibold text-gray-800">جاري تسجيل الدخول</h3>
            <p class="text-gray-600 mt-2">الرجاء الانتظار...</p>
        </div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                  <img src="{{ asset('images/logo.png') }}" alt="شعار الموقع" class="w-20 h-20 object-contain">
                </div>
                <h2 class="text-2xl font-bold">مضلات وسواتر الرياض</h2>
                <p class="mt-2">لوحة تحكم المتجر</p>
            </div>
            
            <div class="login-body">
                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg border border-red-200">
                        <i class="fas fa-exclamation-circle ml-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg border border-green-200">
                        <i class="fas fa-check-circle ml-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form id="loginForm" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-gray-700 mb-2 font-medium">اسم المستخدم</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="username" class="form-input" placeholder="أدخل اسم المستخدم" required autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2 font-medium">كلمة المرور</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-input" placeholder="أدخل كلمة المرور" required>
                            <span class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <button type="submit" id="loginBtn" class="btn-login w-full">
                            <span class="btn-text">
                                <i class="fas fa-sign-in-alt ml-2"></i>
                                تسجيل الدخول
                            </span>
                            <span class="btn-spinner"></span>
                        </button>
                    </div>
                    
                    <div class="divider mb-5">أو</div>
                    
                    <div class="text-center">
                        <a href="#" class="text-sm text-[#1a5d7a] hover:text-[#0d3245] transition-colors duration-200">
                            <i class="fas fa-question-circle ml-2"></i>
                            نسيت كلمة المرور؟
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-6 text-gray-500 text-sm">
            <p>© 2024مضلات وسواتر الرياض. جميع الحقوق محفوظة</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // إظهار/إخفاء كلمة المرور
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // تغيير الأيقونة
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
            
            // تأثيرات عند التركيز على الحقول
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#1a5d7a';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#94a3b8';
                });
            });
            
            // التعامل مع إرسال النموذج
            loginForm.addEventListener('submit', function(e) {
                // منع الإرسال الفوري للنموذج (لأغراض العرض)
               
                
                // إظهار دائرة التحميل على الزر
                loginBtn.classList.add('btn-loading');
                loginBtn.disabled = true;
                
                // إظهار دائرة التحميل في منتصف الشاشة
                loadingOverlay.classList.add('active');
                
                // محاكاة عملية تسجيل الدخول (في التطبيق الحقيقي، سيتم إرسال النموذج مباشرة)
                // setTimeout(function() {
                    // في التطبيق الحقيقي، قم بإلغاء التعليق عن السطر التالي لإرسال النموذج
                    loginForm.submit();
                    
                    // لأغراض العرض، سنعرض رسالة نجاح بعد 2 ثانية
                    // loadingOverlay.classList.remove('active');
                    // loginBtn.classList.remove('btn-loading');
                    // loginBtn.disabled = false;
                    
                    // alert('تم تسجيل الدخول بنجاح! في التطبيق الحقيقي، سيتم توجيهك إلى لوحة التحكم.');
                // }, 2000);
            });
        });
    </script>
</body>
</html>