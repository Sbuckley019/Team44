<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Inertia\Inertia;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $read = $request->read === 'true' ? 1 : 0;
        $category = $request->category;


        $contact = Contact::query()->when($category !== 'all', function ($q) use ($category) {
            return $q->where('category', $category);
        })->get();

        return Inertia::render('Admin/Contact', ['requests' => $contact]);
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'category' => 'required|in:technical_support,billing,general_inquiry',
            'query' => 'required|string',
        ]);


        try {
            Contact::create($validated);
            return redirect()->route('home')->with('success', 'Query submitted successfully!');
        } catch (QueryException $exception) {

            return redirect()->back()->with('error', 'An error occurred while submitting your Query. Please try again.');
        }
    }

    public function read(Request $request)
    {

        $contactId = $request->contactId;

        $contact = Contact::findOrFail($contactId);

        $contact->read = !$contact->read;
        $contact->save();

        Inertia::render('Admin/Contact');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('Contact.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
