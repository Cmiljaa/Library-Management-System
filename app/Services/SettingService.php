<?php 

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getSettingValue(string $key): null|int|bool|string
    {
        $setting = Setting::where('key', $key)->first();

        if(!$setting)
        {
            abort(400, "Setting with key '{$key}' not found");
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

    public function getAllSettings()
    {
        return Setting::latest()->paginate();
    }

    public function updateSetting(array $credentials, Setting $setting): void
    {
        $setting->update($credentials);
    }
}