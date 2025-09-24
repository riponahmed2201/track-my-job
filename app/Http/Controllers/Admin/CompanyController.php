<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(12);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.form');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo_url')) {
            $data['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        $data['created_by'] = Auth::id();

        Company::create($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.form', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo_url')) {
            // Delete old logo if exists
            if ($company->logo_url) {
                Storage::disk('public')->delete($company->logo_url);
            }
            $data['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        $data['updated_by'] = Auth::id();

        $company->update($data);

        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }

    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
