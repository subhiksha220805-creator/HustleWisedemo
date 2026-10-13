<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CourseAdminController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DemoBookingController;
use App\Http\Controllers\TeacherApplicationController;
use App\Http\Middleware\EnsureAdminAuthenticated;
use App\Models\Course;
use App\Models\DemoBooking;
use App\Models\TeacherApplication;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $catalog = CourseController::catalog();
    $courseOverrides = [];

    if (Schema::hasTable('courses')) {
        foreach (Course::query()->get() as $managedCourse) {
            $defaultCourse = $catalog[$managedCourse->slug] ?? null;
            if ($defaultCourse === null) {
                continue;
            }

            $changedFields = [];
            foreach ($defaultCourse as $field => $defaultValue) {
                if ($managedCourse->{$field} !== $defaultValue) {
                    $changedFields[$field] = $managedCourse->{$field};
                }
            }

            if (! $managedCourse->is_active) {
                $changedFields['is_active'] = false;
            }

            if ($changedFields !== []) {
                $courseOverrides[$managedCourse->slug] = $changedFields;
            }
        }
    }

    return view('index', ['courseOverrides' => $courseOverrides]);
});

Route::get('/book-demo', function () {
    return view('book_demo');
})->name('demo.book');
Route::post('/book-demo', [DemoBookingController::class, 'store']);
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/admin', function () {
    return redirect()->route(session('admin_authenticated') ? 'admin.dashboard' : 'admin.login');
});
Route::get('/admin/login', [CourseAdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [CourseAdminController::class, 'authenticate'])->middleware('throttle:5,1')->name('admin.authenticate');
Route::prefix('admin')->name('admin.')->middleware(EnsureAdminAuthenticated::class)->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/demo-bookings', [AdminDashboardController::class, 'demoBookings'])->name('demo-bookings.index');
    Route::get('/teacher-applications', [AdminDashboardController::class, 'teacherApplications'])->name('teacher-applications.index');
    Route::get('/content', [SiteContentController::class, 'index'])->name('content.index');
    Route::put('/content', [SiteContentController::class, 'update'])->name('content.update');
    Route::post('/logout', [CourseAdminController::class, 'logout'])->name('logout');
    Route::resource('courses', CourseAdminController::class)->except(['show']);
});
Route::delete('/demo-bookings/{demoBooking}', [DemoBookingController::class, 'destroy'])
    ->middleware(EnsureAdminAuthenticated::class)
    ->name('demo-bookings.destroy');

Route::get('/teacher-login', function () {
    return view('teacher_login');
})->name('teacher.join');
Route::post('/teacher-login', [TeacherApplicationController::class, 'store']);
Route::delete('/teacher-applications/{teacherApplication}', [TeacherApplicationController::class, 'destroy'])
    ->middleware(EnsureAdminAuthenticated::class)
    ->name('teacher-applications.destroy');

Route::get('/view-data', function () {
    return view('admin_data', [
        'demo_bookings' => DemoBooking::all(),
        'teacher_applications' => TeacherApplication::all(),
    ]);
})
    ->middleware(EnsureAdminAuthenticated::class)
    ->name('view-data');

Route::get('/view-resume/{id}', function ($id) {
    $application = TeacherApplication::findOrFail($id);
    if (! $application->resume_base64) {
        return abort(404, 'No resume found.');
    }

    $pdfData = base64_decode($application->resume_base64);

    return response($pdfData)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="'.str_replace(' ', '_', $application->first_name).'_resume.pdf"');
})
    ->middleware(EnsureAdminAuthenticated::class)
    ->name('view-resume');
