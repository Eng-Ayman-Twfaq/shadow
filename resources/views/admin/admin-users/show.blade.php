@extends('admin.layouts.app')

@section('title', 'عرض المستخدم - ' . $adminUser->full_name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">عرض تفاصيل المستخدم: {{ $adminUser->full_name }}</h2>
            <p class="text-gray-600 mt-1">عرض جميع تفاصيل المستخدم المحدد</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.admin-users.edit', $adminUser) }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-edit ml-2"></i> تعديل المستخدم
            </a>
            <a href="{{ route('admin.admin-users.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-[#1a5d7a] border border-[#1a5d7a] rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i> العودة إلى قائمة المستخدمين
            </a>
        </div>
    </div>

    <!-- معلومات المستخدم الأساسية -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- الصورة اليسرى -->
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center text-white text-4xl font-bold mb-4">
                        {{ substr($adminUser->full_name, 0, 1) }}
                    </div>
                    @if($adminUser->is_active)
                        <span class="px-4 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">مستخدم نشط</span>
                    @else
                        <span class="px-4 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">مستخدم غير نشط</span>
                    @endif
                </div>

                <!-- المعلومات اليمنى -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">معلومات المستخدم</h3>
                    
                    <div class="space-y-4">
                        <!-- الاسم الكامل -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">الاسم الكامل:</div>
                            <div class="flex-1 font-medium">{{ $adminUser->full_name }}</div>
                        </div>
                        
                        <!-- اسم المستخدم -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">اسم المستخدم:</div>
                            <div class="flex-1">{{ $adminUser->username }}</div>
                        </div>
                        
                        <!-- الحالة -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">الحالة:</div>
                            <div class="flex-1">
                                @if($adminUser->is_active)
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">نشط</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">غير نشط</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- تاريخ الإنشاء -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">تاريخ الإنشاء:</div>
                            <div class="flex-1">{{ $adminUser->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        
                        <!-- آخر تحديث -->
                        <div class="flex items-start">
                            <div class="w-32 text-gray-600 font-medium">آخر تحديث:</div>
                            <div class="flex-1">{{ $adminUser->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- أزرار الإجراءات -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.admin-users.edit', $adminUser) }}" class="px-4 py-2 bg-[#1a5d7a] text-white rounded-lg hover:bg-[#154a61] transition-colors duration-200">
                    <i class="fas fa-edit ml-2"></i> تعديل المستخدم
                </a>
                <form action="{{ route('admin.admin-users.destroy', $adminUser) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200"
                            onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟ لا يمكن التراجع عن هذا الإجراء.')">
                        <i class="fas fa-trash ml-2"></i> حذف المستخدم
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .user-detail-row {
        padding: 12px 0;
        border-bottom: 1px solid #edf2f7;
    }
    
    .user-detail-row:last-child {
        border-bottom: none;
    }
    
    .user-badge {
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
        const elements = document.querySelectorAll('.user-detail-row, .bg-gray-50');
        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('animate__animated', 'animate__fadeIn');
            }, index * 100);
        });
    });
</script>
@endsection