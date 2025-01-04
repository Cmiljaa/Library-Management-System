<?php 

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    public function getSettingValue(string $key)
    {
        $setting = Setting::where('key', $key)->first();

        if(!$setting)
        {
            return null;
        }

        switch ($setting->type) {
            case 'integer':
                return (int) $setting->value;

            case 'boolean':
                    return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);

            default:
                return $setting->value;
        }

    }
}