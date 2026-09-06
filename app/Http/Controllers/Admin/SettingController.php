<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slide;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        $slides = Slide::all();
        return view('admin.settings', compact('setting', 'slides'));
    }

    public function updateSetting(Request $request)
    {
        $validated = $request->validate([
            'site_name'     => 'required|string|max:255',
            'contact_no'    => 'nullable|string|max:25',
            'company_email' => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'usd_price'     => 'nullable|numeric',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            Setting::create($validated);
        } else {
            $setting->update($validated);
        }

        return back()->with('success', 'Site settings updated successfully!');
    }

    public function storeSlide(Request $request)
    {
        $request->validate([
            'slide_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
            'slide_desc'  => 'nullable|string|max:255',
        ]);

        $filename = time() . '_' . uniqid() . '.' . $request->file('slide_image')->getClientOriginalExtension();
        $request->file('slide_image')->move(public_path('assets/frontend/images/slides'), $filename);

        Slide::create([
            'slide_image'  => 'assets/frontend/images/slides/' . $filename,
            'slide_desc'   => $request->slide_desc ?? '',
            'slide_status' => 1,
        ]);

        return back()->with('success', 'Slide uploaded successfully!');
    }

    public function destroySlide(Slide $slide)
    {
        $slide->delete();
        return back()->with('success', 'Slide deleted successfully!');
    }
}
