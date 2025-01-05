<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\SettingService;

class SettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        return view('settings.index', ['settings' => $this->settingService->getAllSettings()]);
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $this->settingService->updateSetting($request->validated(), $setting);
        return redirect(route('settings.index'))->with('success', 'Successfully updated setting');
    }
}
