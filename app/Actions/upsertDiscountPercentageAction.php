<?php

namespace App\Actions;

use App\Const\DiscountConst;

trait upsertDiscountPercentageAction
{
    public function executePercentage(): ?string
    {
        if(str_contains($this->category->name, 'insurance')){

            return (DiscountConst::INSURANCE * 100)."%";
        }
        if ($this->sku->code === '000003'){
            return (DiscountConst::SKU * 100)."%";
        }
        return null;
    }
}
