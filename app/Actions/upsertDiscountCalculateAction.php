<?php

namespace App\Actions;

use App\Const\DiscountConst;

trait upsertDiscountCalculateAction
{
    public function execute(): mixed
    {
        if(str_contains($this->category->name, 'insurance')){

            return $this->price - ($this->price * DiscountConst::INSURANCE);
        }
        if ($this->sku->code === '000003'){
            return $this->price - ($this->price * DiscountConst::SKU);
        }
        return $this->price;
    }
}
