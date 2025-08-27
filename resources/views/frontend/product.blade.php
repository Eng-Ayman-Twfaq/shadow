<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $product->name_ar }} |مضلات وسواتر الرياض</title>
    <meta name="description" content="تفاصيل {{ $product->name_ar }} - {{ Str::limit($product->description_ar, 150) }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{
            --brand:#1b6b8f; /* أزرق بترولي */
            --brand-2:#0f3a4d; /* أزرق غامق */
            --accent:#f2b705a2;  /* ذهبي */
            --accent-dark:#d9a404; /* ذهبي غامق */
            --bg:#f7f9fb; 
            --text:#1a1a1a;
            --muted:#6e7681;
            --card:#ffffff;
            --radius:14px;
            --shadow:0 10px 25px rgba(0,0,0,.08);
            --transition: all 0.3s ease;
        }
        *{box-sizing:border-box}
        html,body{margin:0;padding:0;font-family:'Cairo',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;color:var(--text);background:var(--bg);scroll-behavior:smooth}
        a{text-decoration:none;color:inherit}
        img{max-width:100%;display:block}
        h1, h2, h3, h4, h5, h6 {color: var(--brand-2);}
        
        /* Header */
        header{
            position:sticky;top:0;z-index:40;background:rgba(255,255,255,.95);backdrop-filter:saturate(150%) blur(10px);
            border-bottom:1px solid rgba(15,58,77,.06); transition: var(--transition);
            margin-bottom: 0;
            padding: 10px 20px;
        }
        .header-scrolled {
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .nav{
            max-width:1200px;margin:auto;display:flex;align-items:center;justify-content:space-between;padding:14px 20px;
        }
        .logo{display:flex;align-items:center;gap:10px;font-weight:800;color:var(--brand); height: 50px;}
        .logo i{width:34px;height:34px;border-radius:8px;background:linear-gradient(135deg,var(--brand),var(--brand-2));display:inline-flex;align-items:center;justify-content:center;}
        .logo i::before {content: "ظل"; color: white; font-weight: bold;}
        
        /* قائمة التنقل الأساسية */
        nav ul{display:flex;gap:12px;list-style:none;margin:0;padding:0;align-items:center;height: 50px;}
        nav a{position:relative;padding:8px 12px;border-radius:8px;display: flex;flex-direction: column;align-items: center;gap:4px;transition: var(--transition);}
        nav a:hover{background:#eef5f8; color: var(--brand);}
        nav a i {font-size: 18px;}
        nav a span {font-size: 12px;}
        
        .cta{padding:10px 16px;background:var(--accent);color:#1b1b1b;border-radius:10px;box-shadow:var(--shadow);display: flex;align-items: center;gap: 8px;font-weight: 700;transition: var(--transition);}
        .cta:hover{background:var(--accent-dark); transform: translateY(-2px);}
        
        /* قائمة الهاتف - هامبرجر */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--brand);
            backdrop-filter: blur(40px);
        }
        
        /* Hero */
        .hero{
            isolation:isolate;min-height:70vh;display:grid;place-items:center;text-align:center;
            color:#fff;padding:80px 16px 60px;overflow: hidden;position: relative;
            margin-top: 0;
            background: linear-gradient(to bottom, rgba(27, 107, 143, 0.1), rgba(15, 58, 77, 0.5)), 
                    url('{{ asset('images/m8.jpg') }}') no-repeat center center / cover;
            backdrop-filter: blur(40px); /* تأثير الزجاج */
        }
       
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1); /* طبقة شفافة */
            z-index: -1;
        }
        .hero-content {
            max-width: 900px;
            z-index: 1;
            color: #fff;
            padding: 20px;
        }
        .hero h1{font-size:clamp(28px,4vw,46px);margin:0 0 12px;color:rgba(255,255,255,0.9); line-height: 1.3;}
        .hero p{max-width:800px;margin:0 auto 22px;color:rgba(255,255,255,0.9); font-size: 18px;}
        
        /* Section shell */
        section{max-width:1200px;margin:70px auto;padding:0 16px}
        .section-title {text-align: center; margin-bottom: 50px;}
        .section-title h2 {font-size: 36px; position: relative; display: inline-block; margin-bottom: 15px;}
        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            right: 50%;
            transform: translateX(50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        .section-title p {max-width: 700px; margin: 0 auto; color: var(--muted); font-size: 18px;}
        
        .sec-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:10px;flex-wrap: wrap;}
        .sec-head h2{margin:0;color:var(--brand-2);font-size:clamp(22px,2.6vw,30px)}
        .muted{color:var(--muted);font-size:15px}
        
        /* Product details */
        .product-detail {
            margin: 50px 0;
        }
        
        .product-images {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .product-images img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.5s ease;
            border-radius: var(--radius);
        }
        
        .product-images:hover img {
            transform: scale(1.03);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: #1b1b1b;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            z-index: 1;
        }
        
        .product-info {
            background: var(--card);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }
        
        .product-title {
            font-size: 28px;
            margin-bottom: 15px;
            color: var(--brand-2);
        }
        
        .product-price {
            font-size: 24px;
            font-weight: 800;
            color: var(--brand-2);
            margin: 15px 0;
        }
        
        .price-label {
            font-size: 14px;
            color: var(--muted);
            margin-right: 5px;
        }
        
        .product-description {
            line-height: 1.7;
            color: var(--text);
            margin: 20px 0;
        }
        
        .product-features {
            margin: 25px 0;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .feature-icon {
            background: var(--bg);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            color: var(--brand);
        }
        
        .feature-text {
            flex: 1;
        }
        
        .feature-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--brand-2);
        }
        
        .product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }
        
        .product-tag {
            background: #eef5f8;
            color: #16506a;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }
        
        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #25D366;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 700;
            transition: var(--transition);
            text-decoration: none;
            gap: 10px;
        }
        
        .whatsapp-btn:hover {
            background: #128C7E;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            color: var(--brand);
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            gap: 8px;
            border: 1px solid #e5eaee;
        }
        
        .back-btn:hover {
            background: #eef5f8;
            transform: translateY(-2px);
        }
        
        .product-warranty {
            background: #f8fafc;
            border-left: 4px solid var(--accent);
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
        }
        
        .warranty-title {
            font-weight: 700;
            color: var(--brand-2);
            margin-bottom: 5px;
        }
        
        /* Product Tabs */
        .tabs {
            margin: 30px 0;
            border-bottom: 1px solid #e5eaee;
        }
        
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .tab-button {
            padding: 10px 20px;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .tab-button.active, .tab-button:hover {
            color: var(--brand);
            background: rgba(27, 107, 143, 0.05);
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .tab-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Related Products */
        .related-products {
            margin-top: 70px;
        }
        
        .related-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 28px;
            color: var(--brand-2);
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        /* Testimonials */
        .testimonials {
            background: var(--bg);
            padding: 60px 0;
            border-radius: var(--radius);
            margin: 70px auto;
        }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }
        .testimonial-card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            position: relative;
        }
        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 60px;
            color: var(--bg);
            font-family: serif;
            line-height: 1;
        }
        .testimonial-text {
            color: var(--text);
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }
        .author-details h4 {
            margin: 0;
            color: var(--brand-2);
        }
        .author-details p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }
        
        /* تأثيرات الانتقال */
        .animate-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        
        .animate-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* تأثيرات الصورة عند التحويم */
        .product-images {
            overflow: hidden;
            position: relative;
        }
        
        .product-images::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.05);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            border-radius: var(--radius);
        }
        
        .product-images:hover::after {
            opacity: 1;
        }
        
        /* مؤشر التقدم للمنتجات المشابهة */
        .related-products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .progress-container {
            flex: 1;
            height: 4px;
            background: #e5eaee;
            border-radius: 2px;
            margin: 0 15px;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            background: var(--brand);
            width: 0;
            border-radius: 2px;
            transition: width 0.5s ease;
        }
        
        /* تحسينات للاستجابة على الهواتف */
        @media (max-width: 768px) {
            .nav {
                flex-direction: row;
                gap: 15px;
                padding: 10px;
                align-items: center;
                justify-content: space-between;
            }
            
            /* إخفاء القائمة العادية وإظهار زر الهامبرجر */
            nav ul {
                display: none;
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                width: 100%;
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                height: auto;
                z-index: 100;
            }
            
            nav ul.active {
                display: flex;
            }
            
            .mobile-toggle {
                display: block;
            }
            
            /* تحسين شكل عناصر القائمة في الوضع المتنقل */
            nav a {
                width: 100%;
                flex-direction: row;
                justify-content: flex-start;
                padding: 12px 15px;
                border-radius: 8px;
            }
            
            nav a i {
                margin-left: 10px;
                font-size: 20px;
                width: 24px;
                text-align: center;
            }
            
            .logo {
                height: 40px;
                font-size: 16px;
            }
            
            .logo i {
                width: 30px;
                height: 30px;
            }
            
            .hero {
                min-height: 60vh;
                padding: 60px 16px 40px;
            }
            
            .product-detail {
                grid-template-columns: 1fr;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
            }
            
            footer {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            .footer-links {
                justify-content: center;
            }
            
            .tabs {
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .tab-buttons {
                display: inline-flex;
            }
            
            .tab-button {
                min-width: 120px;
            }
        }
        
        /* تحسينات للشاشات المتوسطة */
        @media (min-width: 769px) and (max-width: 1024px) {
            nav ul {
                gap: 10px;
            }
            
            nav a {
                padding: 8px;
                font-size: 14px;
            }
            
            nav a i {
                font-size: 16px;
            }
        }
        
        /* تأثيرات التحميل */
        .product-detail {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .product-detail.loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* نمط المنتجات المشابهة */
        .related-product {
            background: var(--card);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .related-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }
        
        .related-product-img {
            aspect-ratio: 4/3;
            overflow: hidden;
        }
        
        .related-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .related-product:hover .related-product-img img {
            transform: scale(1.08);
        }
        
        .related-product-body {
            padding: 20px;
        }
        
        .related-product-title {
            font-size: 18px;
            margin: 0 0 10px;
            color: var(--brand-2);
            font-weight: 600;
        }
        
        .related-product-price {
            color: var(--brand-2);
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .related-product-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .related-product-btn {
            flex: 1;
            padding: 8px 10px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            transition: var(--transition);
            font-weight: 600;
        }
        
        .related-product-btn.view {
            background: #f8fafc;
            color: var(--brand);
            border: 1px solid #e5eaee;
        }
        
        .related-product-btn.view:hover {
            background: #eef5f8;
            color: var(--brand);
        }
        
        .related-product-btn.whatsapp {
            background: #25D366;
            color: white;
        }
        
        .related-product-btn.whatsapp:hover {
            background: #128C7E;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="nav">
            <div class="logo"><i></i> <span>الجنوب | سواتر ومظلات</span></div>
            
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> <span>الرئيسية</span></a></li>
                    <li><a href="{{ route('home') }}#products"><i class="fas fa-th-large"></i> <span>المنتجات</span></a></li>
                    <li><a href="{{ route('home') }}#services"><i class="fas fa-cogs"></i> <span>الخدمات</span></a></li>
                    <li><a href="{{ route('home') }}#gallery"><i class="fas fa-images"></i> <span>أعمالنا</span></a></li>
                    <li><a href="{{ route('home') }}#testimonials"><i class="fas fa-star"></i> <span>آراء العملاء</span></a></li>
                    <li><a href="{{ route('home') }}#contact"><i class="fas fa-phone"></i> <span>تواصل</span></a></li>
                </ul>
                <button class="mobile-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- صورة المنتج في الأعلى -->
    <div class="product-images-container">
        <div class="product-images">
            @if($product->badge_text)
                <div class="product-badge">{{ $product->badge_text }}</div>
            @endif
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name_ar }}" id="mainProductImage">
        </div>
    </div>

    <!-- تفاصيل المنتج -->
    <section class="product-detail" id="productDetail">
        <div class="product-info">
            <h1 class="product-title">{{ $product->name_ar }}</h1>
            
            <div class="product-price">
                {{ $product->price }}
                @if($product->price_label)
                    <span class="price-label">({{ $product->price_label }})</span>
                @endif
            </div>
            
            @if($product->warranty)
                <div class="product-warranty">
                    <div class="warranty-title">الضمان:</div>
                    <div>{{ $product->warranty }}</div>
                </div>
            @endif
            
            <!-- علامات التبويب -->
            <div class="tabs">
                <div class="tab-buttons">
                    <button class="tab-button active" data-tab="description">الوصف</button>
                    <button class="tab-button" data-tab="features">المواصفات</button>
                    <button class="tab-button" data-tab="reviews">التقييمات</button>
                </div>
                
                <div class="tab-content active" id="description">
                    <div class="product-description">
                        {!! nl2br(e($product->description_ar)) !!}
                    </div>
                </div>
                
                <div class="tab-content" id="features">
                    <div class="product-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="feature-text">
                                <div class="feature-title">التصنيف</div>
                                <div>
                                    @php
                                        $categoryNames = [
                                            'curtain' => 'ستائر',
                                            'canopy' => 'مظلات',
                                            'hanger' => 'هانجر',
                                            'other' => 'أخرى'
                                        ];
                                    @endphp
                                    {{ $categoryNames[$product->category] ?? $product->category }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-cube"></i>
                            </div>
                            <div class="feature-text">
                                <div class="feature-title">نوع المنتج</div>
                                <div>{{ $product->type }}</div>
                            </div>
                        </div>
                        
                        @if($product->is_active)
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="feature-text">
                                <div class="feature-title">الحالة</div>
                                <div>متاح للطلب</div>
                            </div>
                        </div>
                        @else
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="feature-text">
                                <div class="feature-title">الحالة</div>
                                <div>غير متاح مؤقتًا</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="tab-content" id="reviews">
                    <div class="product-reviews">
                        <p>لا توجد تقييمات بعد. كن أول من يقيم هذا المنتج.</p>
                        <!-- يمكن إضافة نظام تقييم لاحقًا -->
                    </div>
                </div>
            </div>
            
            @if($product->tags)
                <div class="product-tags">
                    @foreach(explode(',', $product->tags) as $tag)
                        @if(trim($tag))
                            <span class="product-tag">{{ trim($tag) }}</span>
                        @endif
                    @endforeach
                </div>
            @endif
            
            <div class="product-actions">
                <a href="https://wa.me/966537522808?text={{ urlencode($product->whatsapp_message) }}" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    طلب عبر الواتساب
                </a>
                
                <a href="{{ route('home') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    العودة إلى جميع المنتجات
                </a>
            </div>
        </div>
    </section>

    <!-- المنتجات المشابهة -->
    <section class="related-products">
        <div class="related-products-header">
            <h2 class="related-title">منتجات ذات صلة</h2>
            <div class="progress-container">
                <div class="progress-bar" id="relatedProductsProgress"></div>
            </div>
        </div>
        
        <div class="related-grid" id="relatedProductsGrid">
            @foreach(App\Models\Product::where('category', $product->category)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->limit(6)
                ->get() as $relatedProduct)
                
                <div class="related-product animate-in">
                    <div class="related-product-img">
                        <img src="{{ asset('storage/' . $relatedProduct->image_url) }}" alt="{{ $relatedProduct->name_ar }}">
                    </div>
                    <div class="related-product-body">
                        <h3 class="related-product-title">{{ $relatedProduct->name_ar }}</h3>
                        <div class="related-product-price">{{ $relatedProduct->price }}</div>
                        
                        @if($relatedProduct->badge_text)
                            <div class="related-product-badge" style="background: var(--accent); color: #1b1b1b; padding: 3px 10px; border-radius: 15px; display: inline-block; margin-bottom: 10px; font-size: 12px;">
                                {{ $relatedProduct->badge_text }}
                            </div>
                        @endif
                        
                        <div class="related-product-actions">
                            <a href="{{ route('product.show', $relatedProduct->id) }}" class="related-product-btn view">
                                <i class="fas fa-eye"></i> التفاصيل
                            </a>
                            <a href="https://wa.me/966537522808?text={{ urlencode($relatedProduct->whatsapp_message) }}" 
                               class="related-product-btn whatsapp" target="_blank">
                                <i class="fab fa-whatsapp"></i> واتساب
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Testimonials -->
    

    <!-- Footer -->
     <footer>
        <div>© {{ date('Y') }}  سواتر ومظلاتمضلات وسواتر الرياض. جميع الحقوق محفوظة.</div>
        <a href="tel:+966537522808">
            <div>للتواصل: 0537522808</div>
        </a>
        <div class="footer-links">
            <a href="{{ route('home') }}#products">المنتجات</a>
            <a href="{{ route('home') }}#services">الخدمات</a>
            <a href="{{ route('home') }}#gallery">أعمالنا</a>
            <a href="{{ route('home') }}#contact">تواصل</a>
        </div>
    </footer>

    <script>
        // تحميل تفاصيل المنتج مع تأثير
        document.addEventListener('DOMContentLoaded', function() {
            // تفعيل تأثير التحميل
            setTimeout(() => {
                const productDetail = document.getElementById('productDetail');
                productDetail.classList.add('loaded');
                
                // تفعيل تأثيرات الظهور عند التمرير
                const animateElements = document.querySelectorAll('.animate-in');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, {
                    threshold: 0.1
                });
                
                animateElements.forEach(element => {
                    observer.observe(element);
                });
            }, 300);
            
            // علامات التبويب
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // إزالة النشاط من جميع الأزرار
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                    
                    // تفعيل الزر والمساحة المحتوية
                    button.classList.add('active');
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // مؤشر التقدم للمنتجات المشابهة
            const relatedProductsGrid = document.getElementById('relatedProductsGrid');
            const relatedProductsProgress = document.getElementById('relatedProductsProgress');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // محاكاة تقدم التحميل
                        let progress = 0;
                        const interval = setInterval(() => {
                            progress += 2;
                            if (progress <= 100) {
                                relatedProductsProgress.style.width = `${progress}%`;
                            } else {
                                clearInterval(interval);
                            }
                        }, 50);
                    }
                });
            }, {
                threshold: 0.2
            });
            
            observer.observe(relatedProductsGrid);
            
            // Header scroll effect
            const header = document.getElementById('header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            // Mobile menu toggle
            const mobileToggle = document.querySelector('.mobile-toggle');
            const navMenu = document.querySelector('nav ul');
            
            mobileToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('nav') && !e.target.closest('.mobile-toggle')) {
                    navMenu.classList.remove('active');
                }
            });
            
            // تكبير الصورة عند التحويم
            const mainProductImage = document.getElementById('mainProductImage');
            let isZooming = false;
            let zoomLevel = 1;
            
            mainProductImage.addEventListener('mouseenter', function() {
                isZooming = true;
                zoomLevel = 1.1;
                this.style.transform = `scale(${zoomLevel})`;
            });
            
            mainProductImage.addEventListener('mouseleave', function() {
                isZooming = false;
                this.style.transform = 'scale(1)';
            });
            
            mainProductImage.addEventListener('mousemove', function(e) {
                if (!isZooming) return;
                
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const xPos = x / rect.width * 100;
                const yPos = y / rect.height * 100;
                
                this.style.transformOrigin = `${xPos}% ${yPos}%`;
            });
        });
    </script>
</body>
</html>