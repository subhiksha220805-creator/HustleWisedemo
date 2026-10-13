<?php

namespace App\Support;

use App\Models\ContentSetting;
use Illuminate\Support\Facades\Schema;
use Throwable;

class SiteContent
{
    /**
     * Flatten the configured site-content defaults into the view-friendly array
     * expected by the public pages.
     */
    public static function values(): array
    {
        $values = [];

        foreach (config('site-content.groups', []) as $group) {
            foreach ($group['fields'] ?? [] as $key => $field) {
                $values[$key] = $field['default'] ?? '';
            }
        }

        try {
            if (Schema::hasTable('content_settings')) {
                $saved = ContentSetting::query()->pluck('content_value', 'content_key')->all();
                $values = array_replace($values, $saved);
            }
        } catch (Throwable) {
            // Keep configured defaults available when the content table is not migrated yet.
        }

        return $values;
    }
}
