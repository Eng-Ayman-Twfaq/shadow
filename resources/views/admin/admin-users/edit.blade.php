@extends('admin.layouts.app')

@section('title', 'تعديل المستخدم - ' . $adminUser->full_name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">تعديل المستخدم: {{ $adminUser->full_name }}</h2>
            <p class="text-gray-600 mt-1">قم بتعديل تفاصيل المستخدم المحدد</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.admin-users.show', $adminUser) }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-eye ml-2"></i> عرض التفاصيل
            </a>
            <a href="{{ route('admin.admin-users.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i> العودة إلى قائمة المستخدمين
            </a>
        </div>
    </div>

    <!-- نموذج تعديل المستخدم -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <form action="{{ route('admin.admin-users.update', $adminUser) }}" method="POST" id="userForm">
            @csrf
            @method('PUT')
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- القسم الأيسر -->
                    <div>
                        <!-- اسم المستخدم -->
                        <div class="mb-5">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">اسم المستخدم</label>
                            <input type="text" id="username" name="username" value="{{ old('username', $adminUser->username) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('username') border-red-500 @enderror"
                                   placeholder="أدخل اسم المستخدم">
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الاسم الكامل -->
                        <div class="mb-5">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $adminUser->full_name) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('full_name') border-red-500 @enderror"
                                   placeholder="أدخل الاسم الكامل">
                            @error('full_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- القسم الأيمن -->
                    <div>
                        <!-- كلمة المرور -->
                        <div class="mb-5">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور (اختياري)</label>
                            <input type="password" id="password" name="password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('password') border-red-500 @enderror"
                                   placeholder="أدخل كلمة المرور الجديدة (اتركها فارغة للإبقاء على القديمة)">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="mb-5">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200"
                                   placeholder="أعد إدخال كلمة المرور">
                        </div>

                        <!-- الحالة -->
                        <div class="mb-5">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $adminUser->is_active) ? 'checked' : '' }} 
                                       class="h-5 w-5 text-[#1a5d7a] border-gray-300 rounded focus:ring-[#1a5d7a]">
                                <span class="mr-3 text-sm font-medium text-gray-700">المستخدم نشط</span>
                            </label>
                            @error('is_active')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار الحفظ -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between">
                <button type="button" id="deleteUserBtn" 
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200"
                        onclick="confirmDelete()">
                    <i class="fas fa-trash ml-2"></i>
                    حذف المستخدم
                </button>
                <button type="submit" id="saveUserBtn" 
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg hover:from-primary-dark hover:to-primary transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-save ml-2"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</div>

