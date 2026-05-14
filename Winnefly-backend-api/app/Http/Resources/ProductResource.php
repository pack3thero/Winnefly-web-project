<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => (string) $this->id,
                'type' => 'products',
                'attributes' => [
                    'name' => $this->name,
                    'description' => $this->description,
                    'price' => (float) $this->price,
                    'stock' => (int) $this->stock,
                    'image_url' => $this->image
                        ? asset('storage/'.$this->image)
                        : null,
                    'category' => [
                        'id' => $this->category?->id,
                        'name' => $this->category?->name,
                    ],
                    'created'  => $this->created_at->toDateTimeString(),
                 ],
            ],
        ];
    }
}
