<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * عرض قائمة المنتجات مع إمكانية التصفية
     */
  public function index(Request $request)
{
    // بناء الاستعلام مع إمكانية التصفية
    $query = Product::query();
    
    // التصفية حسب الفئة
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }
    
    // التصفية حسب النوع
    if ($request->has('type') && $request->type != '') {
        $query->where('type', 'like', '%' . $request->type . '%');
    }
    
    // التصفية حسب الحالة
    if ($request->has('is_active') && $request->is_active != '') {
        $query->where('is_active', $request->is_active);
    }
    
    // التصفية حسب الوسم
    if ($request->has('tags') && $request->tags != '') {
        $query->where('tags', 'like', '%' . $request->tags . '%');
    }
    
    $products = $query->latest()->paginate(10);
    
    // إحصائيات للمنتجات
    $totalProducts = Product::count();
    $activeProducts = Product::where('is_active', 1)->count();
    $curtainsCount = Product::where('category', 'curtain')->count();
    $canopiesCount = Product::where('category', 'canopy')->count();
    $hangersCount = Product::where('category', 'hanger')->count();
    
    $categories = ['curtain', 'canopy', 'hanger', 'other'];
    
    return view('admin.products.index', compact(
        'products', 
        'categories', 
        'totalProducts', 
        'activeProducts', 
        'curtainsCount', 
        'canopiesCount',
        'hangersCount'
    ));
}

    /**
     * عرض نموذج إنشاء منتج جديد
     */
    public function create()
    {
        $categories = ['curtain' => 'ستائر', 'canopy' => 'مظلات', 'hanger' => 'هانجر', 'other' => 'أخرى'];
        return view('admin.products.create', compact('categories'));
    }

    /**
     * حفظ المنتج الجديد في قاعدة البيانات
     */
 public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'category' => 'required|in:curtain,canopy,hanger,other',
            'type' => 'required|string|max:100',
            'price' => 'required|string|max:100',
            'price_label' => 'nullable|string|max:100',
            'warranty' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'badge_text' => 'required|string|max:100',
            'whatsapp_message' => 'required|string',
            'is_active' => 'sometimes|boolean',
        ]);

        // رفع الصورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($validated);

        // التغيير هنا: استخدام redirect بدلًا من response()->json
        return redirect()->route('admin.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withInput()->withErrors($e->errors());
    } catch (\Exception $e) {
        return back()->withInput()->withErrors([
            'error' => 'حدث خطأ أثناء حفظ المنتج: ' . $e->getMessage()
        ]);
    }
}
    /**
     * عرض تفاصيل منتج معين
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * عرض نموذج تعديل المنتج
     */
    public function edit(Product $product)
    {
        $categories = ['curtain' => 'ستائر', 'canopy' => 'مظلات', 'hanger' => 'هانجر', 'other' => 'أخرى'];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * تحديث المنتج في قاعدة البيانات
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'category' => 'required|in:curtain,canopy,hanger,other',
            'type' => 'required|string|max:100',
            'price' => 'required|string|max:100',
            'price_label' => 'nullable|string|max:100',
            'warranty' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'badge_text' => 'required|string|max:100',
            'whatsapp_message' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // تحديث الصورة إذا تم رفع جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح.');
    }

    /**
     * حذف منتج من قاعدة البيانات
     */
    public function destroy(Product $product)
    {
        // حذف الصورة المرتبطة
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح.');
    }
}