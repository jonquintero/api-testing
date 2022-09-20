<?php

namespace App\Http\Resources;

use App\Actions\upsertDiscountCalculateAction;
use App\Actions\upsertDiscountPercentageAction;
use App\Const\DiscountConst;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use upsertDiscountCalculateAction, upsertDiscountPercentageAction;

    public function toArray($request): array
    {
      //  dd($this->category->name);
        return [
            "sku" => $this->sku->code,
            "name" => $this->name,
            "category" => $this->category->name,
            "price" => [
                "original" => $this->price,
                "final" =>  $this->execute(),
                "discount_percentage" => $this->executePercentage(),
                "currency" => "EUR"
            ]
        ];
    }


}
