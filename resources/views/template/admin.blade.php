<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · HustleWise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root{--ink:#20262e;--muted:#77808a;--orange:#ff7a00;--line:#e9ecef;--paper:#fffaf5}*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font:15px 'DM Sans',sans-serif}#wrapper{display:flex!important;min-height:100vh}#sidebar-wrapper{width:300px;min-height:100vh;margin-left:0;flex:0 0 300px;transition:margin .25s ease-out;background:#fff}#page-content-wrapper{min-width:0;flex:1;width:calc(100% - 300px)}body.sb-sidenav-toggled #sidebar-wrapper{margin-left:-300px}.sidebar{width:100%;background:#fff;color:var(--ink);padding:26px 16px;min-height:100vh}.brand{font:800 21px Manrope,sans-serif;padding:0 13px 32px}.brand span{color:var(--orange)}.nav-label{padding:8px 13px;color:#949da8;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase}.nav-link{display:flex;align-items:center;gap:12px;padding:12px 13px;border-radius:10px;color:#555e68;text-decoration:none;margin:3px 0}.nav-link.active,.nav-link:hover{background:#fff2e5;color:#693800}.nav-link.active i{color:var(--orange)}.nav-link.disabled{opacity:.55;cursor:not-allowed}.coming-soon{margin-left:auto;font-size:10px;color:#929aa3}.main{min-height:100vh;min-width:0;flex:1}.topbar{height:74px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(20px,4vw,56px)}.admin-user{color:var(--muted);font-size:13px}.content{max-width:1180px;margin:0 auto;padding:36px clamp(20px,4vw,56px)}h1,h2,h3{font-family:Manrope,sans-serif}h1{font-size:28px;margin:0 0 7px}.muted{color:var(--muted)}.heading{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:26px}.btn{display:inline-flex;align-items:center;gap:8px;border:0;border-radius:9px;background:var(--orange);color:white;padding:11px 16px;font:700 14px 'DM Sans';text-decoration:none;cursor:pointer}.btn:hover{background:#e56800;color:white}.btn-light{background:#fff;border:1px solid var(--line);color:var(--ink)}.btn-danger{background:#fff1ee;color:#be4635;border:1px solid #f5d1ca}.panel{background:#fff;border:1px solid var(--line);border-radius:15px;box-shadow:0 4px 16px #252d3808}.course-table{width:100%;border-collapse:collapse}.course-table th,.course-table td{text-align:left;padding:17px 20px;border-bottom:1px solid #f0f1f3}.course-table th{font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);font-weight:700}.course-table tr:last-child td{border-bottom:0}.course-name{display:flex;align-items:center;gap:12px;font-weight:700}.course-icon{width:39px;height:39px;border-radius:12px;background:#fff5ed;display:grid;place-items:center;color:var(--orange);font-size:18px}.pill{display:inline-block;border-radius:99px;background:#eaf7ef;color:#318452;padding:5px 10px;font-size:12px;font-weight:700}.pill.off{background:#f0f1f3;color:#68727c}.actions{display:flex;gap:8px;align-items:center}.form-panel{padding:26px}.grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.field{display:flex;flex-direction:column;gap:7px}.field.full{grid-column:1/-1}label{font-size:13px;font-weight:700}input,textarea{width:100%;border:1px solid #dfe3e7;border-radius:9px;padding:11px 12px;font:14px 'DM Sans';color:var(--ink);background:#fff}input:focus,textarea:focus{outline:3px solid #ff7a0025;border-color:var(--orange)}textarea{min-height:112px;resize:vertical}.help{color:var(--muted);font-size:12px;line-height:1.5}.check{display:flex;align-items:center;gap:9px}.check input{width:auto}.alert{border-radius:10px;padding:13px 16px;margin:0 0 18px;background:#eaf7ef;color:#267244}.errors{color:#ba3524;font-size:12px}@media(max-width:760px){#sidebar-wrapper{width:246px;flex-basis:246px}body.sb-sidenav-toggled #sidebar-wrapper{margin-left:-246px}#page-content-wrapper{width:100%}.sidebar{padding:20px 12px}.content{padding:25px 18px}.heading{align-items:flex-start;flex-direction:column}.panel{overflow-x:auto}.course-table{min-width:650px}.grid{grid-template-columns:1fr}.field.full{grid-column:auto}}
    </style>
</head>
<body>
<div id="wrapper">
    <aside id="sidebar-wrapper" aria-label="Admin navigation">
        <div class="sidebar">
            <div class="brand">Hustle<span>Wise</span></div>
            <div class="nav-label">Manage</div>
            <a class="nav-link disabled" aria-disabled="true"><i class="bi bi-grid-1x2-fill"></i>Dashboard<span class="coming-soon">Soon</span></a>
            <a class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" href="{{ route('admin.courses.index') }}"><i class="bi bi-mortarboard-fill"></i>Courses</a>
            <a class="nav-link disabled" aria-disabled="true"><i class="bi bi-calendar-check"></i>Demo bookings<span class="coming-soon">Soon</span></a>
            <a class="nav-link disabled" aria-disabled="true"><i class="bi bi-person-workspace"></i>Teacher applications<span class="coming-soon">Soon</span></a>
            <div class="nav-label" style="margin-top:20px">Website</div>
            <a class="nav-link disabled" aria-disabled="true"><i class="bi bi-window"></i>Home page<span class="coming-soon">Soon</span></a>
        </div>
    </aside>
    <main class="main" id="page-content-wrapper">
        <header class="topbar">
            <button class="btn btn-light" id="sidebarToggle" type="button" aria-label="Toggle navigation"><i class="bi bi-list"></i></button>
            <form method="post" action="{{ route('admin.logout') }}" style="display:flex;align-items:center;gap:18px">@csrf<span class="admin-user"><i class="bi bi-shield-lock me-1"></i> Administrator</span><button class="btn btn-light" type="submit">Sign out</button></form>
        </header>
        <section class="content">
            @yield('body')
        </section>
    </main>
</div>
<script src="{{ asset('admin/js/scripts.js') }}"></script>
</body>
</html>
