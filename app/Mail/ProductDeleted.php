<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public array $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('produtos@gerencia.com')
            ->to(
                config('mail.email_system')
            )->view('emails.productDeleted')
            ->with([
                'productName' => $this->product['name'],
            ]);
    }
}
