<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::where('name', 'like', "%$search%")
            ->orWhere('subject', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate(5);
        return view('tamplate.dashboard.menuadmin.contactUs', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tamplate.landingpage.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'captcha' => 'Captcha tidak sesuai, silahkan ulang kembali.',
        ]);

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->save();
        Mail::to($contact->email)->send(new ContactConfirmation($contact));

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // Mencari data Contact berdasarkan ID
        $contact->delete(); // Menghapus data Contact
        return redirect()->route('contact.index')->with('success', 'Data berhasil dihapus.');
    }
}
