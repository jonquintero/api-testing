<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Request;


class ProductController extends Controller
{
    public function __invoke()
    {
       /* dd(Product::query()
               ->filter(Request::only('name', 'category', 'sku'))->get());*/
        return  ProductResource::collection(Product::query()
            ->filter(Request::only('name', 'category', 'sku'))
            ->paginate(15)
            ->withQueryString());
    }
}
