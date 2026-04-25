<?php

namespace App\Support;

class ImageUrlResolver
{
  public static function resolve(?string $path, ?string $publicDefault = null, string $placeholderLabel = 'Image'): string
{
    // Jika path kosong
    if (empty($path)) {
        if (!empty($publicDefault)) {
            return asset($publicDefault);
        }
        return self::placeholder($placeholderLabel);
    }

    // Jika path sudah mengandung 'images/', langsung gunakan
    if (str_starts_with($path, 'images/')) {
        if (file_exists(public_path($path))) {
            return asset($path);
        }
    }

    // Jika path mengandung 'about/', 'categories/', 'products/', 'hero/', dll
    // Ambil nama file saja dan arahkan ke images/
    $filename = basename($path);
    $newPath = 'images/' . $filename;
    
    if (file_exists(public_path($newPath))) {
        return asset($newPath);
    }

    // Fallback ke default
    if (!empty($publicDefault)) {
        return asset($publicDefault);
    }

    return self::placeholder($placeholderLabel);
}

    private static function placeholder(string $label): string
    {
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#fce7f3" />
      <stop offset="100%" stop-color="#fbcfe8" />
    </linearGradient>
  </defs>
  <rect width="800" height="600" fill="url(#bg)" />
  <g fill="none" stroke="#be185d" stroke-width="10" opacity="0.35">
    <rect x="190" y="140" width="420" height="320" rx="20" />
    <path d="M220 420 L330 300 L420 370 L490 300 L580 390" />
    <circle cx="320" cy="235" r="35" />
  </g>
  <text x="400" y="515" text-anchor="middle" fill="#9d174d" font-size="34" font-family="Arial, sans-serif">{$safeLabel}</text>
</svg>
SVG;

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}