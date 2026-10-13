<?php

namespace App\Support;

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

        return $values;
    }
}
