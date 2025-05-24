<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Models\Branch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share site settings with all views
        if (Schema::hasTable('site_settings')) {
            try {
                $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
                
                // Process boolean values
                foreach ($settings as $key => $value) {
                    $setting = SiteSetting::where('key', $key)->first();
                    if ($setting && $setting->type === 'boolean') {
                        $settings[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                    }
                }
                
                View::share('siteSettings', $settings);
            } catch (\Exception $e) {
                // Handle case where settings table doesn't exist yet
                View::share('siteSettings', []);
            }
        }

        // Share active branches with all views
        if (Schema::hasTable('branches')) {
            try {
                $branches = Branch::active()->sorted()->get();
                View::share('branches', $branches);
            } catch (\Exception $e) {
                View::share('branches', collect());
            }
        }

        // Create helper functions
        if (!function_exists('site_setting')) {
            function site_setting($key, $default = null) {
                return SiteSetting::get($key, $default);
            }
        }

        if (!function_exists('company_name')) {
            function company_name() {
                return SiteSetting::get('company_name', config('app.name'));
            }
        }

        if (!function_exists('currency_symbol')) {
            function currency_symbol() {
                return SiteSetting::get('currency_symbol', 'R');
            }
        }

        if (!function_exists('format_price')) {
            function format_price($amount) {
                $symbol = SiteSetting::get('currency_symbol', 'R');
                return $symbol . ' ' . number_format($amount, 2);
            }
        }
    }
}
