<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Contact;

use DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $user = auth()->user();
        $companies = $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        // ...

        // \Illuminate\Support\Facades\DB::enableQueryLog();
        $contacts = $user->contacts()->latestFirst()->paginate(10);
        // dd(\Illuminate\Support\Facades\DB::getQueryLog());

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        $contact = new Contact();
        $companies = auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.create', compact('companies', 'contact'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Contact::create($request->all() + ['user_id' => auth()->user()->id]);
        $request->user()->contacts()->create($request->all());

        // dd($request->all());
        // dd($request->only('first_name'));
        // dd($request->except('first_name'));

        // return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
        return redirect('/contacts')->with('message', 'Contact created successfully.');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail(request('id'));
        $companies = auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contact = Contact::findOrFail(request('id'));
        $contact->update($request->all());

        return redirect('/contacts')->with('message', 'Contact edited successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail(request('id'));
        $contact->delete();

        return back()->with('message', 'Contact deleted successfully.');
    }
}
