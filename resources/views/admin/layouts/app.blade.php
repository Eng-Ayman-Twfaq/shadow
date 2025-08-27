<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'ظل الجنوب | لوحة التحكم')</title>
    
    <!-- Tailwind CSS مع دعم RTL -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #1a5d7a;
            --primary-dark: #0d3245;
            --accent: #e69500;
            --sidebar-width: 280px;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-tertiary: #94a3b8;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .sidebar {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
        }
        
        .sidebar-hidden {
            transform: translateX(100%);
        }
        
        .sidebar-visible {
            transform: translateX(0);
        }
        
        .main-content {
            transition: margin-right 0.3s ease-in-out;
        }
        
        .sidebar-link {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(-2px);
        }
        
        .sidebar-link.active {
            background: linear-gradient(to right, rgba(230, 149, 0, 0.2), transparent);
            border-right: 3px solid var(--accent);
        }
        
        .sidebar-link.active span {
            color: white;
            font-weight: 600;
        }
        
        .notification-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(230, 149, 0, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(230, 149, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(230, 149, 0, 0); }
        }
        
        .theme-toggle {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
        }
        
        .user-avatar {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }
        
        .stats-card {
            background: linear-gradient(to bottom right, #ffffff, #f8fafc);
        }
        
        .stats-card:hover {
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        }
        
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0) !important;
            }
            
            .main-content {
                margin-right: var(--sidebar-width) !important;
            }
        }
        
        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 1.5rem 0;
        }
        
        /* Loader محسن */
        .loader {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .loader div {
            position: absolute;
            border: 4px solid var(--primary);
            opacity: 1;
            border-radius: 50%;
            animation: loader 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        
        .loader div:nth-child(2) {
            animation-delay: -0.5s;
        }
        
        @keyframes loader {
            0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
            }
            100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
            }
        }
        
        /* تحسينات للشريط العلوي */
        .nav-search {
            transition: all 0.3s ease;
        }
        
        .nav-search:focus {
            width: 300px;
        }
        
        /* تأثيرات للكروت */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* تحسينات للأزرار */
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(26, 93, 122, 0.2);
        }
        
        /* تحسينات للجداول */
        .table-hover tbody tr {
            transition: background-color 0.2s ease;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <!-- رسالة النجاح التي تختفي تلقائيًا -->
@if(session('success'))
    <div id="successMessage" class="fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full opacity-0">
        {{ session('success') }}
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('successMessage');
            
            // إظهار الرسالة
            setTimeout(() => {
                successMessage.classList.remove('translate-x-full', 'opacity-0');
                successMessage.classList.add('translate-x-0', 'opacity-100');
            }, 100);
            
            // إخفاء الرسالة بعد 5 ثواني
            setTimeout(() => {
                successMessage.classList.remove('translate-x-0', 'opacity-100');
                successMessage.classList.add('translate-x-full', 'opacity-0');
                
                // إزالة الرسالة من DOM بعد انتهاء التحريك
                setTimeout(() => {
                    if (successMessage.parentNode) {
                        successMessage.parentNode.removeChild(successMessage);
                    }
                }, 300);
            }, 5000);
        });
    </script>
@endif

<!-- رسالة الخطأ التي تختفي تلقائيًا -->
@if(session('error'))
    <div id="errorMessage" class="fixed top-6 right-6 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full opacity-0">
        {{ session('error') }}
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.getElementById('errorMessage');
            
            // إظهار الرسالة
            setTimeout(() => {
                errorMessage.classList.remove('translate-x-full', 'opacity-0');
                errorMessage.classList.add('translate-x-0', 'opacity-100');
            }, 100);
            
            // إخفاء الرسالة بعد 7 ثواني
            setTimeout(() => {
                errorMessage.classList.remove('translate-x-0', 'opacity-100');
                errorMessage.classList.add('translate-x-full', 'opacity-0');
                
                // إزالة الرسالة من DOM بعد انتهاء التحريك
                setTimeout(() => {
                    if (errorMessage.parentNode) {
                        errorMessage.parentNode.removeChild(errorMessage);
                    }
                }, 300);
            }, 7000);
        });
    </script>
