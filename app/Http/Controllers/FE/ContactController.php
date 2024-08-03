<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MContact;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            MContact::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            return back()->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while sending the message. Please try again later.');
        }
    }


    public function index()
    {
        $contact = Contact::first();
        return view("fe.contact.index", compact("contact"));
    }
}
