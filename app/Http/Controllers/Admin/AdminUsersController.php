<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    /**
     * عرض قائمة المستخدمين مع إمكانية التصفية
     */
    public function index(Request $request)
    {
        // بناء الاستعلام مع إمكانية التصفية
        $query = AdminUser::query();
        
        // التصفية حسب اسم المستخدم
        if ($request->has('username') && $request->username != '') {
            $query->where('username', 'like', '%' . $request->username . '%');
        }
        
        // التصفية حسب الاسم الكامل
        if ($request->has('full_name') && $request->full_name != '') {
            $query->where('full_name', 'like', '%' . $request->full_name . '%');
        }
        
        // التصفية حسب الحالة
        if ($request->has('is_active') && $request->is_active != '') {
            $query->where('is_active', $request->is_active);
        }
        
        $adminUsers = $query->latest()->paginate(10);
        
        // إحصائيات للمستخدمين
        $totalUsers = AdminUser::count();
        $activeUsers = AdminUser::where('is_active', 1)->count();
        $inactiveUsers = AdminUser::where('is_active', 0)->count();
        
        return view('admin.admin-users.index', compact('adminUsers', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }

    /**
     * عرض نموذج إنشاء مستخدم جديد
     */
    public function create()
    {
        return view('admin.admin-users.create');
    }

    /**
     * حفظ المستخدم الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:admin_users',
            'full_name' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        AdminUser::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'password_hash' => Hash::make($request->password),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.admin-users.index')
            ->with('success', 'تم إضافة المستخدم بنجاح.');
    }

    /**
     * عرض تفاصيل مستخدم معين
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin.admin-users.show', compact('adminUser'));
    }

    /**
     * عرض نموذج تعديل المستخدم
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.admin-users.edit', compact('adminUser'));
    }

    /**
     * تحديث المستخدم في قاعدة البيانات
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:admin_users,username,' . $adminUser->id,
            'full_name' => 'required|string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $adminUser->username = $request->username;
        $adminUser->full_name = $request->full_name;
        $adminUser->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->filled('password')) {
            $adminUser->password_hash = Hash::make($request->password);
        }

        $adminUser->save();

        return redirect()->route('admin.admin-users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح.');
    }

    /**
     * حذف مستخدم من قاعدة البيانات
     */
    public function destroy(AdminUser $adminUser)
    {
        // لا يمكن حذف المستخدم الحالي
        if ($adminUser->id == auth()->id()) {
            return redirect()->route('admin.admin-users.index')
                ->with('error', 'لا يمكنك حذف حسابك الخاص.');
        }
        
        $adminUser->delete();
        
        return redirect()->route('admin.admin-users.index')
            ->with('success', 'تم حذف المستخدم بنجاح.');
    }
}