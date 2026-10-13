@extends('template.admin')

@section('title', 'Demo bookings')

@section('body')
<div class="heading"><div><h1>Demo bookings</h1><div class="muted">{{ $bookings->count() }} booking{{ $bookings->count() === 1 ? '' : 's' }} submitted through your website.</div></div></div>
@if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
<div class="panel" style="overflow-x:auto">
    <table class="course-table" style="min-width:1000px">
        <thead><tr><th>Parent</th><th>Child</th><th>Email / mobile</th><th>Course</th><th>Class</th><th>Preference</th><th>Date & time</th><th>Feedback</th><th>Action</th></tr></thead>
        <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->parent_name }}</td><td>{{ $booking->children_name }}</td>
                <td>{{ $booking->email }}<br><span class="muted">{{ $booking->mobile ?: 'No mobile' }}</span></td>
                <td>{{ $booking->course }}</td><td>{{ $booking->class_age_group }}</td>
                <td>{{ $booking->teacher_preference === '1to1' ? '1 on 1' : $booking->teacher_preference }}</td>
                <td>{{ ucfirst($booking->date_preference) }}<br>{{ $booking->time_preference }}</td>
                <td>{{ $booking->feedback ?: '—' }}</td>
                <td><form method="post" action="{{ route('demo-bookings.destroy', $booking) }}" onsubmit="return confirm('Delete this demo booking permanently?')">@csrf @method('DELETE')<button class="btn btn-danger" type="submit">Delete</button></form></td>
            </tr>
        @empty
            <tr><td colspan="9" class="muted">No demo bookings have been submitted yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
