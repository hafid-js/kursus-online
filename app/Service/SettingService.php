<?php

namespace App\Service;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{

    function getSettings(): array {
        return Cache::rememberForever('settings', function() {
            return Setting::pluck('value','key')->toArray();
        });
    }

    function setGlobalSettings() {
        $setting = $this->getSettings();
        config()->set('settings', $setting);
    }
}
