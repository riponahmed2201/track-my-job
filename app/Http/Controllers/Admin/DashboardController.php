<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Count by status group: Applied | Interview | Offer
        $appliedCount = JobApplication::whereIn('application_status', [
            'applied',
            'under_review',
            'phone_screen',
            'technical_test',
        ])->count();

        $interviewCount = JobApplication::whereIn('application_status', [
            'interview',
            'final_interview',
        ])->count();

        $offerCount = JobApplication::whereIn('application_status', [
            'offer',
            'accepted',
        ])->count();

        $recentApplications = JobApplication::with(['company'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'appliedCount',
            'interviewCount',
            'offerCount',
            'recentApplications'
        ));
    }
}
