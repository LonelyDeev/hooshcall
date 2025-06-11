<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contacts');
    }

    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('back.contacts.index', compact('contacts'));
    }

    public function getDetails(Contact $contact)
    {
        return response()->json([
            'name' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email,
            'message' => $contact->message,
            'created_at' => jdate($contact->created_at)->format('Y/m/d H:i')
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('back.contacts.index')->with('success', 'تماس با موفقیت حذف شد.');
    }

    public function multipleDestroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        Contact::whereIn('id', $ids)->delete();
        return redirect()->route('back.contacts.index')->with('success', 'تماس‌های انتخاب شده با موفقیت حذف شدند.');
    }
}