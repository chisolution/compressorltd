<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default site settings
        $settings = [
            [
                'key' => 'site_title',
                'value' => 'Compressor Ltd',
                'type' => 'text',
                'description' => 'Main site title displayed in browser tab'
            ],
            [
                'key' => 'company_name',
                'value' => 'Compressor Ltd',
                'type' => 'text',
                'description' => 'Company name used throughout the website'
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Quality Power & Compression Solutions',
                'type' => 'text',
                'description' => 'Company tagline or slogan'
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'description' => 'Main site logo'
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'image',
                'description' => 'Site favicon (.ico file)'
            ],
            [
                'key' => 'currency_symbol',
                'value' => 'R',
                'type' => 'text',
                'description' => 'Currency symbol (South African Rand)'
            ],
            [
                'key' => 'currency_code',
                'value' => 'ZAR',
                'type' => 'text',
                'description' => 'Currency code'
            ],
            [
                'key' => 'delivery_nationwide',
                'value' => '1',
                'type' => 'boolean',
                'description' => 'Whether company delivers nationwide'
            ],
            [
                'key' => 'company_phone',
                'value' => '+27 11 123 4567',
                'type' => 'text',
                'description' => 'Main company phone number'
            ],
            [
                'key' => 'company_email',
                'value' => 'info@compressorltd.co.za',
                'type' => 'text',
                'description' => 'Main company email address'
            ],
            [
                'key' => 'company_address',
                'value' => '123 Industrial Avenue, Business District, Johannesburg, 2001',
                'type' => 'text',
                'description' => 'Main company address'
            ],
            [
                'key' => 'about_us_content',
                'value' => 'Founded in 2016, we have grown to become a leading supplier of industrial and commercial compressors, generators, and inverters across South Africa.',
                'type' => 'textarea',
                'description' => 'About us content for homepage and about page'
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        // Default branches
        $branches = [
            [
                'name' => 'Cape Town Branch',
                'city' => 'Cape Town',
                'province' => 'Western Cape',
                'address' => '45 Industrial Road, Paarden Eiland',
                'phone' => '+27 21 555 0123',
                'email' => 'capetown@compressorltd.co.za',
                'manager_name' => 'John Smith',
                'operating_hours' => 'Mon-Fri: 8:00 AM - 5:00 PM, Sat: 8:00 AM - 1:00 PM',
                'latitude' => -33.8688,
                'longitude' => 18.4241,
                'active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Johannesburg Head Office',
                'city' => 'Johannesburg',
                'province' => 'Gauteng',
                'address' => '123 Industrial Avenue, Business District',
                'phone' => '+27 11 123 4567',
                'email' => 'jhb@compressorltd.co.za',
                'manager_name' => 'Sarah Johnson',
                'operating_hours' => 'Mon-Fri: 7:30 AM - 5:30 PM, Sat: 8:00 AM - 2:00 PM',
                'latitude' => -26.2041,
                'longitude' => 28.0473,
                'active' => true,
                'sort_order' => 0
            ]
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['name' => $branch['name']],
                $branch
            );
        }
    }
}
