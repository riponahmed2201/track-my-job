<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications =  JobApplication::with(['user', 'company'])
            ->latest()
            ->paginate(15);

        return view('admin.job-applications.index', compact('applications'));
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();

        return view('admin.job-applications.form', compact('users', 'companies'));
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $data = $request->validated();
        $data['cover_letter_sent'] = $request->has('cover_letter_sent');
        $data['portfolio_sent'] = $request->has('portfolio_sent');
        $data['created_by'] = auth()->id();

        JobApplication::create($data);

        return redirect()->route('admin.job-applications.index')
            ->with('success', 'Job Application created successfully.');
    }

    public function edit(JobApplication $jobApplication)
    {
        $users = User::all();
        $companies = Company::all();

        return view('admin.job-applications.form', compact('jobApplication', 'companies', 'users'));
    }

    public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication)
    {
        $data = $request->validated();
        $data['cover_letter_sent'] = $request->has('cover_letter_sent');
        $data['portfolio_sent'] = $request->has('portfolio_sent');
        $data['updated_by'] = auth()->id();

        $jobApplication->update($data);

        return redirect()->route('admin.job-applications.index')
            ->with('success', 'Job Application updated successfully.');
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        return redirect()->route('admin.job-applications.index')
            ->with('success', 'Job Application deleted successfully.');
    }

    public function show(JobApplication $jobApplication)
    {
        // Eager load related user and company
        $jobApplication->load(['user', 'company']);

        // Pass data to the view
        return view('admin.job-applications.show', compact('jobApplication'));
    }
}
