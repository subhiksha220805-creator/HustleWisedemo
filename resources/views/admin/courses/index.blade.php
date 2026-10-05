@extends('template.admin')
@section('title', 'Courses')
@section('body')
@if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
<div class="heading"><div><h1>Courses</h1><div class="muted">Manage the learning paths shown on your site.</div></div><a class="btn" href="{{ route('admin.courses.create') }}"><i class="bi bi-plus-lg"></i> Add course</a></div>
<div class="panel"><table class="course-table"><thead><tr><th>Course</th><th>Grades</th><th>Status</th><th>Actions</th></tr></thead><tbody>
    @forelse ($courses as $course)
    <tr><td><div class="course-name"><span class="course-icon"><i class="bi {{ $course->icon }}"></i></span>{{ $course->title }}</div></td><td>{{ count($course->grades) }} grade groups</td><td><span class="pill {{ $course->is_active ? '' : 'off' }}">{{ $course->is_active ? 'Live' : 'Archived' }}</span></td><td><div class="actions"><a class="btn btn-light" href="{{ route('admin.courses.edit', $course) }}"><i class="bi bi-pencil"></i> Edit</a>@if ($course->is_active)<form method="post" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Archive this course? It will no longer appear publicly.')">@csrf @method('DELETE')<button class="btn btn-danger" type="submit">Archive</button></form>@endif</div></td></tr>
    @empty<tr><td colspan="4" class="muted">No courses yet.</td></tr>@endforelse
</tbody></table></div>
@endsection
