<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'phone'      => 'required|string|max:30',
            'email'      => 'required|email|max:150',
            'message'    => 'required|string|max:1000',
            'property_id' => 'nullable|integer|exists:properties,id',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Thank you! Your inquiry has been submitted successfully. Our team will contact you shortly.');
    }
}
