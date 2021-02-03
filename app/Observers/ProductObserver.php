<?php

namespace App\Observers;

use App\Jobs\SendEmail;
use App\Mail\ProductCreated;
use App\Mail\ProductDeleted;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        SendEmail::dispatch(
            new ProductCreated($product)
        );
    }
}
