<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FollowUp;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUpController extends Controller
{
    public function index(Request $request)
    {
        $query = FollowUp::with(['jobApplication.company', 'user']);

        if ($request->filled('job_application_id')) {
            $query->where('job_application_id', $request->job_application_id);
        }
        if ($request->filled('completed')) {
            $query->where('completed', $request->boolean('completed'));
        }

        $followUps = $query->latest('follow_up_date')->paginate(15)->withQueryString();
        $jobApplications = JobApplication::with('company')->latest()->limit(200)->get();

        return view('admin.follow-ups.index', compact('followUps', 'jobApplications'));
    }

    public function create(Request $request)
    {
        $jobApplications = JobApplication::with('company')->orderBy('application_date', 'desc')->get();
        $jobApplicationId = $request->get('job_application_id');

        return view('admin.follow-ups.form', compact('jobApplications', 'jobApplicationId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'follow_up_date' => 'required|date',
            'follow_up_type' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message_sent' => 'nullable|string',
            'response_received' => 'nullable|string',
            'response_time_hours' => 'nullable|integer|min:0',
            'sentiment' => 'nullable|string|max:20',
            'next_action' => 'nullable|string|max:255',
            'reminder_set' => 'nullable|boolean',
            'reminder_date' => 'nullable|date',
            'completed' => 'nullable|boolean',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['reminder_set'] = $request->boolean('reminder_set');
        $validated['completed'] = $request->boolean('completed');

        FollowUp::create($validated);

        return redirect()->route('admin.follow-ups.index')->with('success', 'Follow-up created successfully.');
    }

    public function show(FollowUp $follow_up)
    {
        $follow_up->load(['jobApplication.company', 'user']);
        return view('admin.follow-ups.show', compact('follow_up'));
    }

    public function edit(FollowUp $follow_up)
    {
        $jobApplications = JobApplication::with('company')->orderBy('application_date', 'desc')->get();
        return view('admin.follow-ups.form', compact('follow_up', 'jobApplications'));
    }

    public function update(Request $request, FollowUp $follow_up)
    {
        $validated = $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'follow_up_date' => 'required|date',
            'follow_up_type' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message_sent' => 'nullable|string',
            'response_received' => 'nullable|string',
            'response_time_hours' => 'nullable|integer|min:0',
            'sentiment' => 'nullable|string|max:20',
            'next_action' => 'nullable|string|max:255',
            'reminder_set' => 'nullable|boolean',
            'reminder_date' => 'nullable|date',
            'completed' => 'nullable|boolean',
        ]);
        $validated['reminder_set'] = $request->boolean('reminder_set');
        $validated['completed'] = $request->boolean('completed');

        $follow_up->update($validated);

        return redirect()->route('admin.follow-ups.index')->with('success', 'Follow-up updated successfully.');
    }

    public function destroy(FollowUp $follow_up)
    {
        $follow_up->delete();
        return redirect()->route('admin.follow-ups.index')->with('success', 'Follow-up deleted successfully.');
    }
}
