<?php declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class Cache
{
    public static function has(string $key): bool
    {
        $cacheFile = self::getCacheFilePath($key);
        if (!file_exists($cacheFile)) {
            return false;
        }

        $content = json_decode(file_get_contents($cacheFile));
        return Carbon::parse($content->expires_at)->gt(Carbon::now());
    }

    public static function save(string $key, string $content, int $ttl = 120): void
    {
        $cacheFile = self::getCacheFilePath($key);
        file_put_contents($cacheFile, json_encode([
            'expires_at' => Carbon::now()->addSeconds($ttl),
            'content' => $content
        ]));
    }

    public static function get(string $key): string
    {
        $cacheFile = self::getCacheFilePath($key);
        $content = json_decode(file_get_contents($cacheFile));
        return $content->content;
    }

    private static function getCacheFilePath(string $key): string
    {
        $hashedKey = md5($key); // Generate an MD5 hash of the cache key
        return '../cache/' . $hashedKey;
    }
}
