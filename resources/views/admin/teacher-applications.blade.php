@extends('template.admin')

@section('title', 'Teacher applications')

@section('body')
<div class="heading"><div><h1>Teacher applications</h1><div class="muted">{{ $applications->count() }} application{{ $applications->count() === 1 ? '' : 's' }} submitted through your website.</div></div></div>
@if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
<div class="panel" style="overflow-x:auto">
    <table class="course-table" style="min-width:1200px">
        <thead><tr><th>Name / contact</th><th>Gender / age</th><th>Qualification</th><th>Degree</th><th>Experience</th><th>Certifications</th><th>Resume</th><th>Action</th></tr></thead>
        <tbody>
        @forelse ($applications as $application)
            <tr>
                <td><strong>{{ $application->full_name }}</strong><br>{{ $application->email }}<br><span class="muted">{{ $application->phone }}</span></td>
                <td>{{ ucfirst($application->gender) }}, {{ $application->age }}</td>
                <td>{{ $application->qualification }}</td><td>{{ $application->degree }}</td>
                <td>{{ \Illuminate\Support\Str::limit($application->experience, 100) }}</td>
                <td>
                    @forelse (json_decode($application->certifications, true) ?? [] as $certification)
                        <span class="pill off">{{ $certification }}</span>
                    @empty
                        —
                    @endforelse
                </td>
                <td><a class="btn btn-light" href="{{ route('view-resume', $application->id) }}" target="_blank" rel="noopener">View PDF</a></td>
                <td><form method="post" action="{{ route('teacher-applications.destroy', $application) }}" onsubmit="return confirm('Delete this teacher application permanently?')">@csrf @method('DELETE')<button class="btn btn-danger" type="submit">Delete</button></form></td>
            </tr>
        @empty
            <tr><td colspan="8" class="muted">No teacher applications have been submitted yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
