<footer class="py-5" style="background:#fff;border-top:4px solid #ff7e27">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="{{ url('/') }}" class="h3 fw-bold text-decoration-none brand-wordmark"><span class="brand-hustle" style="color:#20262e">Hustle</span><span class="brand-wise" style="color:#ff7a00">Wise</span></a>
                <p class="text-secondary mt-3">{{ $siteContent['footer_description'] }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold">{{ $siteContent['footer_quick_links_title'] }}</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><a href="{{ url('/') }}#home" class="text-secondary text-decoration-none">{{ $siteContent['nav_home'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['nav_courses'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#activities" class="text-secondary text-decoration-none">{{ $siteContent['nav_activities'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#joiners" class="text-secondary text-decoration-none">{{ $siteContent['nav_teach'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#testimonials" class="text-secondary text-decoration-none">{{ $siteContent['nav_testimonials'] }}</a></li>
                    <li class="mb-2"><a href="{{ route('demo.book') }}" class="text-secondary text-decoration-none">{{ $siteContent['nav_demo'] }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold">{{ $siteContent['footer_courses_title'] }}</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_public_speaking'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_creative_writing'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_coding'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_english'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_maths'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_business_english'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_music'] }}</a></li>
                    <li class="mb-2"><a href="{{ url('/') }}#courses" class="text-secondary text-decoration-none">{{ $siteContent['footer_course_spoken_english'] }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold">{{ $siteContent['footer_contact_title'] }}</h5>
                <p class="text-secondary mt-3"><i class="bi bi-geo-alt-fill me-2" style="color:#ff7e27"></i>{{ $siteContent['footer_address'] }}</p>
                <p><a href="mailto:{{ $siteContent['footer_email'] }}" class="text-secondary text-decoration-none"><i class="bi bi-envelope-fill me-2" style="color:#ff7e27"></i>{{ $siteContent['footer_email'] }}</a></p>
                <p><a href="tel:{{ preg_replace('/[^0-9+]/', '', explode(',', $siteContent['footer_phone'])[0]) }}" class="text-secondary text-decoration-none"><i class="bi bi-telephone-fill me-2" style="color:#ff7e27"></i>{{ $siteContent['footer_phone'] }}</a></p>
                <div class="mt-4 d-flex gap-3 fs-3">
                    <a href="{{ $siteContent['footer_linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn" style="color:#0A66C2"><i class="bi bi-linkedin"></i></a>
                    <a href="{{ $siteContent['footer_whatsapp'] }}" target="_blank" rel="noopener" aria-label="WhatsApp" style="color:#25D366"><i class="bi bi-whatsapp"></i></a>
                    <a href="{{ $siteContent['footer_instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" style="color:#E4405F"><i class="bi bi-instagram"></i></a>
                    <a href="{{ $siteContent['footer_facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook" style="color:#1877F2"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $siteContent['footer_youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube" style="color:#F00"><i class="bi bi-youtube"></i></a>
                    <a href="{{ $siteContent['footer_maps'] }}" target="_blank" rel="noopener" aria-label="Find us" style="color:#EA4335"><i class="bi bi-geo-alt-fill"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <p class="text-center text-secondary mb-0">{{ $siteContent['footer_copyright'] }}</p>
    </div>
</footer>
