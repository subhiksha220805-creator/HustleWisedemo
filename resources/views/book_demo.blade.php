<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<<<<<<< HEAD
    <meta name="description" content="Book a free HustleWise demo class and discover a fun way for your child to learn.">
    <title>Book a Free Demo | HustleWise</title>
    <link rel="icon" type="image/png" href="{{ secure_asset('logo.png') }}">
=======
    <meta name="description" content="{{ $siteContent['demo_meta_description'] }}">
    <title>{{ $siteContent['nav_demo'] }} | {{ $siteContent['site_title'] }}</title>
    <link rel="icon" type="image/png" href="/logo.png">
>>>>>>> c35d112 (Updated Hustle Wise website)
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('style.css?v=course-dropdown-class-picker') }}">
    <style>
        :root { --demo-orange:#ff7a00; --demo-ink:#242424; }
        body { background:#fffaf5; color:var(--demo-ink); }
        .demo-nav { background:#fff; }
        .demo-page-brand { color:#242424; font-size:1.5rem; font-weight:800; text-decoration:none; }
        .demo-page-brand span { color:var(--demo-orange); }
        .demo-page-brand > span { color:#242424; }
        .demo-hero { position:relative; overflow:hidden; padding:clamp(3rem,7vw,5rem) 0 2.5rem; background:linear-gradient(135deg,#fff7ee,#fff 65%); }
        .demo-hero h1 { max-width:800px; font-size:clamp(2.4rem,5vw,4rem); line-height:1.08; letter-spacing:-.04em; font-weight:800; }
        .demo-hero h1 span { color:var(--demo-orange); }
        .demo-lead { max-width:640px; color:#6c757d; font-size:1.12rem; }
        .demo-art { position:absolute; right:9%; top:22%; width:180px; height:180px; border-radius:50%; background:#ffedd9; display:grid; place-items:center; font-size:5rem; animation:demoFloat 4s ease-in-out infinite; box-shadow:0 18px 45px #ff7a0020; }
        .demo-spark { position:absolute; color:#ff9d42; font-size:1.7rem; animation:demoTwinkle 2.4s ease-in-out infinite; }
        .demo-spark.one { top:24%; right:7%; }.demo-spark.two { top:68%; right:21%; animation-delay:.8s; }
        @keyframes demoFloat { 0%,100% { transform:translateY(0) rotate(-4deg); } 50% { transform:translateY(-13px) rotate(4deg); } }
        @keyframes demoTwinkle { 0%,100% { opacity:.45; transform:scale(.8); } 50% { opacity:1; transform:scale(1.18); } }
        .demo-booking-section { padding:1.5rem 0 4rem; }
        .demo-form-card { background:#fff; border:1px solid #f0e3d7; border-radius:24px; box-shadow:0 18px 48px #3c28120c; padding:clamp(1.25rem,4vw,2.5rem); }
        .demo-form-card .form-control,.demo-form-card .form-select { min-height:48px; border-radius:12px; }
        .demo-form-card textarea.form-control { min-height:100px; }
        .demo-step { display:none; animation:demoEnter .35s ease both; }.demo-step.active { display:block; }
        @keyframes demoEnter { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .demo-aside-card { border-radius:22px; background:#fff1e3; padding:1.5rem; height:100%; }
        .demo-aside-icon { width:46px;height:46px;display:grid;place-items:center;background:#fff;color:var(--demo-orange);border-radius:15px;font-size:1.35rem; }
        .demo-class-select { display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:.55rem; }
        .demo-class-button { border:1px solid #e7e1dc;background:#fff;border-radius:10px;padding:.7rem .3rem;color:#454545; }
        .demo-class-button:hover,.demo-class-button.selected { border-color:var(--demo-orange);background:#fff1e3;color:#d65f00; }
        .demo-class-button:focus-visible { outline:3px solid #ffbf80;outline-offset:2px; }
        .demo-mode-options { display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.9rem;margin-bottom:1.2rem; }
        .demo-mode-card { display:flex;align-items:center;gap:.85rem;min-height:145px;padding:.8rem 1rem;border:1px solid #e7e1dc;border-radius:16px;background:#fff;cursor:pointer;transition:border-color .2s,background .2s,transform .2s; }
        .demo-mode-card:hover { transform:translateY(-2px); }
        .demo-mode-card:has(input:checked) { border-color:var(--demo-orange);background:#fff8f1;box-shadow:0 6px 18px #ff7a0015; }
        .demo-mode-card input { accent-color:var(--demo-orange);flex:0 0 auto; }
        .demo-mode-card img { width:125px;height:122px;flex:0 0 125px;object-fit:contain;border-radius:12px;background:#fff; }
        .demo-mode-copy strong { display:block;font-size:1rem; }.demo-mode-copy small { display:block;color:#6c757d;margin-top:.2rem; }
        .demo-success-panel { background:#fff;border:1px solid #f0e3d7;border-radius:24px;padding:clamp(1.25rem,4vw,2.5rem);box-shadow:0 18px 48px #3c28120c; }
        .demo-success-top { display:flex;justify-content:space-between;gap:1rem;align-items:center;flex-wrap:wrap; }
        .demo-confirmed,.demo-trial { border-radius:999px;padding:.55rem .9rem;font-weight:700; }
        .demo-confirmed { background:#fff1e3;color:#c95a00; }.demo-trial { background:#fff2c7;color:#705300; }
        .demo-schedule { display:grid;grid-template-columns:1fr 1.3fr;align-items:center;gap:1rem;background:#252547;color:white;border:2px solid #ffb53f;border-radius:18px;padding:1.4rem 1.6rem;margin:1.2rem 0; }
        .demo-schedule-time { text-align:center;font-size:clamp(2rem,5vw,3.4rem);font-weight:800;line-height:1.1; }.demo-schedule-time small { display:block;font-size:.9rem;font-weight:500;margin-top:.5rem; }
        .demo-info-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:.85rem;margin:1.2rem 0; }
        .demo-info-card { display:flex;gap:.8rem;align-items:center;border:1px solid #e9e1da;border-radius:16px;padding:1rem; }.demo-info-card i { font-size:1.5rem;color:var(--demo-orange); }
        .demo-info-card p { color:#6c757d;font-size:.9rem;margin:0; }.demo-info-card strong { display:block;margin-bottom:.25rem; }
        .demo-countdown { background:#fff1e3;border-radius:16px;padding:1.1rem;text-align:center; }
        @media(max-width:991.98px) { .demo-art { width:125px;height:125px;font-size:3.5rem;right:5%;top:35%; } }
        @media(max-width:767.98px) { .demo-art,.demo-spark { display:none; }.demo-info-grid { grid-template-columns:1fr; }.demo-class-select { grid-template-columns:repeat(3,minmax(0,1fr)); }.demo-schedule { grid-template-columns:1fr;text-align:center; } }
        @media(max-width:520px) { .demo-mode-options { grid-template-columns:1fr; }.demo-mode-card { min-height:120px; }.demo-mode-card img { width:104px;height:100px;flex-basis:104px; } }
        @media(prefers-reduced-motion:reduce) { *,*::before,*::after { animation-duration:.01ms !important; animation-iteration-count:1 !important; scroll-behavior:auto !important; } }
    </style>
</head>
<body class="with-demo-bottom-bar">
    <nav class="navbar demo-nav shadow-sm sticky-top">
        <div class="container py-2 d-flex justify-content-between align-items-center">
<<<<<<< HEAD
            <a class="demo-page-brand d-flex align-items-center gap-2" href="{{ url('/') }}"><img src="{{ secure_asset('logo.png') }}" alt="HustleWise" height="46"><span class="text-dark">Hustle<span>Wise</span></span></a>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4">← Back to home</a>
=======
            <a class="demo-page-brand d-flex align-items-center gap-2" href="{{ url('/') }}"><img src="/logo.png" alt="HustleWise" height="46"><span class="brand-wordmark"><span class="brand-hustle">Hustle</span><span class="brand-wise">Wise</span></span></a>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4">{{ $siteContent['demo_back_home'] }}</a>
>>>>>>> c35d112 (Updated Hustle Wise website)
        </div>
    </nav>

    <header class="demo-hero">
        <div class="container position-relative">
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background:#fff0df;color:#dc6800">A LITTLE TASTE OF BIG IDEAS</span>
            <h1>Learning can feel like <span>an adventure.</span></h1>
            <p class="demo-lead mt-3 mb-0">Choose a course and a convenient time. We’ll help your child explore a live class with a friendly HustleWise teacher.</p>
            <div class="demo-art" aria-hidden="true">📚</div><span class="demo-spark one" aria-hidden="true">✦</span><span class="demo-spark two" aria-hidden="true">✧</span>
        </div>
    </header>

    <main class="demo-booking-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4">
                    <aside class="demo-aside-card">
                        <div class="demo-aside-icon mb-3"><i class="bi bi-stars"></i></div>
                        <h2 class="h4 fw-bold">A free class, made for your child</h2>
                        <p class="text-secondary">Meet a teacher, try a real lesson and discover a subject your child will love.</p>
                        <ul class="list-unstyled text-secondary mb-0">
                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#ff7a00"></i>Personal attention from a teacher</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#ff7a00"></i>Friendly, interactive learning</li>
                            <li><i class="bi bi-check-circle-fill me-2" style="color:#ff7a00"></i>Helpful feedback after class</li>
                        </ul>
                        <div class="mt-4 p-3 bg-white rounded-4"><span class="fs-4 me-2">💡</span><strong>{{ $siteContent['demo_teaser_title'] }}</strong><p class="text-secondary small mb-0 mt-1">{{ $siteContent['demo_teaser_description'] }}</p></div>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <div class="demo-form-card">
                        <div class="mb-4">
                            <h2 class="h3 fw-bold mb-1" id="demoModalLabel">{{ $siteContent['demo_form_title'] }}</h2>
                            <p class="text-secondary mb-3" id="demoModalSubtitle">{{ $siteContent['demo_form_description'] }}</p>
                            <div class="progress" id="demoProgress" style="height:7px"><div class="progress-bar" id="progressBar" role="progressbar" style="width:20%" aria-valuemin="0" aria-valuemax="100"></div></div>
                        </div>
                        <div id="successMessage" class="demo-success-panel d-none" role="status" aria-live="polite">
                            <div class="demo-success-top"><span class="demo-confirmed"><i class="bi bi-check-circle me-1"></i> {{ $siteContent['demo_success_badge'] }}</span><span class="demo-trial">{{ $siteContent['demo_trial_badge'] }}</span></div>
                            <h3 id="demoSuccessTitle" class="h3 fw-bold mt-3">{{ $siteContent['demo_success_title'] }}</h3>
                            <div class="demo-schedule"><div><strong id="demoSuccessWeekday">{{ $siteContent['demo_success_weekday'] }}</strong><br><span id="demoSuccessDate">{{ $siteContent['demo_success_date'] }}</span></div><div class="demo-schedule-time"><span id="demoSuccessTime">—</span><small>{{ $siteContent['demo_timezone'] }}</small></div></div>
                            <p class="text-secondary">{{ $siteContent['demo_link_notice'] }}</p>
                            <hr>
                            <h4 class="h5 fw-bold">{{ $siteContent['demo_expect_title'] }}</h4>
                            <p class="text-secondary"><i class="bi bi-mic-fill me-2" style="color:#ff7a00"></i><strong>{{ $siteContent['demo_success_course_label'] }}</strong> <span id="demoSuccessCourse">{{ $siteContent['demo_success_course_placeholder'] }}</span></p>
                            <div class="demo-info-grid">
                                <article class="demo-info-card"><i class="bi bi-mortarboard"></i><div><strong id="demoSuccessClassType">{{ $siteContent['demo_live_class_title'] }}</strong><p>{{ $siteContent['demo_live_class_description'] }}</p></div></article>
                                <article class="demo-info-card"><i class="bi bi-file-earmark-text"></i><div><strong>{{ $siteContent['demo_feedback_title'] }}</strong><p>{{ $siteContent['demo_feedback_description'] }}</p></div></article>
                                <article class="demo-info-card"><i class="bi bi-patch-check"></i><div><strong>{{ $siteContent['demo_progress_title'] }}</strong><p>{{ $siteContent['demo_progress_description'] }}</p></div></article>
                            </div>
                            <div class="demo-countdown mb-4">{{ $siteContent['demo_countdown_title'] }}<br><span class="text-secondary">{{ $siteContent['demo_countdown_prefix'] }} </span><strong id="demoCountdown">{{ $siteContent['demo_countdown_placeholder'] }}</strong></div>
                            <a href="{{ url('/') }}" class="btn btn-orange rounded-pill px-4">{{ $siteContent['demo_return_home'] }}</a>
                        </div>
                        <form id="demoForm" onsubmit="event.preventDefault(); submitDemoForm();">
                            <div class="demo-step active" id="demoStep1">
                                <h3 class="h5 fw-bold mb-3">{{ $siteContent['demo_step_course_title'] }}</h3>
                                <label for="courseSelect" class="form-label">{{ $siteContent['demo_course_question'] }}</label>
                                <select class="form-select mb-4" id="courseSelect" required><option value="">{{ $siteContent['demo_course_placeholder'] }}</option><option value="public-speaking" {{ request('course') === 'public-speaking' ? 'selected' : '' }}>{{ $siteContent['demo_course_public_speaking'] }}</option><option value="creative-writing" {{ request('course') === 'creative-writing' ? 'selected' : '' }}>{{ $siteContent['demo_course_creative_writing'] }}</option><option value="coding" {{ request('course') === 'coding' ? 'selected' : '' }}>{{ $siteContent['demo_course_coding'] }}</option><option value="hustlewise-english" {{ request('course') === 'hustlewise-english' ? 'selected' : '' }}>{{ $siteContent['demo_course_english'] }}</option><option value="maths" {{ request('course') === 'maths' ? 'selected' : '' }}>{{ $siteContent['demo_course_maths'] }}</option><option value="business-english" {{ request('course') === 'business-english' ? 'selected' : '' }}>{{ $siteContent['demo_course_business_english'] }}</option><option value="music" {{ request('course') === 'music' ? 'selected' : '' }}>{{ $siteContent['demo_course_music'] }}</option><option value="spoken-english" {{ request('course') === 'spoken-english' ? 'selected' : '' }}>{{ $siteContent['demo_course_spoken_english'] }}</option></select>
                                <div class="d-flex justify-content-end"><button type="button" class="btn btn-orange btn-lg rounded-pill px-4" onclick="demoNextStep(1,2)">{{ $siteContent['demo_next_button'] }} <i class="bi bi-arrow-right"></i></button></div>
                            </div>
                            <div class="demo-step" id="demoStep2">
<<<<<<< HEAD
                                <h3 class="h5 fw-bold mb-3">2. Choose a class style</h3>
                                <fieldset class="mb-3"><legend class="form-label fs-6">Choose how your child would like to learn</legend><div class="demo-mode-options"><label class="demo-mode-card"><input type="radio" name="teacherPref" value="1 on 1" checked><img src="{{ secure_asset('demo-one-to-one.png') }}" alt=""><span class="demo-mode-copy"><strong>One-on-one</strong><small>Personal attention in a focused lesson.</small></span></label><label class="demo-mode-card"><input type="radio" name="teacherPref" value="group"><img src="{{ secure_asset('demo-group-class.png') }}" alt=""><span class="demo-mode-copy"><strong>Group class</strong><small>Learn and share ideas with other students.</small></span></label></div></fieldset>
                                <label for="demoFeedback" class="form-label">Anything you’d like us to know? <span class="text-secondary">(optional)</span></label><textarea class="form-control mb-4" id="demoFeedback" rows="3" placeholder="Share a goal or learning preference"></textarea>
                                <div class="d-flex justify-content-between"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="demoPrevStep(2,1)">← Back</button><button type="button" class="btn btn-orange btn-lg rounded-pill px-4" onclick="demoNextStep(2,3)">Next <i class="bi bi-arrow-right"></i></button></div>
=======
                            <h3 class="h5 fw-bold mb-3">{{ $siteContent['demo_step_class_title'] }}</h3>
                                <fieldset class="mb-3"><legend class="form-label fs-6">{{ $siteContent['demo_class_style_question'] }}</legend><div class="demo-mode-options"><label class="demo-mode-card"><input type="radio" name="teacherPref" value="1 on 1" checked><img src="{{ $siteContent['demo_one_image'] }}" alt="{{ $siteContent['demo_one_title'] }} class"><span class="demo-mode-copy"><strong>{{ $siteContent['demo_one_title'] }}</strong><small>{{ $siteContent['demo_one_description'] }}</small></span></label><label class="demo-mode-card"><input type="radio" name="teacherPref" value="group"><img src="{{ $siteContent['demo_group_image'] }}" alt="{{ $siteContent['demo_group_title'] }}"><span class="demo-mode-copy"><strong>{{ $siteContent['demo_group_title'] }}</strong><small>{{ $siteContent['demo_group_description'] }}</small></span></label></div></fieldset>
                                <label for="demoFeedback" class="form-label">{{ $siteContent['demo_feedback_label'] }} <span class="text-secondary">{{ $siteContent['demo_optional_label'] }}</span></label><textarea class="form-control mb-4" id="demoFeedback" rows="3" placeholder="{{ $siteContent['demo_feedback_placeholder'] }}"></textarea>
                                <div class="d-flex justify-content-between"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="demoPrevStep(2,1)">{{ $siteContent['demo_back_button'] }}</button><button type="button" class="btn btn-orange btn-lg rounded-pill px-4" onclick="demoNextStep(2,3)">{{ $siteContent['demo_next_button'] }} <i class="bi bi-arrow-right"></i></button></div>
>>>>>>> c35d112 (Updated Hustle Wise website)
                            </div>
                            <div class="demo-step" id="demoStep3">
                                <h3 class="h5 fw-bold mb-3">{{ $siteContent['demo_step_level_title'] }}</h3>
                                <fieldset class="mb-4"><legend class="form-label fs-6">{{ $siteContent['demo_class_question'] }}</legend><div class="demo-class-select" id="demoClassOptions"><button type="button" class="demo-class-button" data-value="LKG">{{ $siteContent['demo_lkg_label'] }}</button><button type="button" class="demo-class-button" data-value="UKG">{{ $siteContent['demo_ukg_label'] }}</button>@for ($class = 1; $class <= 12; $class++)<button type="button" class="demo-class-button" data-value="Class {{ $class }}">{{ $siteContent['demo_class_prefix'] }} {{ $class }}</button>@endfor<button type="button" class="demo-class-button" data-value="Dropper">{{ $siteContent['demo_dropper_label'] }}</button><button type="button" class="demo-class-button" data-value="Adult">{{ $siteContent['demo_adult_label'] }}</button></div><input type="hidden" id="classSelect" value=""></fieldset>
                                <div class="row g-3 mb-4"><div class="col-md-6"><label for="dateSelect" class="form-label">{{ $siteContent['demo_preferred_day_label'] }}</label><select class="form-select" id="dateSelect" required><option value="">{{ $siteContent['demo_date_placeholder'] }}</option><option value="today">{{ $siteContent['demo_date_today'] }}</option><option value="tomorrow">{{ $siteContent['demo_date_tomorrow'] }}</option><option value="day_after">{{ $siteContent['demo_date_day_after'] }}</option></select></div><div class="col-md-6"><label for="timeSelect" class="form-label">{{ $siteContent['demo_preferred_time_label'] }}</label><input class="form-control" type="time" id="timeSelect" required></div></div>
                                <div class="d-flex justify-content-between"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="demoPrevStep(3,2)">{{ $siteContent['demo_back_button'] }}</button><button type="button" class="btn btn-orange btn-lg rounded-pill px-4" onclick="demoNextStep(3,4)">{{ $siteContent['demo_next_button'] }} <i class="bi bi-arrow-right"></i></button></div>
                            </div>
                            <div class="demo-step" id="demoStep4">
                                <h3 class="h5 fw-bold mb-3">{{ $siteContent['demo_step_contact_title'] }}</h3>
                                <label for="demoEmailInput" class="form-label">{{ $siteContent['demo_email_label'] }}</label><input class="form-control mb-4" type="email" id="demoEmailInput" placeholder="{{ $siteContent['demo_email_placeholder'] }}" required>
                                <div class="d-flex justify-content-between"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="demoPrevStep(4,3)">{{ $siteContent['demo_back_button'] }}</button><button type="button" class="btn btn-orange btn-lg rounded-pill px-4" onclick="demoNextStep(4,5)">{{ $siteContent['demo_next_button'] }} <i class="bi bi-arrow-right"></i></button></div>
                            </div>
                            <div class="demo-step" id="demoStep5">
                                <h3 class="h5 fw-bold mb-3">{{ $siteContent['demo_step_parent_title'] }}</h3>
                                <label for="parentName" class="form-label">{{ $siteContent['demo_parent_label'] }}</label><input class="form-control mb-3" id="parentName" type="text" placeholder="{{ $siteContent['demo_parent_placeholder'] }}" required>
                                <label for="MobileNumber" class="form-label">{{ $siteContent['demo_mobile_label'] }}</label><input class="form-control mb-3" id="MobileNumber" type="tel" inputmode="numeric" pattern="[0-9]{10}" minlength="10" maxlength="10" placeholder="{{ $siteContent['demo_mobile_placeholder'] }}" required>
                                <label for="childName" class="form-label">{{ $siteContent['demo_child_label'] }}</label><input class="form-control mb-4" id="childName" type="text" placeholder="{{ $siteContent['demo_child_placeholder'] }}" required>
                                <div class="d-flex justify-content-between"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="demoPrevStep(5,4)">{{ $siteContent['demo_back_button'] }}</button><button type="submit" class="btn btn-orange btn-lg rounded-pill px-4">{{ $siteContent['demo_submit_button'] }} <i class="bi bi-arrow-right"></i></button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 rounded-4 shadow"><div class="modal-body text-center p-5"><h4 class="fw-bold mb-3" id="modalTitle">{{ $siteContent['demo_alert_title'] }}</h4><p class="text-secondary mb-4 fs-5" id="modalMessage">{{ $siteContent['demo_alert_message'] }}</p><button type="button" class="btn btn-orange rounded-pill px-5" data-bs-dismiss="modal">{{ $siteContent['demo_continue_button'] }}</button></div></div></div></div>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD
    <script src="{{ secure_asset('script.js?v=submit-error-details') }}"></script>
=======
    <script src="/script.js?v=submit-error-details"></script>
    @php
        $demoPageCopy = [
            'classRequiredTitle' => $siteContent['demo_alert_class_title'],
            'classRequiredMessage' => $siteContent['demo_alert_class_message'],
            'successDynamicTitle' => $siteContent['demo_success_dynamic_title'],
            'oneToOneClassTitle' => $siteContent['demo_one_to_one_class_title'],
            'groupClassTitle' => $siteContent['demo_group_class_title'],
            'countdownNow' => $siteContent['demo_countdown_now'],
            'confirmedFormTitle' => $siteContent['demo_confirmed_form_title'],
            'confirmedFormDescription' => $siteContent['demo_confirmed_form_description'],
            'submitErrorTitle' => $siteContent['demo_submit_error_title'],
            'submitErrorMessage' => $siteContent['demo_submit_error_message'],
            'httpErrorMessage' => $siteContent['demo_http_error_message'],
            'serverErrorMessage' => $siteContent['demo_server_error_message'],
        ];
    @endphp
>>>>>>> c35d112 (Updated Hustle Wise website)
    <script>
        let currentDemoStep = 1;
        window.demoPageCopy = @json($demoPageCopy);
        document.querySelectorAll('#demoClassOptions .demo-class-button').forEach((button) => {
            button.addEventListener('click', () => {
                document.querySelectorAll('#demoClassOptions .demo-class-button').forEach((option) => option.classList.remove('selected'));
                button.classList.add('selected');
                document.getElementById('classSelect').value = button.dataset.value;
            });
        });
        function showAlert(title, message) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMessage').textContent = message;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('alertModal')).show();
        }
        function demoNextStep(current, next) {
            const step = document.getElementById(`demoStep${current}`);
            if (current === 3 && !document.getElementById('classSelect').value) {
                showAlert(window.demoPageCopy.classRequiredTitle, window.demoPageCopy.classRequiredMessage);
                return;
            }
            const required = step.querySelectorAll('input[required], select[required], textarea[required]');
            for (const field of required) { if (!field.checkValidity()) { field.reportValidity(); return; } }
            step.classList.remove('active');
            document.getElementById(`demoStep${next}`).classList.add('active');
            currentDemoStep = next;
            document.getElementById('progressBar').style.width = `${(next / 5) * 100}%`;
            document.getElementById(`demoStep${next}`).scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        function demoPrevStep(current, previous) {
            document.getElementById(`demoStep${current}`).classList.remove('active');
            document.getElementById(`demoStep${previous}`).classList.add('active');
            currentDemoStep = previous;
            document.getElementById('progressBar').style.width = `${(previous / 5) * 100}%`;
        }
    </script>
    @include('partials.demo_sticky_cta')
</body>
</html>
