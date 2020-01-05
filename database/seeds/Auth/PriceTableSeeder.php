<?php

use App\Models\Price;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class PriceTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add message type A
        Price::create(
            [
                'message_type_name' => 'A',
                'price' => '1',

            ]
        );

        // Add message type B
        Price::create(
            [
                'message_type_name' => 'B',
                'price' => '2',

            ]
        );

        // Add message type C
        Price::create(
            [
                'message_type_name' => 'C',
                'price' => '5',

            ]
        );

        // Add message type D
        Price::create(
            [
                'message_type_name' => 'D',
                'price' => '10',

            ]
        );

        // Add message type unknown
        Price::create(
            [
                'message_type_name' => 'unknown',
                'price' => 'empty',

            ]
        );


        $this->enableForeignKeys();
    }
}
