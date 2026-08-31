<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class TrackingSetting extends Model
{
    protected $table = 'tracking_settings';

    protected $fillable = [
        'key',
        'value',
        'is_encrypted'
    ];

    /**
     * Cache for in-memory settings within the request lifecycle.
     *
     * @var array|null
     */
    protected static $cachedSettings = null;

    /**
     * List of keys that should be encrypted by default.
     *
     * @var array
     */
    protected static $encryptedKeys = [
        'ga4_api_secret',
        'meta_capi_token',
    ];

    /**
     * Get a setting by key with optional fallback.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $settings = static::getAllSettings();

        if (!array_key_exists($key, $settings)) {
            return $default;
        }

        return $settings[$key];
    }

    /**
     * Set a setting value.
     *
     * @param string $key
     * @param mixed $value
     * @param bool|null $encrypt
     * @return static
     */
    public static function set($key, $value, $encrypt = null)
    {
        if ($encrypt === null) {
            $encrypt = in_array($key, static::$encryptedKeys);
        }

        $storedValue = $value;
        if ($encrypt && !empty($value)) {
            try {
                $storedValue = Crypt::encryptString((string)$value);
            } catch (\Exception $e) {
                Log::error("Failed to encrypt tracking setting '{$key}': " . $e->getMessage());
            }
        }

        $record = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $storedValue,
                'is_encrypted' => (bool)$encrypt
            ]
        );

        // Reset in-memory cache
        static::$cachedSettings = null;

        return $record;
    }

    /**
     * Get all settings as a key-value associative array.
     *
     * @return array
     */
    public static function getAllSettings()
    {
        if (static::$cachedSettings !== null) {
            return static::$cachedSettings;
        }

        $all = [];
        try {
            $records = static::all();
            foreach ($records as $record) {
                $val = $record->value;
                if ($record->is_encrypted && !empty($val)) {
                    try {
                        $val = Crypt::decryptString($val);
                    } catch (\Exception $e) {
                        // Return raw value if decryption fails or was stored unencrypted previously
                        $val = $record->value;
                    }
                }
                $all[$record->key] = $val;
            }
        } catch (\Exception $e) {
            // In case table does not exist yet during migration
            $all = [];
        }

        static::$cachedSettings = $all;
        return $all;
    }

    /**
     * Clear cached settings.
     */
    public static function clearCache()
    {
        static::$cachedSettings = null;
    }
}
