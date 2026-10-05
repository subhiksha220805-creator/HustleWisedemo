@extends('template.admin')
@section('title', 'Set up courses')
@section('body')
<div class="heading"><div><h1>One setup step left</h1><div class="muted">The course database table hasn’t been created yet.</div></div></div>
<div class="panel form-panel"><p>Run the Laravel database migration from your project folder, then refresh this page:</p><p><code>php artisan migrate</code></p></div>
@endsection
