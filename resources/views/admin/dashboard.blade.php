@extends('template.admin')

@section('title', 'Dashboard')

@section('body')
<div class="heading">
    <div><h1>Dashboard</h1><div class="muted">An overview of the activity on your site.</div></div>
</div>

<div class="grid" style="margin-bottom:26px">
    <a class="panel" href="{{ route('admin.demo-bookings.index') }}" style="padding:24px;text-decoration:none;color:inherit">
        <div class="muted">Demo bookings</div>
        <div style="font:800 32px Manrope,sans-serif;margin-top:8px">{{ $demoBookingCount }}</div>
        <div class="muted" style="margin-top:8px">View all bookings <i class="bi bi-arrow-right"></i></div>
    </a>
    <a class="panel" href="{{ route('admin.teacher-applications.index') }}" style="padding:24px;text-decoration:none;color:inherit">
        <div class="muted">Teacher applications</div>
        <div style="font:800 32px Manrope,sans-serif;margin-top:8px">{{ $teacherApplicationCount }}</div>
        <div class="muted" style="margin-top:8px">View all applications <i class="bi bi-arrow-right"></i></div>
    </a>
</div>

<div class="grid">
    <section class="panel" style="padding:22px">
        <h2 style="font-size:18px;margin:0 0 16px">Recent demo bookings</h2>
        @forelse ($recentBookings as $booking)
            <div style="padding:12px 0;border-top:1px solid var(--line)">
                <strong>{{ $booking->parent_name }}</strong><div class="muted">{{ $booking->course }} · {{ $booking->created_at->format('d M Y') }}</div>
            </div>
        @empty
            <p class="muted" style="margin:0">No demo bookings yet.</p>
        @endforelse
    </section>
    <section class="panel" style="padding:22px">
        <h2 style="font-size:18px;margin:0 0 16px">Recent teacher applications</h2>
        @forelse ($recentApplications as $application)
            <div style="padding:12px 0;border-top:1px solid var(--line)">
                <strong>{{ $application->full_name }}</strong><div class="muted">{{ $application->email }} · {{ $application->created_at->format('d M Y') }}</div>
            </div>
        @empty
            <p class="muted" style="margin:0">No teacher applications yet.</p>
        @endforelse
    </section>
</div>
@endsection
