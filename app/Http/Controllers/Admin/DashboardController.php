<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\Product;
use App\Models\AdminUser;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'unread_contacts' => ContactRequest::where('is_read', false)->count(),
            'total_admins' => AdminUser::count()
        ];

        $latestProducts = Product::latest()->take(5)->get();
        $unreadCount =10;
        // التعديل هنا: استخدام submitted_at بدلاً من created_at
        $latestContacts = ContactRequest::orderBy('submitted_at', 'desc')->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'latestProducts', 'latestContacts', 'unreadCount'));
    }
}