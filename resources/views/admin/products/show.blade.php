@extends('admin.layouts.app')

@section('title', $product->name_ar . ' -مضلات وسواتر الرياض')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- رأس الصفحة -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">تفاصيل المنتج</h2>
            <p class="text-gray-600 mt-1">عرض التفاصيل الكاملة للمنتج</p>
        </div>
        <div class="flex space-x-3 mt-4 md:mt-0">
            <a href="{{ route('admin.products.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i>
                رجوع للمنتجات
            </a>
            <a href="{{ route('admin.products.edit', $product) }}" 
               class="inline-flex items-center px-4 py-2 bg-[#1a5d7a]  hover:from-[#0d3245] hover:to-[#1a5d7a] transition-all duration-300 shadow-md">
                <i class="fas fa-edit ml-2"></i>
                تعديل المنتج
            </a>
        </div>
    </div>

    <!-- البطاقة الرئيسية -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- رأس البطاقة -->
        <div class="bg-gradient-to-r from-[#1a5d7a] to-[#0d3245] px-6 py-4 text-white">
            <h3 class="text-xl font-bold">معلومات المنتج</h3>
        </div>

        <!-- محتوى البطاقة -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- العمود الأول: صورة المنتج -->
                <div>
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">صورة المنتج</h4>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 flex justify-center">
                            <img src="{{ asset('storage/' . $product->image_url) }}" 
                                 alt="{{ $product->name_ar }}" 
                                 class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                    </div>

                    <!-- الشارة -->
                    @if($product->badge_text)
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">نص الشارة</h4>
                        <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded-lg text-center font-medium">
                            {{ $product->badge_text }}
                        </div>
                    </div>
                    @endif

                    <!-- الحالة -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">حالة المنتج</h4>
                        <div class="flex items-center">
                            @if($product->is_active)
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-check-circle ml-2"></i> نشط
                                </span>
                            @else
                                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-times-circle ml-2"></i> غير نشط
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- العمود الثاني: تفاصيل المنتج -->
                <div>
                    <!-- المعلومات الأساسية -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">المعلومات الأساسية</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">اسم المنتج</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $product->name_ar }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600">التصنيف</label>
                                @php
                                    $categoryNames = [
                                        'curtain' => 'ستائر',
                                        'canopy' => 'مظلات',
                                        'hanger' => 'هانجر',
                                        'other' => 'أخرى'
                                    ];
                                    $categoryColors = [
                                        'curtain' => 'bg-blue-100 text-blue-800',
                                        'canopy' => 'bg-green-100 text-green-800',
                                        'hanger' => 'bg-amber-100 text-amber-800',
                                        'other' => 'bg-gray-100 text-gray-800'
                                    ];
                                @endphp
                                <span class="mt-1 px-3 py-1 rounded-full text-sm font-medium {{ $categoryColors[$product->category] }}">
                                    {{ $categoryNames[$product->category] }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600">النوع</label>
                                <p class="mt-1 text-gray-900">{{ $product->type }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- المعلومات المالية -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">المعلومات المالية</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">السعر</label>
                                <p class="mt-1 text-2xl font-bold text-[#1a5d7a]">{{ $product->price }}</p>
                            </div>
                            
                            @if($product->price_label)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">تسمية السعر</label>
                                <p class="mt-1 text-gray-900">{{ $product->price_label }}</p>
                            </div>
                            @endif
                            
                            @if($product->warranty)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">الضمان</label>
                                <p class="mt-1 text-gray-900">{{ $product->warranty }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- معلومات إضافية -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">معلومات إضافية</h4>
                        <div class="space-y-4">
                            @if($product->tags)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">العلامات</label>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    @foreach(explode(',', $product->tags) as $tag)
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600">تاريخ الإنشاء</label>
                                <p class="mt-1 text-gray-900">{{ $product->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600">آخر تحديث</label>
                                <p class="mt-1 text-gray-900">{{ $product->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الوصف ورسالة الواتساب -->
            <div class="mt-8 border-t border-gray-200 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- الوصف -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">وصف المنتج</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            @if($product->description_ar)
                                <p class="text-gray-700 leading-relaxed">{{ $product->description_ar }}</p>
                            @else
                                <p class="text-gray-500 italic">لا يوجد وصف للمنتج</p>
                            @endif
                        </div>
                    </div>

                    <!-- رسالة الواتساب -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">رسالة الواتساب</h4>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-gray-700 leading-relaxed">{{ $product->whatsapp_message }}</p>
                            <div class="mt-4">
                                <a href="https://wa.me/?text={{ urlencode($product->whatsapp_message) }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    <i class="fab fa-whatsapp ml-2"></i>
                                    مشاركة عبر واتساب
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار الإجراءات -->
            <div class="mt-8 flex justify-end space-x-3 border-t border-gray-200 pt-6">
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 flex items-center"
                            onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                        <i class="fas fa-trash ml-2"></i>
                        حذف المنتج
                    </button>
                </form>
                
                <a href="{{ route('admin.products.edit', $product) }}" 
                   class="px-6 py-3 bg-[#1a5d7a]  hover:from-[#0d3245] hover:to-[#1a5d7a] transition-all duration-300 shadow-md flex items-center">
                    <i class="fas fa-edit ml-2"></i>
                    تعديل المنتج
                </a>
            </div>
        </div>
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
</style>
@endsection