<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\BusinessHour;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        $businessHours = BusinessHour::orderBy('order')->get();
        return view('admin.contact.index', compact('contact', 'businessHours'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required',
            'address' => 'required',
            'maps_embed' => 'nullable',
            'delivery_info' => 'nullable',
            'parking_info' => 'nullable',
        ]);

        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
        }

        $contact->fill($request->all());
        $contact->save();

        return redirect()->route('admin.contact.index')->with('success', 'Contact information updated successfully!');
    }

    public function updateHour(Request $request, BusinessHour $businessHour)
    {
        $request->validate([
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $businessHour->update($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Business hour updated successfully!');
    }

    public function createHour(Request $request)
    {
        $request->validate([
            'day' => 'required|unique:business_hours',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        BusinessHour::create($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Business hour added successfully!');
    }

    public function destroyHour(BusinessHour $businessHour)
    {
        $businessHour->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Business hour deleted successfully!');
    }
}