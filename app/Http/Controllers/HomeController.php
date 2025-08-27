<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية مع المنتجات النشطة
     */
    public function index()
    {
        // جلب المنتجات النشطة
        $products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('frontend.home', compact('products'));
    }

    /**
     * عرض تفاصيل المنتج
     */
    public function showProduct($id)
    {
        // جلب المنتج مع التأكد من أنه نشط
        $product = Product::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();
            
        return view('frontend.product', compact('product'));
    }

    /**
     * حفظ طلب اتصال جديد
     */
    public function storeContactRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string|max=100',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ContactRequest::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'service_type' => $request->service_type,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->back()
            ->with('success', 'تم إرسال طلبك بنجاح. سنقوم بالتواصل معك في أقرب وقت.');
    }
}