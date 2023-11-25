<?php

namespace Webkul\Sales\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webkul\Inventory\Models\InventorySource;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Sales\Models\Shipment;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $address = OrderAddress::factory()->create();

        return [
            'total_qty'           => $this->faker->numberBetween(1, 20),
            'order_id'            => $address->order_id,
            'order_address_id'    => $address->id,
            'inventory_source_id' => InventorySource::factory(),
        ];
    }
}
