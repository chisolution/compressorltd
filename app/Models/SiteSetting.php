<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'description'
    ];

    protected $casts = [
        'value' => 'string'
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        // Handle different types
        switch ($setting->type) {
            case 'boolean':
                return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
            case 'json':
                return json_decode($setting->value, true);
            case 'integer':
                return (int) $setting->value;
            case 'float':
                return (float) $setting->value;
            default:
                return $setting->value;
        }
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $description = null)
    {
        // Handle different types
        switch ($type) {
            case 'boolean':
                $value = $value ? '1' : '0';
                break;
            case 'json':
                $value = json_encode($value);
                break;
            default:
                $value = (string) $value;
        }

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'description' => $description
            ]
        );
    }

    /**
     * Get all settings as key-value pairs
     */
    public static function all_settings()
    {
        $settings = static::all();
        $result = [];

        foreach ($settings as $setting) {
            $result[$setting->key] = static::get($setting->key);
        }

        return $result;
    }
}
