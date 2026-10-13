<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentSetting;
use App\Support\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteContentController extends Controller
{
    private const TABS = [
        'navigation' => ['label' => 'Navigation', 'groups' => ['Site header and navigation']],
        'home' => ['label' => 'Home page', 'groups' => ['Hero section', 'About section', 'Learning sections', 'Teacher section']],
        'activities' => ['label' => 'Activities', 'groups' => ['Activities']],
        'testimonials' => ['label' => 'Testimonials', 'groups' => ['Testimonials and final banner']],
        'footer' => ['label' => 'Footer', 'groups' => ['Footer and contact']],
        'demo' => ['label' => 'Book your demo page', 'groups' => ['Demo booking page']],
        'teacher' => ['label' => 'Teacher application page', 'groups' => ['Teacher page']],
    ];

    public function index(): View
    {
        $configuredGroups = config('site-content.groups', []);
        $tabs = [];

        foreach (self::TABS as $key => $tab) {
            $tabs[$key] = [
                'label' => $tab['label'],
                'groups' => array_intersect_key($configuredGroups, array_flip($tab['groups'])),
            ];
        }

        return view('admin.site-content', [
            'tabs' => $tabs,
            'content' => SiteContent::values(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $fields = [];
        foreach (config('site-content.groups', []) as $group) {
            $fields += $group['fields'] ?? [];
        }

        $rules = [];
        $uploads = [];
        foreach ($fields as $key => $field) {
            $rules['content.'.$key] = ['nullable', 'string', 'max:10000'];

            $type = $field['type'] ?? 'text';
            if ($type === 'image') {
                $rules['uploads.'.$key] = ['nullable', 'file', 'image', 'max:20480'];
                $uploads[$key] = 'site-content/images';
            } elseif ($type === 'video') {
                $rules['uploads.'.$key] = ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/webm,video/x-msvideo', 'max:51200'];
                $uploads[$key] = 'site-content/videos';
            }
        }

        $validated = $request->validate($rules);
        $values = $validated['content'] ?? [];

        foreach ($uploads as $key => $directory) {
            if ($request->hasFile('uploads.'.$key)) {
                $path = $request->file('uploads.'.$key)->store($directory, 'public');
                $values[$key] = '/storage/'.$path;
            }
        }

        DB::transaction(function () use ($values, $fields): void {
            foreach ($fields as $key => $field) {
                if (! array_key_exists($key, $values)) {
                    continue;
                }

                ContentSetting::query()->updateOrCreate(
                    ['content_key' => $key],
                    ['content_value' => $values[$key] ?? ''],
                );
            }
        });

        return redirect()
            ->route('admin.content.index', ['tab' => $request->input('active_tab', 'navigation')])
            ->with('success', 'Website content saved.');
    }
}
