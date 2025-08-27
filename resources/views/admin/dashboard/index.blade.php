@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- العنوان -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">مرحباً {{ auth('admin')->user()->full_name }}!</h1>
        <p class="text-gray-600 dark:text-gray-300">هذه نظرة عامة على أداء متجرك</p>
    </div>

    <!-- الإحصائيات السريعة -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- إجمالي المنتجات -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">إجمالي المنتجات</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['total_products'] }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-blue-500 flex items-center">
                <span>↑ 12.5% من الشهر الماضي</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <!-- المنتجات النشطة -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">المنتجات النشطة</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['active_products'] }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-green-500 flex items-center">
                <span>↑ 5.2% من الشهر الماضي</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <!-- طلبات غير مقروءة -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="bg-yellow-100 dark:bg-yellow-900/30 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">طلبات غير مقروءة</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['unread_contacts'] }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-yellow-500 flex items-center">
                <span>جديد اليوم</span>
            </div>
        </div>

        <!-- إجمالي المشرفين -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">إجمالي المشرفين</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['total_admins'] }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-purple-500 flex items-center">
                <span>مستخدم نشط الآن</span>
            </div>
        </div>
    </div>

    <!-- المنتجات الأخيرة والطلبات -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- المنتجات الأخيرة -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">المنتجات الأخيرة</h2>
                <a href="{{ route('admin.products.index') }}" class="text-primary-600 hover:text-primary-800 text-sm dark:text-primary-400">عرض الكل</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الصورة</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الاسم</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">السعر</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الحالة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($latestProducts as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded object-cover" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name_ar }}">
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name_ar }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $product->category_name }}</div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900 dark:text-white">{{ $product->price }} ر.س</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $product->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200' }}">
                                    {{ $product->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 text-center">
                <a href="{{ route('admin.products.create') }}" class="text-primary-600 hover:text-primary-800 font-medium dark:text-primary-400">
                    + إضافة منتج جديد
                </a>
            </div>
        </div>

        <!-- الطلبات الأخيرة -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">طلبات التواصل الأخيرة</h2>
                <a href="{{ route('admin.contact-requests.index') }}" class="text-primary-600 hover:text-primary-800 text-sm dark:text-primary-400">عرض الكل</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الاسم</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الهاتف</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الخدمة</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">الحالة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($latestContacts as $contact)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ !$contact->is_read ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                            <td class="px-5 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->full_name }}</div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <a href="tel:{{ $contact->phone }}" class="text-primary-600 hover:text-primary-800 dark:text-primary-400">
                                    {{ $contact->phone }}
                                </a>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                    {{ $contact->service_type }}
                                </span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $contact->is_read ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200' }}">
                                    {{ $contact->is_read ? 'مقروء' : 'غير مقروء' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 text-center">
                <a href="#" class="text-primary-600 hover:text-primary-800 font-medium dark:text-primary-400">
                    عرض جميع الطلبات
                </a>
            </div>
        </div>
    </div>

    <!-- تقويم ونشاطات -->
    
    </div>
</div>
@endsection