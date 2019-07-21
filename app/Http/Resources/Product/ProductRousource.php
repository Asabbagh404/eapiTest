<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductRousource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock'=> $this->stock > 0 ? $this->stock : 'Not available yet',
            'discount' => $this->discount,
            'percetageDiscount' => $this->discount . '%',
            'finalPrice' => round($this->price*(1-$this->discount/100)),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2): 'No rating yet',
            'href' =>
            [
                'reviews' => route('reviews.index', $this->id)
            ]

        ];
    }
}
