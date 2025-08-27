@extends('admin.layouts.app')

@section('title', 'طلبات الاتصال -مضلات وسواتر الرياض')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">طلبات الاتصال</h2>
            <p class="text-gray-600 mt-1">عرض وإدارة جميع طلبات الاتصال الواردة</p>
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
            <h2 class="text-gray-800 text-xl font-semibold mt-6">جاري التوجيه إلى الصفحة</h2>
            <p class="text-gray-600 mt-2 text-center">يتم الآن تحميل الصفحة التالية، الرجاء الانتظار...</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
                <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
            </div>
            <p id="progressText" class="text-sm text-gray-500 mt-2">0%</p>
        </div>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">إجمالي الطلبات</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalRequests }}</h3>
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
                    <h4 class="text-gray-500 text-sm font-medium">الطلبات المقروءة</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $readRequests }}</h3>
                </div>
            </div>
        </div>

        <div class="stats-card bg-white rounded-xl p-5 shadow-md border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-inbox text-amber-600 text-xl"></i>
                    </div>
                </div>
                <div class="mr-3 flex-grow">
                    <h4 class="text-gray-500 text-sm font-medium">الطلبات غير المقروءة</h4>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $unreadRequests }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- بطاقة عرض الطلبات -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- رأس البطاقة مع البحث والتصفية -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <h3 class="text-lg font-medium text-gray-800">قائمة طلبات الاتصال</h3>
                
                <div class="mt-4 md:mt-0 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <!-- حقل البحث عن الاسم -->
                    <div class="relative">
                        <input type="text" id="searchFullName" placeholder="ابحث عن الاسم..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 w-full">
                        <i class="fas fa-user absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- حقل البحث عن الهاتف -->
                    <div class="relative">
                        <input type="text" id="searchPhone" placeholder="ابحث عن الهاتف..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200 w-full">
                        <i class="fas fa-phone-alt absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- تصفية حسب الحالة -->
                    <div class="relative">
                        <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200">
                            <option value="">جميع الحالات</option>
                            <option value="1">مقروءة</option>
                            <option value="0">غير مقروءة</option>
                        </select>
                        <i class="fas fa-eye absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- تصفية حسب نوع الخدمة -->
                    <div class="relative">
                        <select id="filterService" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5d7a] focus:border-[#1a5d7a] transition-colors duration-200">
                            <option value="">جميع الخدمات</option>
                            @foreach($serviceTypes as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-concierge-bell absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- زر التصفية -->
                    <button id="filterButton" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 flex items-center">
                        <i class="fas fa-filter ml-2"></i>
                        تصفية
                    </button>
                </div>
            </div>
        </div>

      <!-- جدول الطلبات -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الاسم</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الهاتف</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نوع الخدمة</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($contactRequests as $request)
            <tr class="hover:bg-gray-50 transition-colors duration-150 {{ !$request->is_read ? 'bg-blue-50' : '' }}" 
                data-url="{{ route('admin.contact-requests.show', $request) }}">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center text-white font-bold">
                                {{ substr($request->full_name, 0, 1) }}
                            </div>
                        </div>
                        <div class="mr-4">
                            <div class="text-sm font-medium text-gray-900">{{ $request->full_name }}</div>
                            @if(!$request->is_read)
                                <div class="text-xs text-blue-600 font-medium mt-1">جديد</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $request->phone }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                        {{ $request->service_type }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($request->is_read)
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">مقروءة</span>
                    @else
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">غير مقروءة</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $request->submitted_at->format('d/m/Y') }}</div>
                    <div class="text-xs text-gray-500">{{ $request->submitted_at->format('H:i') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.contact-requests.show', $request) }}" 
                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                           title="عرض التفاصيل">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.contact-requests.edit', $request) }}" 
                           class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" 
                           title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.contact-requests.destroy', $request) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                    title="حذف"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟ لا يمكن التراجع عن هذا الإجراء.')">
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
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                        <p>لا توجد طلبات اتصال حتى الآن</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

        <!-- الترقيم -->
        @if($contactRequests->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    عرض <span class="font-medium">{{ $contactRequests->firstItem() }}</span> إلى 
                    <span class="font-medium">{{ $contactRequests->lastItem() }}</span> من 
                    <span class="font-medium">{{ $contactRequests->total() }}</span> طلب
                </div>
                <div class="flex space-x-2">
                    @if ($contactRequests->onFirstPage())
                        <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                            السابق
                        </span>
                    @else
                        <a href="{{ $contactRequests->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-50 border border-gray-300">
                            السابق
                        </a>
                    @endif

                    @if ($contactRequests->hasMorePages())
                        <a href="{{ $contactRequests->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-50 border border-gray-300">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // معالجة أزرار التصفية
    document.getElementById('filterButton').addEventListener('click', function() {
        const fullName = document.getElementById('searchFullName').value;
        const phone = document.getElementById('searchPhone').value;
        const status = document.getElementById('filterStatus').value;
        const service = document.getElementById('filterService').value;
        
        let url = '{{ route('admin.contact-requests.index') }}';
        const params = new URLSearchParams();
        
        if (fullName) params.append('full_name', fullName);
        if (phone) params.append('phone', phone);
        if (status !== '') params.append('is_read', status);
        if (service !== '') params.append('service_type', service);
        
        if (params.toString()) {
            url += '?' + params.toString();
        }
        
        window.location.href = url;
    });
    
    // إخفاء دائرة التحميل عند اكتمال تحميل الصفحة
    window.addEventListener('load', function() {
        document.getElementById('loadingOverlay').classList.add('hidden');
    });
    
    // معالجة النقر على عناصر الجدول - التعديل هنا
    document.querySelectorAll('tr[data-url]').forEach(row => {
        row.addEventListener('click', function(e) {
            // تجنب التفعيل إذا تم النقر على زر الإجراءات
            if (e.target.closest('.space-x-2')) {
                return;
            }
            
            window.location.href = this.dataset.url;
        });
    });
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
    
    .stats-card {
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection