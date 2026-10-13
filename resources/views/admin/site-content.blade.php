@extends('template.admin')

@section('title', 'Website content')

@section('body')
@php($activeTab = request('tab', 'navigation'))
<div class="heading site-content-heading">
    <div>
        <h1>Website content</h1>
        <div class="muted">Edit the homepage text, images and contact details. Saved changes appear on the public website.</div>
    </div>
    <a class="btn btn-light" href="{{ route('admin.courses.index') }}"><i class="bi bi-arrow-left"></i> Courses</a>
</div>

@if (session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert" style="background:#fff0ed;color:#a63b2d">Please review the highlighted content fields.</div>
@endif

<div class="content-tabs" role="tablist" aria-label="Website content sections">
    @foreach ($tabs as $tabKey => $tab)
        <button class="content-tab {{ $activeTab === $tabKey ? 'active' : '' }}" type="button" role="tab"
            id="tab-{{ $tabKey }}" aria-controls="panel-{{ $tabKey }}" aria-selected="{{ $activeTab === $tabKey ? 'true' : 'false' }}"
            data-content-tab="{{ $tabKey }}">{{ $tab['label'] }}</button>
    @endforeach
</div>

<form method="post" action="{{ route('admin.content.update') }}" id="siteContentForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="active_tab" id="activeContentTab" value="{{ $activeTab }}">

    @foreach ($tabs as $tabKey => $tab)
        <section class="content-panel {{ $activeTab === $tabKey ? '' : 'd-none' }}" id="panel-{{ $tabKey }}" role="tabpanel" aria-labelledby="tab-{{ $tabKey }}" data-content-panel="{{ $tabKey }}">
            @foreach ($tab['groups'] as $groupName => $group)
                <div class="panel content-group">
                    <h2 class="content-group-title"><i class="bi {{ $group['icon'] }}"></i> {{ $groupName }}</h2>
                    <div class="content-fields">
                        @foreach ($group['fields'] as $fieldKey => $field)
                            @php($fieldType = $field['type'] ?? 'text')
                            @php($fieldValue = old('content.'.$fieldKey, $content[$fieldKey] ?? ($field['default'] ?? '')))
                            <div class="field {{ $fieldType === 'textarea' ? 'field-full' : '' }}">
                                <label for="content-{{ $fieldKey }}">{{ $field['label'] }}</label>
                                @if ($fieldType === 'textarea')
                                    <textarea id="content-{{ $fieldKey }}" name="content[{{ $fieldKey }}]" rows="4">{{ $fieldValue }}</textarea>
                                @elseif ($fieldType === 'image')
                                    <div class="media-field">
                                        <div class="image-field-row">
                                            <input id="content-{{ $fieldKey }}" name="content[{{ $fieldKey }}]" type="text" value="{{ $fieldValue }}" placeholder="/images/photo.jpg or https://example.com/image.jpg" data-image-preview-input="preview-{{ $fieldKey }}">
                                            <img class="content-image-preview" id="preview-{{ $fieldKey }}" src="{{ $fieldValue }}" alt="{{ $field['label'] }} preview" onerror="this.classList.add('media-preview-hidden')">
                                        </div>
                                        <label class="upload-label" for="upload-{{ $fieldKey }}">Or upload from your device</label>
                                        <input class="media-upload-input" id="upload-{{ $fieldKey }}" name="uploads[{{ $fieldKey }}]" type="file" accept="image/*" data-image-file-preview="preview-{{ $fieldKey }}">
                                    </div>
                                    <small class="help">Paste an image URL above or choose an image from your device (max 20 MB). The preview shows the image that will be used.</small>
                                @elseif ($fieldType === 'video')
                                    <div class="media-field">
                                        <input id="content-{{ $fieldKey }}" name="content[{{ $fieldKey }}]" type="url" value="{{ $fieldValue }}" placeholder="https://example.com/testimonial.mp4" data-video-preview-input="video-{{ $fieldKey }}">
                                        <video class="content-video-preview {{ $fieldValue ? '' : 'media-preview-hidden' }}" id="video-{{ $fieldKey }}" controls playsinline preload="metadata">
                                            <source src="{{ $fieldValue }}">
                                            Your browser cannot play this video.
                                        </video>
                                        <label class="upload-label" for="upload-{{ $fieldKey }}">Or upload a video from your device</label>
                                        <input class="media-upload-input" id="upload-{{ $fieldKey }}" name="uploads[{{ $fieldKey }}]" type="file" accept="video/mp4,video/webm,video/quicktime,video/x-msvideo" data-video-file-preview="video-{{ $fieldKey }}">
                                    </div>
                                    <small class="help">Paste a direct MP4, WebM or MOV video URL, or upload a video from your device (max 50 MB).</small>
                                @elseif ($fieldType === 'icon')
                                    <div class="image-field-row">
                                        <input id="content-{{ $fieldKey }}" name="content[{{ $fieldKey }}]" type="text" value="{{ $fieldValue }}" data-icon-preview="icon-{{ $fieldKey }}">
                                        <span class="icon-preview"><i id="icon-{{ $fieldKey }}" class="bi {{ $fieldValue }}"></i></span>
                                    </div>
                                    <small class="help">Enter a Bootstrap icon name, such as <code>bi-lightbulb-fill</code>.</small>
                                @else
                                    <input id="content-{{ $fieldKey }}" name="content[{{ $fieldKey }}]" type="{{ in_array($fieldType, ['email', 'url', 'video']) ? ($fieldType === 'video' ? 'url' : $fieldType) : 'text' }}" value="{{ $fieldValue }}">
                                @endif
                                @error('content.'.$fieldKey)<small class="errors">{{ $message }}</small>@enderror
                                @error('uploads.'.$fieldKey)<small class="errors">{{ $message }}</small>@enderror
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    @endforeach

    <div class="content-save-row">
        <span class="muted">Your changes are saved to the website database.</span>
        <button type="submit" class="btn"><i class="bi bi-check2"></i> Save changes</button>
    </div>
</form>

<script>
    (() => {
        const tabs = [...document.querySelectorAll('[data-content-tab]')];
        const panels = [...document.querySelectorAll('[data-content-panel]')];
        const hiddenTab = document.getElementById('activeContentTab');

        tabs.forEach((tab) => tab.addEventListener('click', () => {
            const key = tab.dataset.contentTab;
            hiddenTab.value = key;
            tabs.forEach((item) => {
                const active = item === tab;
                item.classList.toggle('active', active);
                item.setAttribute('aria-selected', active ? 'true' : 'false');
            });
            panels.forEach((panel) => panel.classList.toggle('d-none', panel.dataset.contentPanel !== key));
        }));

        document.querySelectorAll('[data-image-preview-input]').forEach((input) => input.addEventListener('input', () => {
            const preview = document.getElementById(input.dataset.imagePreviewInput);
            preview.src = input.value;
            preview.classList.toggle('media-preview-hidden', !input.value);
        }));

        document.querySelectorAll('[data-image-file-preview]').forEach((input) => input.addEventListener('change', () => {
            if (!input.files[0]) return;
            const preview = document.getElementById(input.dataset.imageFilePreview);
            preview.src = URL.createObjectURL(input.files[0]);
            preview.classList.remove('media-preview-hidden');
        }));

        document.querySelectorAll('[data-video-preview-input]').forEach((input) => input.addEventListener('input', () => {
            const preview = document.getElementById(input.dataset.videoPreviewInput);
            preview.src = input.value;
            preview.classList.toggle('media-preview-hidden', !input.value);
            preview.load();
        }));

        document.querySelectorAll('[data-video-file-preview]').forEach((input) => input.addEventListener('change', () => {
            if (!input.files[0]) return;
            const preview = document.getElementById(input.dataset.videoFilePreview);
            preview.src = URL.createObjectURL(input.files[0]);
            preview.classList.remove('media-preview-hidden');
            preview.load();
        }));

        document.querySelectorAll('[data-icon-preview]').forEach((input) => input.addEventListener('input', () => {
            document.getElementById(input.dataset.iconPreview).className = `bi ${input.value}`;
        }));
    })();
</script>
@endsection
