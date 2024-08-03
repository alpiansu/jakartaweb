<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MContact;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        try {
            $contacts = MContact::all();
            $page_contact = Contact::first();
            return view('admin.contact.index', compact('contacts', 'page_contact'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while fetching the contacts : ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $contact = MContact::findOrFail($id);
            $contact->delete();
            return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contacts.index')->withErrors(['error' => 'An error occurred while deleting the contact: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        try {
            $contact = Contact::where('id', 1)->first();
            $contact->update($request->only(['title', 'description']));

            return redirect()->route('admin.contacts.index')->with('success', 'heading text page contact updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update SubService: ' . $e->getMessage()]);
        }
    }
}
