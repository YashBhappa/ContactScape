<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

use DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $user = auth()->user();
        $companies = Contact::userCompanies();
        // ...

        // \Illuminate\Support\Facades\DB::enableQueryLog();
        $contacts = $user->contacts()->latestFirst()->paginate(10);
        // dd(\Illuminate\Support\Facades\DB::getQueryLog());

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        $contact = new Contact();
        $companies = Contact::userCompanies();
        return view('contacts.create', compact('companies', 'contact'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function store(ContactRequest $request)
    {

        // Contact::create($request->all() + ['user_id' => auth()->user()->id]);
        $request->user()->contacts()->create($request->all());

        // dd($request->only('first_name'));
        // dd($request->except('first_name'));

        // return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
        return redirect('/contacts')->with('message', 'Contact created successfully.');
    }

    public function edit(Contact $contact)
    {
        $companies = Contact::userCompanies();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {

        $contact->update($request->all());

        return redirect('/contacts')->with('message', 'Contact edited successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('message', 'Contact deleted successfully.');
    }
}
