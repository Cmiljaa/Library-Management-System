<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        return view('settings.index', ['settings' => $this->settingsService->getAllSettings()]);
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $this->settingsService->updateSetting($request->validated(), $setting);
        return redirect(route('settings.index'))->with('success', 'Successfully updated setting');
    }
}
