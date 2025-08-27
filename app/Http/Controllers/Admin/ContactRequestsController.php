<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactRequestsController extends Controller
{
    /**
     * عرض قائمة طلبات الاتصال مع إمكانية التصفية
     */
    public function index(Request $request)
    {
        // بناء الاستعلام مع إمكانية التصفية
        $query = ContactRequest::query();
        
        // التصفية حسب الحالة (مقروءة/غير مقروءة)
        if ($request->has('is_read') && $request->is_read != '') {
            $query->where('is_read', $request->is_read);
        }
        
        // التصفية حسب نوع الخدمة
        if ($request->has('service_type') && $request->service_type != '') {
            $query->where('service_type', $request->service_type);
        }
        
        // التصفية حسب الاسم
        if ($request->has('full_name') && $request->full_name != '') {
            $query->where('full_name', 'like', '%' . $request->full_name . '%');
        }
        
        // التصفية حسب الهاتف
        if ($request->has('phone') && $request->phone != '') {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        
        // الترتيب
        $contactRequests = $query->orderBy('submitted_at', 'desc')->paginate(10);
        
        // إحصائيات لطلبات الاتصال
        $totalRequests = ContactRequest::count();
        $readRequests = ContactRequest::where('is_read', 1)->count();
        $unreadRequests = ContactRequest::where('is_read', 0)->count();
        
        // أنواع الخدمات
        $serviceTypes = ContactRequest::select('service_type')
            ->distinct()
            ->pluck('service_type');
        
        return view('admin.contact-requests.index', compact(
            'contactRequests', 
            'totalRequests', 
            'readRequests', 
            'unreadRequests',
            'serviceTypes'
        ));
    }

    /**
     * عرض تفاصيل طلب اتصال معين
     */
    public function show(ContactRequest $contactRequest)
    {
        // علامة كأن الطلب قد تم قراءته
        if (!$contactRequest->is_read) {
            $contactRequest->is_read = true;
            $contactRequest->save();
        }
        
        return view('admin.contact-requests.show', compact('contactRequest'));
    }

    /**
     * عرض نموذج تعديل طلب الاتصال
     */
    public function edit(ContactRequest $contactRequest)
    {
        return view('admin.contact-requests.edit', compact('contactRequest'));
    }

    /**
     * تحديث حالة الطلب في قاعدة البيانات
     */
    public function update(Request $request, ContactRequest $contactRequest)
    {
        $validator = Validator::make($request->all(), [
            'is_read' => 'boolean',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:100',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contactRequest->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'service_type' => $request->service_type,
            'message' => $request->message,
            'is_read' => $request->has('is_read') ? 1 : 0,
        ]);

        return redirect()->route('admin.contact-requests.index')
            ->with('success', 'تم تحديث الطلب بنجاح.');
    }

    /**
     * حذف طلب اتصال من قاعدة البيانات
     */
    public function destroy(ContactRequest $contactRequest)
    {
        $contactRequest->delete();
        
        return redirect()->route('admin.contact-requests.index')
            ->with('success', 'تم حذف الطلب بنجاح.');
    }
}