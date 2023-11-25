<?php

namespace Webkul\BookingProduct\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Webkul\BookingProduct\Contracts\BookingProductEventTicket as BookingProductEventTicketContract;
use Webkul\BookingProduct\Database\Factories\BookingProductEventTicketFactory;
use Webkul\Core\Eloquent\TranslatableModel;

class BookingProductEventTicket extends TranslatableModel implements BookingProductEventTicketContract
{
    use HasFactory;

    public $timestamps = false;

    public $translatedAttributes = [
        'name',
        'description',
    ];

    protected $fillable = [
        'price',
        'qty',
        'special_price',
        'special_price_from',
        'special_price_to',
        'booking_product_id',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return BookingProductEventTicketFactory::new();
    }
}
