@extends('template.admin')
@section('title', $isEditing ? 'Edit course' : 'Add course')
@section('body')
@if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
<div class="heading"><div><h1>{{ $isEditing ? 'Edit course' : 'Add a course' }}</h1><div class="muted">Update the information learners see on the course page.</div></div><a class="btn btn-light" href="{{ route('admin.courses.index') }}"><i class="bi bi-arrow-left"></i> Back to courses</a></div>
            @if ($errors->any())<div class="alert" style="background:#fff0ed;color:#a63b2d">Please check the highlighted fields and roadmap format.</div>@endif
            <form class="panel form-panel" method="post" action="{{ $isEditing ? route('admin.courses.update', $course) : route('admin.courses.store') }}">
                @csrf @if ($isEditing) @method('PUT') @endif
                <div class="grid">
                    <div class="field"><label for="title">Course name</label><input id="title" name="title" value="{{ old('title', $course->title) }}" required>@error('title')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="slug">Page address (slug)</label><input id="slug" name="slug" value="{{ old('slug', $course->slug) }}" @readonly($isEditing) required><span class="help">Use lowercase words separated by hyphens, such as creative-writing. The address is fixed after creation.</span>@error('slug')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="subtitle">Short introduction</label><input id="subtitle" name="subtitle" value="{{ old('subtitle', $course->subtitle) }}" required>@error('subtitle')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="image">Cover image URL or local image path</label><input id="image" name="image" type="text" value="{{ old('image', $course->image) }}" placeholder="/images/courses/public-speaking.jpg"><span class="help">Use a local image from public/images or an https image URL.</span>@error('image')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field full"><label for="description">Course description</label><textarea id="description" name="description" required>{{ old('description', $course->description) }}</textarea>@error('description')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="icon">Icon name</label><input id="icon" name="icon" value="{{ old('icon', $course->icon ?: 'bi-book') }}" required><span class="help">Bootstrap icon class, for example bi bi-book (enter bi-book).</span></div>
                    <div class="field"><label for="color">Theme color</label><input id="color" name="color" type="color" value="{{ old('color', $course->color ?: '#ff7a00') }}" required></div>
                    <div class="field full"><label for="grades_json">Grade groups (JSON list)</label><textarea id="grades_json" name="grades_json" required>{{ old('grades_json', json_encode($course->grades ?: ['K to 1', 'Adult'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea><span class="help">Example: ["K to 1", "2 to 3", "Adult"]</span>@error('grades_json')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field full"><label for="roadmap_json">Roadmap topics by grade (JSON object)</label><textarea id="roadmap_json" name="roadmap_json" required>{{ old('roadmap_json', json_encode($course->roadmap ?: ['K to 1' => ['Getting started', 'Practice', 'Build confidence']], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea><span class="help">Include a topic list for each grade group above. Example: {"K to 1": ["Getting started", "Practice"]}</span>@error('roadmap_json')<span class="errors">{{ $message }}</span>@enderror</div>
                    <div class="field full"><label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $course->exists ? $course->is_active : true))> Show this course on the public website</label></div>
                </div>
                <div class="actions" style="margin-top:24px"><button class="btn" type="submit"><i class="bi bi-check2"></i> Save course</button><a class="btn btn-light" href="{{ route('admin.courses.index') }}">Cancel</a></div>
</form>
@endsection
