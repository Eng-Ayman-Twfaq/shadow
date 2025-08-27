@extends('admin.layouts.app')

@section('title', 'عرض طلب الاتصال - ' . $contactRequest->full_name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">عرض تفاصيل طلب الاتصال: {{ $contactRequest->full_name }}</h2>
            <p class="text-gray-600 mt-1">عرض جميع تفاصيل طلب الاتصال المحدد</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.contact-requests.edit', $contactRequest) }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-edit ml-2"></i> تعديل الطلب
            </a>
            <a href="{{ route('admin.contact-requests.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i> العودة إلى قائمة الطلبات
            </a>
        </div>
    </div>

    <!-- حالة الطلب -->
    <div class="mb-6">
        <div class="flex items-center">
            <div class="w-3 h-3 rounded-full {{ $contactRequest->is_read ? 'bg-green-500' : 'bg-amber-500' }} mr-2"></div>
            <span class="text-sm font-medium {{ $contactRequest->is_read ? 'text-green-700' : 'text-amber-700' }}">
                {{ $contactRequest->is_read ? 'الطلب مقروء' : 'الطلب غير مقروء - جديد' }}
            </span>
        </div>
    </div>

    <!-- معلومات الطلب الأساسية -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- الصورة اليسرى -->
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center text-white text-4xl font-bold mb-4">
                        {{ substr($contactRequest->full_name, 0, 1) }}
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-800">{{ $contactRequest->full_name }}</h3>
                        <p class="text-gray-600">{{ $contactRequest->service_type }}</p>
                    </div>
                </div>

                <!-- المعلومات اليمنى -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">معلومات الطلب</h3>
                    
                    <div class="space-y-4">
                        <!-- الاسم الكامل -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">الاسم الكامل:</div>
                            <div class="flex-1 font-medium">{{ $contactRequest->full_name }}</div>
                        </div>
                        
                        <!-- الهاتف -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">الهاتف:</div>
                            <div class="flex-1">
                                <a href="tel:{{ $contactRequest->phone }}" class="text-[#1a5d7a] hover:underline">
                                    {{ $contactRequest->phone }}
                                </a>
                            </div>
                        </div>
                        
                        <!-- نوع الخدمة -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">نوع الخدمة:</div>
                            <div class="flex-1">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ $contactRequest->service_type }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- الحالة -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">الحالة:</div>
                            <div class="flex-1">
                                @if($contactRequest->is_read)
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">مقروءة</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">غير مقروءة</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- تاريخ الإرسال -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">تاريخ الإرسال:</div>
                            <div class="flex-1">
                                {{ $contactRequest->submitted_at->format('d/m/Y') }}<br>
                                <span class="text-gray-500 text-sm">{{ $contactRequest->submitted_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- الرسالة -->
            @if($contactRequest->message)
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">الرسالة:</h3>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-700 leading-relaxed">{{ $contactRequest->message }}</p>
                </div>
            </div>
            @endif
            
            <!-- أزرار الإجراءات -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="tel:{{ $contactRequest->phone }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-phone ml-2"></i> الاتصال
                </a>
                <a href="https://wa.me/{{ $contactRequest->phone }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fab fa-whatsapp ml-2"></i> واتساب
                </a>
                <a href="{{ route('admin.contact-requests.edit', $contactRequest) }}" class="px-4 py-2 bg-[#1a5d7a] text-white rounded-lg hover:bg-[#154a61] transition-colors duration-200">
                    <i class="fas fa-edit ml-2"></i> تعديل الطلب
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .request-detail-row {
        padding: 12px 0;
        border-bottom: 1px solid #edf2f7;
    }
    
    .request-detail-row:last-child {
        border-bottom: none;
    }
    
    .request-badge {
        background-color: #1a5d7a;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تأثيرات عند التمرير
        const elements = document.querySelectorAll('.request-detail-row, .bg-gray-50');
        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('animate__animated', 'animate__fadeIn');
            }, index * 100);
        });
    });
</script>
@endsection