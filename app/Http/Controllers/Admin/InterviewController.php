<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Interview::with(['jobApplication.company']);

        if ($request->filled('job_application_id')) {
            $query->where('job_application_id', $request->job_application_id);
        }
        if ($request->filled('outcome')) {
            $query->where('outcome', $request->outcome);
        }

        $interviews = $query->latest('scheduled_date')->paginate(15)->withQueryString();
        $jobApplications = JobApplication::with('company')->latest()->limit(200)->get();

        return view('admin.interviews.index', compact('interviews', 'jobApplications'));
    }

    public function create(Request $request)
    {
        $jobApplications = JobApplication::with('company')->orderBy('application_date', 'desc')->get();
        $jobApplicationId = $request->get('job_application_id');

        return view('admin.interviews.form', compact('jobApplications', 'jobApplicationId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'interview_round' => 'nullable|integer|min:1',
            'interview_type' => 'nullable|string|max:100',
            'interviewer_name' => 'nullable|string|max:255',
            'interviewer_designation' => 'nullable|string|max:255',
            'scheduled_date' => 'nullable|date',
            'duration_minutes' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'meeting_link' => 'nullable|string|max:500',
            'interview_format' => 'nullable|string|max:50',
            'preparation_notes' => 'nullable|string',
            'questions_asked' => 'nullable|string',
            'my_answers' => 'nullable|string',
            'technical_topics' => 'nullable|string',
            'coding_problems' => 'nullable|string',
            'interview_feedback' => 'nullable|string',
            'interviewer_feedback' => 'nullable|string',
            'outcome' => 'nullable|string|max:50',
            'confidence_level' => 'nullable|integer|min:1|max:5',
            'difficulty_level' => 'nullable|integer|min:1|max:5',
            'overall_experience' => 'nullable|integer|min:1|max:5',
            'next_round_scheduled' => 'nullable|boolean',
            'follow_up_required' => 'nullable|boolean',
        ]);
        $validated['created_by'] = Auth::id();
        $validated['next_round_scheduled'] = $request->boolean('next_round_scheduled');
        $validated['follow_up_required'] = $request->boolean('follow_up_required');

        Interview::create($validated);

        return redirect()->route('admin.interviews.index')->with('success', 'Interview recorded successfully.');
    }

    public function show(Interview $interview)
    {
        $interview->load(['jobApplication.company', 'creator', 'updater']);
        return view('admin.interviews.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $jobApplications = JobApplication::with('company')->orderBy('application_date', 'desc')->get();
        return view('admin.interviews.form', compact('interview', 'jobApplications'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'interview_round' => 'nullable|integer|min:1',
            'interview_type' => 'nullable|string|max:100',
            'interviewer_name' => 'nullable|string|max:255',
            'interviewer_designation' => 'nullable|string|max:255',
            'scheduled_date' => 'nullable|date',
            'duration_minutes' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'meeting_link' => 'nullable|string|max:500',
            'interview_format' => 'nullable|string|max:50',
            'preparation_notes' => 'nullable|string',
            'questions_asked' => 'nullable|string',
            'my_answers' => 'nullable|string',
            'technical_topics' => 'nullable|string',
            'coding_problems' => 'nullable|string',
            'interview_feedback' => 'nullable|string',
            'interviewer_feedback' => 'nullable|string',
            'outcome' => 'nullable|string|max:50',
            'confidence_level' => 'nullable|integer|min:1|max:5',
            'difficulty_level' => 'nullable|integer|min:1|max:5',
            'overall_experience' => 'nullable|integer|min:1|max:5',
            'next_round_scheduled' => 'nullable|boolean',
            'follow_up_required' => 'nullable|boolean',
        ]);
        $validated['updated_by'] = Auth::id();
        $validated['next_round_scheduled'] = $request->boolean('next_round_scheduled');
        $validated['follow_up_required'] = $request->boolean('follow_up_required');

        $interview->update($validated);

        return redirect()->route('admin.interviews.index')->with('success', 'Interview updated successfully.');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect()->route('admin.interviews.index')->with('success', 'Interview deleted successfully.');
    }
}
