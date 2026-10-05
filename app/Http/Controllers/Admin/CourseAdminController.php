<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CourseController as PublicCourseController;
use App\Models\Course;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CourseAdminController extends Controller
{
    public function login(): View
    {
        return view('admin.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $adminEmail = (string) config('admin.email');
        $adminPassword = (string) config('admin.password');
        $passwordMatches = str_starts_with($adminPassword, '$2y$')
            ? Hash::check($credentials['password'], $adminPassword)
            : hash_equals($adminPassword, $credentials['password']);

        if ($adminEmail === '' || $adminPassword === '' || ! hash_equals(strtolower($adminEmail), strtolower($credentials['email'])) || ! $passwordMatches) {
            return back()->withErrors(['email' => 'Those admin credentials do not match.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->route('admin.courses.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function index(): View
    {
        if (! Schema::hasTable('courses')) {
            return view('admin.courses.setup');
        }

        foreach (PublicCourseController::catalog() as $slug => $course) {
            Course::firstOrCreate(['slug' => $slug], $course + ['slug' => $slug]);
        }

        return view('admin.courses.index', ['courses' => Course::orderBy('title')->get()]);
    }

    public function create(): View
    {
        return view('admin.courses.form', ['course' => new Course, 'isEditing' => false]);
    }

    public function store(Request $request): RedirectResponse
    {
        $course = Course::create($this->validatedCourse($request));

        return redirect()->route('admin.courses.edit', $course)->with('success', 'Course created.');
    }

    public function edit(Course $course): View
    {
        return view('admin.courses.form', ['course' => $course, 'isEditing' => true]);
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $course->update($this->validatedCourse($request, $course));

        return redirect()->route('admin.courses.edit', $course)->with('success', 'Course changes saved.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->update(['is_active' => false]);

        return redirect()->route('admin.courses.index')->with('success', 'Course archived.');
    }

    private function validatedCourse(Request $request, ?Course $course = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'alpha_dash', 'max:140', Rule::unique('courses', 'slug')->ignore($course)],
            'icon' => ['required', 'string', 'max:80'],
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'image' => [
                'nullable',
                'string',
                'max:2048',
                function (string $attribute, mixed $value, Closure $fail): void {
                    if ($value === null || $value === '') {
                        return;
                    }

                    $localImagePath = is_string($value)
                        && str_starts_with($value, '/images/')
                        && ! str_contains($value, '..')
                        && is_file(public_path($value));
                    $remoteImageUrl = is_string($value)
                        && filter_var($value, FILTER_VALIDATE_URL) !== false
                        && in_array(strtolower((string) parse_url($value, PHP_URL_SCHEME)), ['http', 'https'], true);

                    if (! $localImagePath && ! $remoteImageUrl) {
                        $fail('Use a valid HTTPS image URL or an image stored under public/images.');
                    }
                },
            ],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:3000'],
            'grades_json' => ['required', 'json'],
            'roadmap_json' => ['required', 'json'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($course !== null && $validated['slug'] !== $course->slug) {
            throw ValidationException::withMessages([
                'slug' => 'Course page addresses cannot be changed after creation.',
            ]);
        }

        $grades = json_decode($validated['grades_json'], true);
        $roadmap = json_decode($validated['roadmap_json'], true);
        if (! is_array($grades) || $grades === [] || ! is_array($roadmap)) {
            throw ValidationException::withMessages([
                'grades_json' => 'Enter valid JSON with at least one grade and a roadmap object.',
            ]);
        }

        foreach ($grades as $grade) {
            if (! is_string($grade) || trim($grade) === '' || ! isset($roadmap[$grade]) || ! is_array($roadmap[$grade])) {
                throw ValidationException::withMessages([
                    'roadmap_json' => 'Add a list of roadmap topics for every grade listed in Grades.',
                ]);
            }
            foreach ($roadmap[$grade] as $topic) {
                if (! is_string($topic) || trim($topic) === '') {
                    throw ValidationException::withMessages([
                        'roadmap_json' => 'Roadmap topics must be non-empty text.',
                    ]);
                }
            }
        }

        return [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'icon' => $validated['icon'],
            'color' => $validated['color'],
            'image' => $validated['image'] ?? null,
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
            'grades' => array_values($grades),
            'roadmap' => $roadmap,
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
