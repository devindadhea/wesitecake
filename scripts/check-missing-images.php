<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$missing = [];

$check = static function (string $table, int $id, string $field, ?string $value, array $paths) use (&$missing): void {
    if (empty($value)) {
        return;
    }

    foreach ($paths as $path) {
        if (file_exists($path)) {
            return;
        }
    }

    $missing[] = [
        'table' => $table,
        'id' => $id,
        'field' => $field,
        'value' => $value,
    ];
};

foreach (App\Models\HeroSection::all() as $row) {
    $check('hero_sections', $row->id, 'cake_image', $row->cake_image, [
        storage_path('app/public/' . $row->cake_image),
        public_path('images/' . basename((string) $row->cake_image)),
        public_path((string) $row->cake_image),
    ]);

    $check('hero_sections', $row->id, 'strawberry_left', $row->strawberry_left, [
        storage_path('app/public/' . $row->strawberry_left),
        public_path('images/' . basename((string) $row->strawberry_left)),
        public_path((string) $row->strawberry_left),
    ]);

    $check('hero_sections', $row->id, 'strawberry_right', $row->strawberry_right, [
        storage_path('app/public/' . $row->strawberry_right),
        public_path('images/' . basename((string) $row->strawberry_right)),
        public_path((string) $row->strawberry_right),
    ]);
}

foreach (App\Models\AboutSection::all() as $row) {
    $check('about_sections', $row->id, 'image', $row->image, [
        storage_path('app/public/' . $row->image),
        public_path('images/' . basename((string) $row->image)),
        public_path((string) $row->image),
    ]);
}

foreach (App\Models\Category::all() as $row) {
    $value = $row->image;
    if (empty($value)) {
        continue;
    }

    $withPrefix = str_starts_with($value, 'categories/') ? $value : 'categories/' . $value;

    $check('categories', $row->id, 'image', $value, [
        storage_path('app/public/' . $withPrefix),
        storage_path('app/public/' . $value),
        public_path('images/' . basename($value)),
        public_path($value),
    ]);
}

foreach (App\Models\Product::all() as $row) {
    $value = $row->image;
    if (empty($value)) {
        continue;
    }

    $check('products', $row->id, 'image', $value, [
        storage_path('app/public/' . $value),
        storage_path('app/public/products/' . $value),
        public_path('images/' . basename($value)),
        public_path($value),
    ]);
}

echo 'MISSING_COUNT=' . count($missing) . PHP_EOL;

foreach ($missing as $item) {
    echo sprintf(
        "%s#%d | %s | %s\n",
        $item['table'],
        $item['id'],
        $item['field'],
        $item['value']
    );
}
