@extends('admin.layouts.app')

@section('title', 'إدارة المنتجات -مضلات وسواتر الرياض')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">إدارة المنتجات</h2>
            <p class="text-gray-600 mt-1">عرض وإدارة جميع منتجات المتجر</p>
        </div>
 <!-- الزر الأصلي -->
<a href="{{ route('admin.products.create') }}" 
   id="createProductBtn"
   class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg hover:from-primary-dark hover:to-primary transition-all duration-300 shadow-md hover:shadow-lg">
   <i class="fas fa-plus-circle ml-2"></i>
   إضافة منتج جديد
</a>

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
        <h2 class="text-gray-800 text-xl font-semibold mt-6">جاري التوجيه إلى الصفحة</h2>
        <p class="text-gray-600 mt-2 text-center">يتم الآن تحميل الصفحة التالية، الرجاء الانتظار...</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
            <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
        </div>
        <p id="progressText" class="text-sm text-gray-500 mt-2">0%</p>
    </div>
</div>

<script>
document.getElementById('createProductBtn').addEventListener('click', function(e) {
   const isSlowConnection = navigator.connection ? 
      (navigator.connection.downlink < 1 || navigator.connection.effectiveType === 'slow-2g' || navigator.connection.effectiveType === '2g') : 
      false;
   
   // إذا كان الاتصال بطيئًا، نعرض دائرة التحميل
   if (isSlowConnection) {
      e.preventDefault();
      
      // إظهار دائرة التحميل في وسط الشاشة
      const overlay = document.getElementById('loadingOverlay');
      overlay.classList.remove('hidden');
      
      // محاكاة تقدم التحميل
      let progress = 0;
      const progressBar = document.getElementById('progressBar');
      const progressText = document.getElementById('progressText');
      const progressCircle = document.querySelector('.progress-ring__circle--progress');
      const radius = progressCircle.r.baseVal.value;
      const circumference = 2 * Math.PI * radius;
      
      progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
      progressCircle.style.strokeDashoffset = circumference;
      
      const interval = setInterval(() => {
         progress += 5;
         if (progress <= 100) {
            const offset = circumference - (progress / 100) * circumference;
            progressCircle.style.strokeDashoffset = offset;
            progressBar.style.width = `${progress}%`;
            progressText.textContent = `${progress}%`;
         } else {
            clearInterval(interval);
         }
      }, 100);
      
      // الانتقال إلى الصفحة بعد فترة
      setTimeout(function() {
         window.location.href = document.getElementById('createProductBtn').href;
      }, 2000);
   }
});

// إخفاء دائرة التحميل عند اكتمال تحميل الصفحة
window.addEventListener('load', function() {
   document.getElementById('loadingOverlay').classList.add('hidden');
});

// إخفاء دائرة التحميل إذا ضغط المستخدم على زر الرجوع
window.addEventListener('pageshow', function(event) {
   if (event.persisted) {
      document.getElementById('loadingOverlay').classList.add('hidden');
   }
});
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
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">إجمالي المنتجات</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">المنتجات النشطة</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $activeProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-border-style text-amber-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">الستائر</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $curtainsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-umbrella-beach text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">المظلات</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $canopiesCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- بطاقة عرض المنتجات -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- رأس البطاقة مع البحث والتصفية -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <h3 class="text-lg font-medium text-gray-800">قائمة المنتجات</h3>
                
                <div class="mt-4 md:mt-0 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <!-- حقل البحث -->
                    <div class="relative">
                        <input type="text" placeholder="ابحث عن منتج..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 w-full">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- زر التصفية -->
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 flex items-center">
                        <i class="fas fa-filter ml-2"></i>
                        تصفية
                    </button>
                </div>
            </div>
        </div>

        <!-- جدول المنتجات -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الصورة</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المنتج</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التصنيف</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السعر</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-12 h-12 rounded-md overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $product->image_url) }}" 
                                     alt="{{ $product->name_ar }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name_ar }}</div>
                            <div class="text-sm text-gray-500">{{ $product->type }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $categoryColors = [
                                    'curtain' => 'bg-blue-100 text-blue-800',
                                    'canopy' => 'bg-green-100 text-green-800',
                                    'hanger' => 'bg-amber-100 text-amber-800',
                                    'other' => 'bg-gray-100 text-gray-800'
                                ];
                                $categoryNames = [
                                    'curtain' => 'ستائر',
                                    'canopy' => 'مظلات',
                                    'hanger' => 'هانجر',
                                    'other' => 'أخرى'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $categoryColors[$product->category] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $categoryNames[$product->category] ?? $product->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->price }}</div>
                            @if($product->price_label)
                                <div class="text-xs text-gray-500">{{ $product->price_label }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">نشط</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">غير نشط</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.products.show', $product) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                   title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" 
                                   title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                            title="حذف"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center py-10">
                                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                <p>لا توجد منتجات حتى الآن</p>
                                <a href="{{ route('admin.products.create') }}" class="text-[#1a5d7a] hover:underline mt-2">
                                    إضافة منتج جديد
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- الترقيم -->
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    عرض <span class="font-medium">{{ $products->firstItem() }}</span> إلى 
                    <span class="font-medium">{{ $products->lastItem() }}</span> من 
                    <span class="font-medium">{{ $products->total() }}</span> منتج
                </div>
                <div class="flex space-x-2">
                    @if ($products->onFirstPage())
                        <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                            السابق
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-50 border border-gray-300">
                            السابق
                        </a>
                    @endif

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-50 border border-gray-300">
                            التالي
                        </a>
                    @else
                        <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                            التالي
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .stats-card {
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    table {
        border-spacing: 0;
        width: 100%;
    }
    
    th, td {
        padding: 12px 15px;
        text-align: right;
    }
    
    tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }
    
    tbody tr:last-child {
        border-bottom: none;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // إضافة تأثيرات عند التمرير
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('animate__animated', 'animate__fadeInUp');
            }, index * 100);
        });

        // رسائل التأكيد عند الحذف
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('هل أنت متأكد من أنك تريد حذف هذا المنتج؟ لا يمكن التراجع عن هذا الإجراء.')) {
                    e.preventDefault();
                }
            });
        });

        // البحث الفوري (يمكن تطويره ليعمل مع AJAX)
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                // يمكن إضافة وظيفة البحث هنا
                console.log('بحث عن: ', this.value);
            }
        });
    });
</script>
@endsection