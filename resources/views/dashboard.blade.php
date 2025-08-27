@extends('layouts.app')

@section('title', 'لوحة التحكم -مضلات وسواتر الرياض')

@section('content')
    <!-- شريط العنوان -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مرحباً بك في لوحة التحكم</h1>
        <p class="text-gray-600 mt-2">نظرة عامة على أداء الموقع وآخر الإحصائيات</p>
    </div>

    <!-- البطاقات الإحصائية -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- بطاقة المستخدمين -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">المستخدمين النشطين</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">1,245</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-500 font-medium mr-1">+12.5%</span>
                    <span class="text-gray-500">مقارنة بالشهر الماضي</span>
                </div>
            </div>
        </div>

        <!-- بطاقة المحتوى -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                        <i class="fas fa-file-alt text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">إجمالي المحتوى</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">8,432</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-500 font-medium mr-1">+8.2%</span>
                    <span class="text-gray-500">مقارنة بالأسبوع الماضي</span>
                </div>
            </div>
        </div>

        <!-- بطاقة الزيارات -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">إجمالي الزيارات</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">24,567</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-500 font-medium mr-1">+15.7%</span>
                    <span class="text-gray-500">مقارنة بالأمس</span>
                </div>
            </div>
        </div>

        <!-- بطاقة المبيعات -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="fas fa-money-bill-wave text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">إجمالي المبيعات</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">34,567 ر.س</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-red-500 font-medium mr-1">-2.3%</span>
                    <span class="text-gray-500">مقارنة بالأمس</span>
                </div>
            </div>
        </div>
    </div>

    <!-- الرسوم البيانية والنشاطات -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- الرسم البياني الرئيسي -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">تحليل الزيارات</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-gray-100 rounded-md text-sm font-medium hover:bg-gray-200">يوم</button>
                    <button class="px-3 py-1 bg-gray-100 rounded-md text-sm font-medium hover:bg-gray-200">أسبوع</button>
                    <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md text-sm font-medium">شهر</button>
                </div>
            </div>
            <div class="p-5">
                <div class="h-64">
                    <canvas id="visitorsChart"></canvas>
                </div>
                <div class="mt-4 flex flex-wrap justify-center gap-4">
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                        <span class="text-gray-600 text-sm">الزيارات</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                        <span class="text-gray-600 text-sm">الزوار الجدد</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-purple-500 mr-2"></span>
                        <span class="text-gray-600 text-sm">المبيعات</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- أحدث النشاطات -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800">أحدث النشاطات</h2>
            </div>
            <div class="divide-y divide-gray-100">
                <!-- نشاط 1 -->
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center ml-3">
                            <i class="fas fa-user-plus text-blue-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تم تسجيل مستخدم جديد</p>
                            <p class="text-sm text-gray-500">أحمد محمد - اليوم في 10:30 صباحاً</p>
                        </div>
                    </div>
                </div>
                
                <!-- نشاط 2 -->
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center ml-3">
                            <i class="fas fa-file-alt text-green-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تم نشر مقال جديد</p>
                            <p class="text-sm text-gray-500">"نصائح لتحسين محركات البحث" - أمس في 3:45 مساءً</p>
                        </div>
                    </div>
                </div>
                
                <!-- نشاط 3 -->
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center ml-3">
                            <i class="fas fa-shopping-cart text-purple-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">طلب شراء جديد</p>
                            <p class="text-sm text-gray-500">طلب #1245 - أمس في 1:20 مساءً</p>
                        </div>
                    </div>
                </div>
                
                <!-- نشاط 4 -->
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center ml-3">
                            <i class="fas fa-comment text-yellow-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تعليق جديد</p>
                            <p class="text-sm text-gray-500">"شكراً على المحتوى المفيد" - أمس في 11:15 صباحاً</p>
                        </div>
                    </div>
                </div>
                
                <!-- نشاط 5 -->
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center ml-3">
                            <i class="fas fa-exclamation-circle text-red-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تنبيه أمان</p>
                            <p class="text-sm text-gray-500">محاولة تسجيل دخول غير مصرح بها - اليوم في 9:20 صباحاً</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 text-center">
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">عرض جميع النشاطات</a>
            </div>
        </div>
    </div>

    <!-- الجداول والتحليلات -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- جدول أحدث المستخدمين -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">أحدث المستخدمين</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">عرض الكل</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">الاسم</th>
                            <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">البريد الإلكتروني</th>
                            <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                            <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">الانضمام</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">أ</span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="font-medium text-gray-800">أحمد محمد</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">ahmed@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    نشط
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">اليوم</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">م</span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="font-medium text-gray-800">محمد خالد</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">mohamed@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    نشط
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">أمس</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">س</span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="font-medium text-gray-800">سارة عبدالله</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">sara@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    معلق
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">أمس</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">ف</span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="font-medium text-gray-800">فاطمة علي</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">fatima@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    محظور
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">منذ 3 أيام</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">ع</span>
                                        </div>
                                    </div>
                                    <div class="mr-4">
                                        <div class="font-medium text-gray-800">عبدالله سالم</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">abdullah@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    نشط
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">منذ 4 أيام</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- تحليل حركة المرور -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800">تحليل حركة المرور</h2>
            </div>
            <div class="p-5">
                <div class="h-64">
                    <canvas id="trafficChart"></canvas>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">مصدر الزيارات</h3>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">البحث العضوي</span>
                                <span class="text-sm text-gray-600">45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">المرجع المباشر</span>
                                <span class="text-sm text-gray-600">25%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 25%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">وسائل التواصل</span>
                                <span class="text-sm text-gray-600">15%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">الإعلانات المدفوعة</span>
                                <span class="text-sm text-gray-600">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 10%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">المصادر الأخرى</span>
                                <span class="text-sm text-gray-600">5%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-red-500 h-2.5 rounded-full" style="width: 5%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الأداء العام -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8">
        <div class="p-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800">الأداء العام للموقع</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-3xl font-bold text-gray-800 mb-2">89%</div>
                    <div class="text-gray-600">معدل الاحتفاظ بالمستخدم</div>
                    <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500" style="width: 89%"></div>
                    </div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-3xl font-bold text-gray-800 mb-2">4.7</div>
                    <div class="text-gray-600">متوسط تقييم المستخدم</div>
                    <div class="mt-2 flex justify-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-3xl font-bold text-gray-800 mb-2">12.5</div>
                    <div class="text-gray-600">معدل الارتداد (%)</div>
                    <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500" style="width: 87.5%"></div>
                    </div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-3xl font-bold text-gray-800 mb-2">2.4</div>
                    <div class="text-gray-600">متوسط الوقت على الموقع (د)</div>
                    <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-500" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الأجهزة والمنصات -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- تحليل الأجهزة -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800">تحليل الأجهزة</h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="h-64">
                        <canvas id="deviceChart"></canvas>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-blue-500 ml-3"></div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">الهواتف الذكية</span>
                                    <span class="font-medium">45%</span>
                                </div>
                                <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-green-500 ml-3"></div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">الأجهزة اللوحية</span>
                                    <span class="font-medium">25%</span>
                                </div>
                                <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-purple-500 ml-3"></div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">أجهزة الكمبيوتر</span>
                                    <span class="font-medium">20%</span>
                                </div>
                                <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full" style="width: 20%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-yellow-500 ml-3"></div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">أخرى</span>
                                    <span class="font-medium">10%</span>
                                </div>
                                <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 10%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- المهام المطلوبة -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800">المهام المطلوبة</h2>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                        <div>
                            <p class="font-medium text-gray-800">مراجعة المقالات المعلقة</p>
                            <p class="text-sm text-gray-500 mt-1">5 مقالات بانتظار الموافقة</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">عاجل</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                        <div>
                            <p class="font-medium text-gray-800">رد على رسائل العملاء</p>
                            <p class="text-sm text-gray-500 mt-1">12 رسالة غير مقروءة</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">مهم</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                        <div>
                            <p class="font-medium text-gray-800">تحديث محتوى الصفحة الرئيسية</p>
                            <p class="text-sm text-gray-500 mt-1">يجب إكمالها قبل 30 يونيو</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">عادي</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                        <div>
                            <p class="font-medium text-gray-800">مراجعة طلبات الدفع</p>
                            <p class="text-sm text-gray-500 mt-1">3 طلبات بانتظار المراجعة</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">عاجل</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                        <div>
                            <p class="font-medium text-gray-800">تحديث سياسة الخصوصية</p>
                            <p class="text-sm text-gray-500 mt-1">يجب إكمالها قبل 15 يوليو</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">عادي</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 text-center">
                <button class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus ml-2"></i> إضافة مهمة جديدة
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // رسومات لوحة التحكم
            initDashboardCharts();
        });

        function initDashboardCharts() {
            // رسومات الزيارات
            const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
            const visitorsChart = new Chart(visitorsCtx, {
                type: 'line',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو'],
                    datasets: [
                        {
                            label: 'الزيارات',
                            data: [15000, 18000, 16000, 20000, 22000, 24000, 26000],
                            borderColor: '#1b6b8f',
                            backgroundColor: 'rgba(27, 107, 143, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'الزوار الجدد',
                            data: [8000, 9000, 7500, 10000, 11000, 12000, 13000],
                            borderColor: '#4CAF50',
                            backgroundColor: 'rgba(76, 175, 80, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'المبيعات',
                            data: [5000, 6000, 5500, 7000, 8000, 9000, 10000],
                            borderColor: '#9C27B0',
                            backgroundColor: 'rgba(156, 39, 176, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // رسومات حركة المرور
            const trafficCtx = document.getElementById('trafficChart').getContext('2d');
            const trafficChart = new Chart(trafficCtx, {
                type: 'doughnut',
                data: {
                    labels: ['البحث العضوي', 'المرجع المباشر', 'وسائل التواصل', 'الإعلانات المدفوعة', 'المصادر الأخرى'],
                    datasets: [{
                        data: [45, 25, 15, 10, 5],
                        backgroundColor: [
                            '#1b6b8f',
                            '#9C27B0',
                            '#4CAF50',
                            '#F2B705',
                            '#F44336'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // رسومات الأجهزة
            const deviceCtx = document.getElementById('deviceChart').getContext('2d');
            const deviceChart = new Chart(deviceCtx, {
                type: 'pie',
                data: {
                    labels: ['الهواتف الذكية', 'الأجهزة اللوحية', 'أجهزة الكمبيوتر', 'أخرى'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: [
                            '#1b6b8f',
                            '#4CAF50',
                            '#9C27B0',
                            '#F2B705'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }
    </script>
@endsection