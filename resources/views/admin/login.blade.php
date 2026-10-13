@extends('admin.layout')
@section('title', 'Admin sign in')
@section('body')
<main class="login-wrap"><section class="panel login-card">
    <div class="brand d-flex align-items-center gap-2"><img src="{{ asset('logo.png') }}" alt="" width="38" height="38" style="object-fit:contain">Hustle<span>Wise</span></div>
    <h1>Welcome back</h1><p class="muted">Sign in to manage your courses.</p>
    @if ($errors->any())<div class="alert" style="background:#fff0ed;color:#a63b2d">{{ $errors->first() }}</div>@endif
    <form method="post" action="{{ route('admin.authenticate') }}">@csrf
        <div class="field"><label for="email">Admin email</label><input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"></div>
        <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password"></div>
        <button class="btn" type="submit">Sign in <i class="bi bi-arrow-right"></i></button>
    </form>
</section></main>
@endsection
