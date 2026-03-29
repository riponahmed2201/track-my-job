<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\ApplicationStatusHistory;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = JobApplication::with(['user', 'company']);

        // Filters
        if ($request->filled('status')) {
            $query->where('application_status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->filled('applicant_id')) {
            $query->where('user_id', $request->applicant_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('application_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('application_date', '<=', $request->to_date);
        }

        $applications = $query->latest()->paginate(15)->withQueryString();

        // For filter dropdowns
        $companies = Company::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('admin.job-applications.index', compact('applications', 'companies', 'users'));
    }


    public function create()
    {
        $users = User::all();
        $companies = Company::all();

        return view('admin.job-applications.form', compact('users', 'companies'));
    }

    public function store(StoreJobApplicationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['cover_letter_sent'] = $request->has('cover_letter_sent');
            $data['portfolio_sent'] = $request->has('portfolio_sent');
            $data['created_by'] = auth()->id();

            $app = JobApplication::create($data);
            if (!empty($data['application_status']) && $data['application_status'] !== 'applied') {
                ApplicationStatusHistory::create([
                    'job_application_id' => $app->id,
                    'previous_status' => 'applied',
                    'new_status' => $data['application_status'],
                    'created_by' => auth()->id(),
                ]);
            }

            return redirect()->route('admin.job-applications.index')
                ->with('success', 'Job Application created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the job application: ' . $e->getMessage()]);
        }
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

        $oldStatus = $jobApplication->application_status;
        $jobApplication->update($data);
        if (isset($data['application_status']) && $data['application_status'] !== $oldStatus) {
            ApplicationStatusHistory::create([
                'job_application_id' => $jobApplication->id,
                'previous_status' => $oldStatus,
                'new_status' => $data['application_status'],
                'created_by' => auth()->id(),
            ]);
        }

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
        $jobApplication->load([
            'user',
            'company',
            'applicationStatusHistories' => fn ($q) => $q->latest()->limit(50),
            'interviews' => fn ($q) => $q->latest('scheduled_date'),
            'followUps' => fn ($q) => $q->latest('follow_up_date'),
        ]);

        return view('admin.job-applications.show', compact('jobApplication'));
    }
}
