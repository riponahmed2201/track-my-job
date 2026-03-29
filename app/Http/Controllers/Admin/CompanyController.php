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
    public function index(Request $request)
    {
        $query = Company::query();

        $search = trim((string) $request->input('search', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('website', 'like', '%'.$search.'%')
                    ->orWhere('industry', 'like', '%'.$search.'%')
                    ->orWhere('headquarters', 'like', '%'.$search.'%');
            });
        }

        $industry = trim((string) $request->input('industry', ''));
        if ($industry !== '') {
            $query->where('industry', $industry);
        }

        $size = trim((string) $request->input('company_size', ''));
        if ($size !== '') {
            $query->where('company_size', 'like', '%'.$size.'%');
        }

        $hq = trim((string) $request->input('headquarters', ''));
        if ($hq !== '') {
            $query->where('headquarters', 'like', '%'.$hq.'%');
        }

        if ($request->filled('founded_year')) {
            $query->where('founded_year', $request->integer('founded_year'));
        }

        $companies = $query->latest()->paginate(12)->withQueryString();

        $industries = Company::query()
            ->whereNotNull('industry')
            ->where('industry', '!=', '')
            ->distinct()
            ->orderBy('industry')
            ->pluck('industry');

        return view('admin.companies.index', compact('companies', 'industries'));
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
            if ($company->logo_url) {
                Storage::disk('public')->delete($company->logo_url);
            }
            $data['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        } else {
            unset($data['logo_url']);
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
