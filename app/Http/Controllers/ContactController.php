<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Database\QueryException;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $viewChoice = $request->query('viewChoice', '0');

        $contacts = Contact::where('read', $viewChoice)->get();

        //return view('admin.Contact', compact('Contacts', 'viewChoice'));
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
        $ContactId = $request->ContactId;

        // Find the Contact by ID
        $contact = Contact::findOrFail($ContactId);

        // Toggle the "read" status
        $contact->read = !$contact->read;
        $contact->save();

        return redirect()->route('Contact.index')->with('success', 'Contact has been marked as read');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('Contact.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
