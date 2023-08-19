<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('first_name')->where(function ($query) {
            if ($companyId = request('company_id')) {
                $query->where('company_id', $companyId);
            }
        })->paginate(10);
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }
}
