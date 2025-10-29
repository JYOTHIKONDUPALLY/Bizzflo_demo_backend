<?php

namespace App\Domains\Product\DataTransferObjects;

class ProductData
{
    public function __construct(
        public string $tenant_id,
        public string $name,
        public string $sku,
        public string $category_id,
        public string $brand,
        public float $base_price,
        public float $cost_price,
        public ?string $description,
        public ?string $image_url,
        public ?string $weight,
        public ?string $dimensions,
        public string $tax_rate_id
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['tenant_id'],
            $data['name'],
            $data['sku'],
            $data['category_id'],
            $data['brand'],
            $data['base_price'],
            $data['cost_price'],
            $data['description'] ?? null,
            $data['image_url'] ?? null,
            $data['weight'] ?? null,
            $data['dimensions'] ?? null,
            $data['tax_rate_id']
        );
    }
}
?>