<!-- دائرة التحميل المحسنة -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center justify-center w-80">
        <div class="relative">
            <svg class="progress-ring" width="120" height="120">
                <circle class="progress-ring__circle" stroke="#e6e6e6" stroke-width="4" fill="transparent" r="52" cx="60" cy="60"/>
                <circle class="progress-ring__circle progress-ring__circle--progress" stroke="#1a5d7a" stroke-width="4" fill="transparent" r="52" cx="60" cy="60" stroke-dasharray="326.56" stroke-dashoffset="326.56"/>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="loader ease-linear rounded-full border-4 border-t-4 border-transparent h-8 w-8"></div>
            </div>
        </div>
        <h2 class="text-gray-800 text-xl font-semibold mt-6">جاري حفظ التعديلات</h2>
        <p class="text-gray-600 mt-2 text-center">يتم الآن حفظ التعديلات على المستخدم، الرجاء الانتظار...</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
            <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
        </div>
        <p id="progressText" class="text-sm text-gray-500 mt-2">0%</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveBtn = document.getElementById('saveUserBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const progressCircle = document.querySelector('.progress-ring__circle--progress');
    const userForm = document.getElementById('userForm');
    
    // حساب محيط الدائرة
    const radius = progressCircle.r.baseVal.value;
    const circumference = 2 * Math.PI * radius;
    progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
    progressCircle.style.strokeDashoffset = circumference;

    // إضافة معالج حدث لنموذج النموذج
    userForm.addEventListener('submit', function(e) {
        // إظهار دائرة التحميل
        loadingOverlay.classList.remove('hidden');
        
        // محاكاة تقدم التحميل
        let progress = 0;
        const interval = setInterval(() => {
            progress += 2;
            if (progress <= 100) {
                const offset = circumference - (progress / 100) * circumference;
                progressCircle.style.strokeDashoffset = offset;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${progress}%`;
            } else {
                clearInterval(interval);
            }
        }, 50);
    });
});

function confirmDelete() {
    if (confirm('هل أنت متأكد من رغبتك في حذف هذا المستخدم؟ لا يمكن التراجع عن هذا الإجراء.')) {
        // إنشاء نموذج مؤقت لحذف المستخدم
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.admin-users.destroy', $adminUser) }}';
        
        // إضافة طريقة DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // إضافة CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // إضافة النموذج إلى الجسم وتنفيذه
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<style>
    .from-primary {
        background-image: linear-gradient(to right, var(--primary), var(--primary-dark));
    }

    .to-primary-dark {
        background-image: linear-gradient(to right, var(--primary), var(--primary-dark));
    }

    .hover\:from-primary-dark:hover {
        background-image: linear-gradient(to right, var(--primary-dark), var(--primary));
    }

    .hover\:to-primary:hover {
        background-image: linear-gradient(to right, var(--primary-dark), var(--primary));
    }
    
    .loader {
        border-top-color: #1a5d7a;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }

    .progress-ring__circle {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }

    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('styles')
<style>
    /* أنماط خاصة بصفحة التعديل */
    .form-section {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .form-section-header {
        background-color: #f8fafc;
        padding: 12px 16px;
        font-weight: 600;
        color: #4a5568;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .form-section-content {
        padding: 16px;
    }
    
    input[type="text"], 
    input[type="password"], 
    select {
        transition: all 0.2s ease;
    }
    
    input[type="text"]:focus, 
    input[type="password"]:focus, 
    select:focus {
        border-color: #1a5d7a;
        box-shadow: 0 0 0 3px rgba(26, 93, 122, 0.1);
    }
    
    /* أنماط الحقول عند وجود أخطاء */
    .input-error {
        border-color: #e53e3e !important;
    }
    
    .error-message {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    /* أنماط خاصة بالتحميل */
    .progress-ring {
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تفعيل تأثيرات عند التمرير
        const formElements = document.querySelectorAll('.mb-5');
        formElements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('animate__animated', 'animate__fadeIn');
            }, index * 50);
        });

        // التحقق من صحة النموذج قبل الإرسال
        const userForm = document.getElementById('userForm');
        userForm.addEventListener('submit', function(e) {
            const usernameField = document.getElementById('username');
            const fullNameField = document.getElementById('full_name');
            const passwordField = document.getElementById('password');
            
            let isValid = true;
            let errorMessage = '';
            
            // التحقق من الحقول المطلوبة
            if (!usernameField.value.trim()) {
                usernameField.classList.add('input-error');
                isValid = false;
                errorMessage = 'اسم المستخدم مطلوب.';
            }
            
            if (!fullNameField.value.trim()) {
                fullNameField.classList.add('input-error');
                isValid = false;
                if (!errorMessage) errorMessage = 'الاسم الكامل مطلوب.';
            }
            
            // إذا تم إدخال كلمة مرور جديدة، التحقق من صحتها
            if (passwordField.value.trim() && passwordField.value.length < 8) {
                passwordField.classList.add('input-error');
                isValid = false;
                if (!errorMessage) errorMessage = 'يجب أن تكون كلمة المرور مكونة من 8 أحرف على الأقل.';
            }
            
            // إذا كان النموذج غير صالح، منع الإرسال
            if (!isValid) {
                e.preventDefault();
                alert('يرجى تصحيح الأخطاء في النموذج: ' + errorMessage);
            }
        });
        
        // إزالة علامات الخطأ عند التفاعل مع الحقل
        document.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('focus', function() {
                this.classList.remove('input-error');
            });
        });
    });
</script>
@endsection