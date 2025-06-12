<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Services\ImageService;

class SiteSettingController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display site settings form
     */
    public function index()
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update site settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'nullable|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'currency_code' => 'required|string|max:10',
            'company_phone' => 'nullable|string|max:50',
            'company_email' => 'nullable|email|max:255',
            'company_address' => 'nullable|string',
            'about_us_content' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:50',
            'delivery_nationwide' => 'boolean',
            'whatsapp_enabled' => 'boolean',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:1024',
            'contact_form_emails' => 'nullable|string',
            'quote_request_emails' => 'nullable|string',
        ]);

        // Handle text settings
        $textSettings = [
            'site_title', 'company_name', 'company_tagline', 'currency_symbol',
            'currency_code', 'company_phone', 'company_email', 'company_address', 'about_us_content', 'whatsapp_number'
        ];

        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key), 'text');
            }
        }

        // Handle boolean settings
        SiteSetting::set('delivery_nationwide', $request->has('delivery_nationwide'), 'boolean');
        SiteSetting::set('whatsapp_enabled', $request->has('whatsapp_enabled'), 'boolean');

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $this->handleImageUpload($request->file('site_logo'), 'site_logo', [300, 100]);
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = $this->imageService->uploadImage($request->file('site_favicon'), 'settings');
            $faviconWebPPath = $this->imageService->convertToWebP($faviconPath);
            SiteSetting::set('site_favicon', $faviconWebPPath, 'image');
        }

        // Handle email settings
        if ($request->has('contact_form_emails')) {
            SiteSetting::set('contact_form_emails', $request->input('contact_form_emails'), 'text');
        }
        if ($request->has('quote_request_emails')) {
            SiteSetting::set('quote_request_emails', $request->input('quote_request_emails'), 'text');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Site settings updated successfully.');
    }

    /**
     * Handle image upload and resizing
     */
    private function handleImageUpload($file, $settingKey, $dimensions = null)
    {
        // Delete old image if exists
        $oldImage = SiteSetting::get($settingKey);
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        // Store new image
        $path = $file->store('settings', 'public');

        // Resize if dimensions provided
        if ($dimensions) {
            $fullPath = storage_path('app/public/' . $path);
            $manager = new ImageManager(new Driver());
            $image = $manager->read($fullPath);
            $image->resize($dimensions[0], $dimensions[1]);
            $image->save($fullPath);
        }

        SiteSetting::set($settingKey, $path, 'image');
        return $path;
    }

}
