<?php

namespace App\Services;

use App\Models\SiteSetting;

class CompanyInfoService
{
    public static function get($key, $default = null)
    {
        try {
            $setting = SiteSetting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    public static function name()
    {
        return static::get('company_name', config('app.name'));
    }

    public static function tagline()
    {
        return static::get('company_tagline');
    }

    public static function email()
    {
        return static::get('company_email', config('mail.from.address'));
    }

    public static function phone()
    {
        return static::get('company_phone');
    }

    public static function address()
    {
        return static::get('company_address');
    }

    public static function logo()
    {
        return static::get('site_logo');
    }

    public static function whatsappNumber()
    {
        return static::get('whatsapp_number');
    }
}
