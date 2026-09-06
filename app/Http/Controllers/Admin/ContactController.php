<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $inquiries = Contact::with('property')->latest()->paginate(15);
        return view('admin.inquiries', compact('inquiries'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Inquiry deleted successfully!');
    }
}
