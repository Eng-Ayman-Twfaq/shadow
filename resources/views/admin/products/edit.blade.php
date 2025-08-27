@extends('admin.layouts.app')

@section('title', 'تعديل المنتج - ' . $product->name_ar)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">تعديل المنتج: {{ $product->name_ar }}</h2>
            <p class="text-gray-600 mt-1">قم بتعديل تفاصيل المنتج المحدد</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.products.show', $product) }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-eye ml-2"></i> عرض التفاصيل
            </a>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i> العودة إلى قائمة المنتجات
            </a>
        </div>
    </div>

    <!-- نموذج تعديل المنتج -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- القسم الأيسر -->
                    <div>
                        <!-- اسم المنتج -->
                        <div class="mb-5">
                            <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-1">اسم المنتج (العربية)</label>
                            <input type="text" id="name_ar" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('name_ar') border-red-500 @enderror"
                                   placeholder="أدخل اسم المنتج بالعربية">
                            @error('name_ar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- وصف المنتج -->
                        <div class="mb-5">
                            <label for="description_ar" class="block text-sm font-medium text-gray-700 mb-1">وصف المنتج (العربية)</label>
                            <textarea id="description_ar" name="description_ar" rows="4" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('description_ar') border-red-500 @enderror"
                                      placeholder="أدخل وصف المنتج بالعربية">{{ old('description_ar', $product->description_ar) }}</textarea>
                            @error('description_ar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- التصنيف -->
                        <div class="mb-5">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">التصنيف</label>
                            <select id="category" name="category" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('category') border-red-500 @enderror">
                                <option value="" disabled {{ !old('category', $product->category) ? 'selected' : '' }}>اختر التصنيف</option>
                                <option value="curtain" {{ old('category', $product->category) == 'curtain' ? 'selected' : '' }}>ستائر</option>
                                <option value="canopy" {{ old('category', $product->category) == 'canopy' ? 'selected' : '' }}>مظلات</option>
                                <option value="hanger" {{ old('category', $product->category) == 'hanger' ? 'selected' : '' }}>هانجر</option>
                                <option value="other" {{ old('category', $product->category) == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- النوع -->
                        <div class="mb-5">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">نوع المنتج</label>
                            <input type="text" id="type" name="type" value="{{ old('type', $product->type) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('type') border-red-500 @enderror"
                                   placeholder="أدخل نوع المنتج">
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الحالة -->
                        <div class="mb-5">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} 
                                       class="h-5 w-5 text-[#1a5d7a] border-gray-300 rounded focus:ring-[#1a5d7a]">
                                <span class="mr-3 text-sm font-medium text-gray-700">المنتج نشط</span>
                            </label>
                            @error('is_active')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- القسم الأيمن -->
                    <div>
                        <!-- السعر -->
                        <div class="mb-5">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">السعر</label>
                            <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('price') border-red-500 @enderror"
                                   placeholder="أدخل سعر المنتج">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- تسمية السعر -->
                        <div class="mb-5">
                            <label for="price_label" class="block text-sm font-medium text-gray-700 mb-1">تسمية السعر (اختياري)</label>
                            <input type="text" id="price_label" name="price_label" value="{{ old('price_label', $product->price_label) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('price_label') border-red-500 @enderror"
                                   placeholder="مثال: سعر خاص">
                            @error('price_label')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الضمان -->
                        <div class="mb-5">
                            <label for="warranty" class="block text-sm font-medium text-gray-700 mb-1">الضمان (اختياري)</label>
                            <input type="text" id="warranty" name="warranty" value="{{ old('warranty', $product->warranty) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('warranty') border-red-500 @enderror"
                                   placeholder="مثال: ضمان 5 سنوات">
                            @error('warranty')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- العلامات -->
                        <div class="mb-5">
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">العلامات (اختياري)</label>
                            <input type="text" id="tags" name="tags" value="{{ old('tags', $product->tags) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('tags') border-red-500 @enderror"
                                   placeholder="أدخل العلامات مفصولة بفواصل">
                            @error('tags')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- نص الشارة -->
                        <div class="mb-5">
                            <label for="badge_text" class="block text-sm font-medium text-gray-700 mb-1">نص الشارة (اختياري)</label>
                            <input type="text" id="badge_text" name="badge_text" value="{{ old('badge_text', $product->badge_text) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('badge_text') border-red-500 @enderror"
                                   placeholder="مثال: جديد">
                            @error('badge_text')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رسالة الواتساب -->
                        <div class="mb-5">
                            <label for="whatsapp_message" class="block text-sm font-medium text-gray-700 mb-1">رسالة الواتساب</label>
                            <textarea id="whatsapp_message" name="whatsapp_message" rows="3" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 @error('whatsapp_message') border-red-500 @enderror"
                                      placeholder="أدخل الرسالة التي ستظهر عند النقر على زر الواتساب">{{ old('whatsapp_message', $product->whatsapp_message) }}</textarea>
                            @error('whatsapp_message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- صورة المنتج -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">صورة المنتج الحالية</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image_url) }}" 
                                     alt="{{ $product->name_ar }}" 
                                     class="w-full h-40 object-cover rounded-lg border border-gray-200">
                            </div>
                            
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">تغيير الصورة (اختياري)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#1a5d7a] hover:text-[#154a61] focus-within:outline-none">
                                            <span>اختر ملفًا جديدًا</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">أو اسحب وأفلت</p>
                                    </div>
                                    <p class="text-xs text-gray-500">JPEG, PNG حتى 10MB</p>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">إذا لم تقم برفع صورة جديدة، سيتم الاحتفاظ بالصورة الحالية</p>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار الحفظ -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between">
                <button type="button" id="deleteProductBtn" 
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200"
                        onclick="confirmDelete()">
                    <i class="fas fa-trash ml-2"></i>
                    حذف المنتج
                </button>
                <button type="submit" id="saveProductBtn" 
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
        <p class="text-gray-600 mt-2 text-center">يتم الآن حفظ التعديلات على المنتج، الرجاء الانتظار...</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
            <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
        </div>
        <p id="progressText" class="text-sm text-gray-500 mt-2">0%</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveBtn = document.getElementById('saveProductBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const progressCircle = document.querySelector('.progress-ring__circle--progress');
    const productForm = document.getElementById('productForm');
    
    // حساب محيط الدائرة
    const radius = progressCircle.r.baseVal.value;
    const circumference = 2 * Math.PI * radius;
    progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
    progressCircle.style.strokeDashoffset = circumference;

    // إضافة معالج حدث لنموذج النموذج
    productForm.addEventListener('submit', function(e) {
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
    if (confirm('هل أنت متأكد من رغبتك في حذف هذا المنتج؟ لا يمكن التراجع عن هذا الإجراء.')) {
        // إنشاء نموذج مؤقت لحذف المنتج
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.products.destroy', $product) }}';
        
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
    input[type="file"], 
    textarea, 
    select {
        transition: all 0.2s ease;
    }
    
    input[type="text"]:focus, 
    textarea:focus, 
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
        const productForm = document.getElementById('productForm');
        productForm.addEventListener('submit', function(e) {
            const nameField = document.getElementById('name_ar');
            const categoryField = document.getElementById('category');
            const priceField = document.getElementById('price');
            
            let isValid = true;
            let errorMessage = '';
            
            // التحقق من الحقول المطلوبة
            if (!nameField.value.trim()) {
                nameField.classList.add('input-error');
                isValid = false;
                errorMessage = 'اسم المنتج مطلوب.';
            }
            
            if (!categoryField.value) {
                categoryField.classList.add('input-error');
                isValid = false;
                if (!errorMessage) errorMessage = 'التصنيف مطلوب.';
            }
            
            if (!priceField.value.trim()) {
                priceField.classList.add('input-error');
                isValid = false;
                if (!errorMessage) errorMessage = 'السعر مطلوب.';
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