<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with(['company', 'user']);

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }
        if ($request->filled('contact_type')) {
            $query->where('contact_type', $request->contact_type);
        }

        $contacts = $query->latest()->paginate(15)->withQueryString();
        $companies = Company::orderBy('name')->get();

        return view('admin.contacts.index', compact('contacts', 'companies'));
    }

    public function create(Request $request)
    {
        $companies = Company::orderBy('name')->get();
        $companyId = $request->get('company_id');

        return view('admin.contacts.form', compact('companies', 'companyId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'linkedin_url' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'contact_type' => 'nullable|string|max:50',
            'relationship' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'last_contacted_date' => 'nullable|date',
            'response_rate' => 'nullable|string|max:20',
            'helpful' => 'nullable|boolean',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['helpful'] = $request->boolean('helpful');

        Contact::create($validated);

        return redirect()->route('admin.contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        $contact->load(['company', 'user']);
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $companies = Company::orderBy('name')->get();
        return view('admin.contacts.form', compact('contact', 'companies'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'linkedin_url' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'contact_type' => 'nullable|string|max:50',
            'relationship' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'last_contacted_date' => 'nullable|date',
            'response_rate' => 'nullable|string|max:20',
            'helpful' => 'nullable|boolean',
        ]);
        $validated['helpful'] = $request->boolean('helpful');

        $contact->update($validated);

        return redirect()->route('admin.contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
