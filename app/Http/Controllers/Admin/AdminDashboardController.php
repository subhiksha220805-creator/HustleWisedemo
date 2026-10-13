<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoBooking;
use App\Models\TeacherApplication;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'demoBookingCount' => DemoBooking::count(),
            'teacherApplicationCount' => TeacherApplication::count(),
            'recentBookings' => DemoBooking::query()
                ->latest()
                ->limit(5)
                ->get(['id', 'parent_name', 'course', 'created_at']),
            'recentApplications' => TeacherApplication::query()
                ->latest()
                ->limit(5)
                ->get(['id', 'full_name', 'email', 'created_at']),
        ]);
    }

    public function demoBookings(): View
    {
        return view('admin.demo-bookings', [
            'bookings' => DemoBooking::query()->latest()->get(),
        ]);
    }

    public function teacherApplications(): View
    {
        return view('admin.teacher-applications', [
            'applications' => TeacherApplication::query()
                ->latest()
                ->get([
                    'id', 'first_name', 'full_name', 'phone', 'email', 'gender', 'age',
                    'qualification', 'degree', 'experience', 'certifications', 'created_at',
                ]),
        ]);
    }
}