@endif
    <!-- Loader -->
    <div id="loader" class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 hidden">
        <div class="text-center">
            <div class="loader mx-auto">
                <div></div>
                <div></div>
            </div>
            <p class="mt-4 text-gray-600 font-medium">جاري التحميل...</p>
        </div>
    </div>

    <!-- شريط التنقل العلوي -->
    <nav class="fixed top-0 right-0 left-0 z-40  shadow-lg" style="background-color: var(--primary);">
        <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- زر القائمة للشاشات الصغيرة -->
            <button id="menuToggle" class="md:hidden text-white p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#0d3245] focus:ring-white rounded-lg">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- شعار الموقع -->
            <div class="flex items-center">
    <div class="w-10 h-10 rounded-xl bg-white bg-opacity-10 flex items-center justify-center mr-3 shadow-md overflow-hidden">
        <img src="{{ asset('images/logo.png') }}" alt="شعار الموقع" class="w-8 h-8 object-contain">
    </div>
    <h1 class="text-white text-lg font-bold hidden sm:block"> مضلات وسواتر الرياض | لوحة التحكم</h1>
</div>

            
            <!-- أيقونات الإعدادات -->
            <div class="flex items-center space-x-3">
                <!-- زر الأدمن -->
                <div class="relative hidden md:block">
                    <a href="{{ route('admin.admin-users.index') }}" class="text-white p-2 hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-user-shield ml-2"></i>
                        <span class="text-sm">الإدارة</span>
                    </a>
                </div>
                
                <!-- البحث -->
                <div class="relative hidden md:block">
                    <div class="flex items-center">
                        <input type="text" placeholder="بحث..." class="nav-search bg-white bg-opacity-10 text-white placeholder-white placeholder-opacity-90 rounded-full py-1.5 px-5 pl-12 focus:outline-none focus:bg-opacity-20 focus:ring-2 focus:ring-white focus:ring-opacity-30 transition-all duration-300 w-48">
                        <i class="fas fa-search absolute right-4 top-2.5 text-white text-opacity-80"></i>
                    </div>
                </div>
                
                <!-- الإشعارات -->
                <div class="relative">
                    <button class="text-white p-2 relative hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors duration-200">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-5 h-5 rounded-full bg-[#e69500] text-white text-xs flex items-center justify-center font-bold notification-badge"></span>
                    </button>
                </div>
                
                <!-- صورة المستخدم -->
                <div class="relative">
                    <button id="userMenuToggle" class="flex items-center text-white focus:outline-none rounded-full">
                        <div class="w-9 h-9 rounded-full bg-gray-300 bg-opacity-20 flex items-center justify-center mr-2.5 overflow-hidden border-2 border-white border-opacity-30">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="hidden md:block text-sm font-semibold">{{ Auth::user()->name ?? 'المستخدم' }}</span>
                        <i class="fas fa-chevron-down mr-2 text-sm hidden md:block"></i>
                    </button>
                    
                    <div id="userDropdown" class="hidden absolute left-0 mt-2 w-52 bg-white rounded-xl shadow-2xl py-2 z-50 border border-gray-100">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'المستخدم' }}</p>
                            <p class="text-xs text-gray-500">مدير النظام</p>
                        </div>
                        <a href="#" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-[#1a5d7a] transition-colors duration-200">
                            <i class="fas fa-user-circle ml-3 text-[#1a5d7a]"></i>
                            <span class="font-medium">الملف الشخصي</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-[#1a5d7a] transition-colors duration-200">
                            <i class="fas fa-cog ml-3 text-[#1a5d7a]"></i>
                            <span class="font-medium">الإعدادات</span>
                        </a>
                        <div class="my-1 border-t border-gray-100"></div>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="flex items-center px-4 py-2.5 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200">
                           <i class="fas fa-sign-out-alt ml-3 text-red-600"></i>
                           <span class="font-medium">تسجيل الخروج</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- القائمة الجانبية -->
    <aside id="sidebar" class="sidebar sidebar-hidden fixed top-16 right-0 h-full w-72 z-40 overflow-y-auto">
        <div class="p-5">
            <h2 class="text-xl font-bold mb-7 text-[#e69500] flex items-center">
                <i class="fas fa-th-large ml-2.5"></i> 
                <span class="tracking-wider">القوائم الرئيسية</span>
            </h2>
            
            <ul class="space-y-1.5">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center p-3.5 rounded-xl">
                        <i class="fas fa-home text-xl ml-3.5"></i>
                        <span class="text-base">لوحة التحكم</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center p-3.5 rounded-xl">
                        <i class="fas fa-box text-xl ml-3.5"></i>
                        <span class="text-base">المنتجات</span>
                        <span class="bg-[#e69500] text-white text-xs px-2.5 py-1 rounded-full mr-auto font-medium"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-requests.index') }}" class="sidebar-link flex items-center p-3.5 rounded-xl">
                        <i class="fas fa-users text-xl ml-3.5"></i>
                        <span class="text-base">طلبات العملاء </span>
                    </a>
                </li>
              
            </ul>
            
            <div class="sidebar-divider"></div>
            
            <h3 class="text-sm font-semibold text-[#cbd5e1] uppercase mb-3.5 px-1 tracking-wider">الإدارة</h3>
            <ul class="space-y-1.5">
                <li>
                    <a href="{{ route('admin.admin-users.index') }}" class="sidebar-link flex items-center p-3.5 rounded-xl">
                        <i class="fas fa-user-shield text-xl ml-3.5"></i>
                        <span class="text-base">المشرفين</span>
                    </a>
                </li>
               
            </ul>
            
           
        </div>
    </aside>

    <!-- المحتوى الرئيسي -->
    <main id="mainContent" class="main-content pt-16 min-h-screen pb-20">
        <div class="container mx-auto px-4 py-6">
            @yield('content')
        </div>
    </main>

    <!-- الفوتر -->
    <footer class=" text-white border-t border-gray-700 mt-auto" style="background-color: var(--primary);">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-center items-center text-center">
               
            <p class="text-sm">
                © 2025مضلات وسواتر الرياض. جميع الحقوق محفوظة لـ 
                <a href="https://ayman-3w51.onrender.com/" class="text-[var(--accent)] hover:underline">ايمن توفيق للبرمجيات</a> 
                و 
                <a href="https://al-hnani.vercel.app/" class="text-[var(--accent)] hover:underline">محمد الحناني للبرمجيات</a>
            </p>
        
                
                <div class="flex space-x-6">
                    <a href="#" class="text-white hover:text-[#e69500] transition-colors duration-200">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-[#e69500] transition-colors duration-200">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-[#e69500] transition-colors duration-200">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-[#e69500] transition-colors duration-200">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                </div>
                
                <div class="mt-4 md:mt-0 text-white text-sm">
                    <span class="font-medium">الإصدار: 2.1.4</span>
                    <span class="mx-2">|</span>
                    <a href="#" class="hover:text-[#e69500] transition-colors duration-200">الدعم الفني</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- نموذج تسجيل الخروج -->
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التحكم في القائمة الجانبية
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-visible');
                sidebar.classList.toggle('sidebar-hidden');
                
                if (sidebar.classList.contains('sidebar-visible')) {
                    mainContent.style.marginRight = '280px';
                } else {
                    mainContent.style.marginRight = '0';
                }
            });
            
            // التحكم في قائمة المستخدم
            const userMenuToggle = document.getElementById('userMenuToggle');
            const userDropdown = document.getElementById('userDropdown');
            
            userMenuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            
            // إغلاق القوائم عند النقر خارجها
            document.addEventListener('click', function(e) {
                if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
            
            // تحديد العنصر النشط في القائمة الجانبية
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            
            sidebarLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // إغلاق القائمة الجانبية عند الضغط على رابط في الشاشات الصغيرة
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        sidebar.classList.remove('sidebar-visible');
                        sidebar.classList.add('sidebar-hidden');
                        mainContent.style.marginRight = '0';
                    }
                    
                    // عرض Loader عند النقر على رابط
                    document.getElementById('loader').classList.remove('hidden');
                });
            });
            
            // تحديث حجم المحتوى عند تغيير حجم النافذة
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    mainContent.style.marginRight = '280px';
                } else {
                    mainContent.style.marginRight = '0';
                }
            });
            
            // إخفاء Loader عند اكتمال تحميل الصفحة
            window.addEventListener('load', function() {
                document.getElementById('loader').classList.add('hidden');
            });
            
            // إخفاء Loader يدوياً بعد 3 ثواني (للاحتياط)
            setTimeout(function() {
                document.getElementById('loader').classList.add('hidden');
            }, 3000);
        });
    </script>
</body>
</html>