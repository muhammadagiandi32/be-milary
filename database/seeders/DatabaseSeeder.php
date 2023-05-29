<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccessToken;
use App\Models\Items;
use App\Models\Stock;
use App\Models\User as ModelsUser;
// use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(500)->create();

        // ModelsUser::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'admin@gmail.com',
        //     // 'post_code' => '',
        // ]);


        // Items::create([
        //     // 'uuid' => Str::uuid(),
        //     'uuid' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',

        //     'ItemName' => 'AEROSPACE XXL',
        //     'Size' => 'XXL',
        //     'Price' => 690850
        // ]);
        // Items::create([
        //     // 'uuid' => Str::uuid(),
        //     'uuid' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',

        //     'ItemName' => 'AEROSPACE XL',
        //     'Size' => 'XL',
        //     'Price' => 690850
        // ]);
        $items_milarty = [
            // Start
            // Milary THIGH SLIMMER Color BLACK
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'BLACK',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'BLACK',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'BLACK',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'BLACK',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // End
            // Milary THIGH SLIMMER Color BLACK

            // Start
            // Milary THIGH SLIMMER Color NUDE
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'NUDE',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'NUDE',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'NUDE',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'THIGH SLIMMER',
                'Color' => 'NUDE',
                'Style' => 'THIGH SLIMMER',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // End
            // Milary THIGH SLIMMER Color NUDE

            // Start
            // Milary HIGH WAIST PANTY  Color NUDE
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'NUDE',
                'Style' => 'HIGH WAIST PANTY ',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'NUDE',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'NUDE',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'NUDE',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // Start
            // Milary HIGH WAIST PANTY  Color NUDE

            // Start
            // Milary HIGH WAIST PANTY Color BLACK
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'BLACK',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'BLACK',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'BLACK',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'HIGH WAIST PANTY',
                'Color' => 'BLACK',
                'Style' => 'HIGH WAIST PANTY',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // End
            // Milary THIGH SLIMMER Color BLACK

            // Start
            // Milary ALL IN ONE Color BLACK
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'BLACK',
                'Style' => 'ALL IN ONE',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'BLACK',
                'Style' => 'ALL IN ONE',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'BLACK',
                'Style' => 'ALL IN ONE',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'BLACK',
                'Style' => 'ALL IN ONE',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // End
            // Milary ALL IN ONE Color BLACK

            // Start
            // Milary ALL IN ONE  Color NUDE
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'NUDE',
                'Style' => 'ALL IN ONE',
                'Size' => 'S',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'NUDE',
                'Style' => 'ALL IN ONE',
                'Size' => 'M',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'NUDE',
                'Style' => 'ALL IN ONE',
                'Size' => 'L',
                'Price' => 1200,
                'created_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'ItemName' => 'ALL IN ONE',
                'Color' => 'NUDE',
                'Style' => 'ALL IN ONE',
                'Size' => 'XL',
                'Price' => 1200,
                'created_at' => now()
            ],
            // Start
            // Milary HIGH WAIST PANTY  Color NUDE
        ];
        Items::insert($items_milarty);
        Items::create([
            'uuid' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',
            'ItemName' => 'AEROSPACE S',
            'Size' => 'S',
            'Price' => 690850
        ]);
        Items::create([
            // 'uuid' => Str::uuid(),
            'uuid' => 'b3eb4a12-e405-4e63-900e-cb3da3109257',

            'ItemName' => 'AEROSPACE M',
            'Size' => 'M',
            'Price' => 690850
        ]);
        Items::create([
            // 'uuid' => Str::uuid(),
            'uuid' => '05b3a34a-c514-4cf8-821f-0cd2832b8dc8',

            'ItemName' => 'AEROSPACE L',
            'Size' => 'L',
            'Price' => 690850
        ]);

        // input Stock
        // for ($i = 0; $i < 5; $i++) {
        Stock::create([
            'uuid' => Str::uuid(),
            'ItemsId' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',
            'Stock' => 200
        ]);
        Stock::create([
            'uuid' => Str::uuid(),
            'ItemsId' => 'b3eb4a12-e405-4e63-900e-cb3da3109257',
            'Stock' => 200
        ]);
        Stock::create([
            'uuid' => Str::uuid(),
            'ItemsId' => '05b3a34a-c514-4cf8-821f-0cd2832b8dc8',
            'Stock' => 200
        ]);
        // }

        AccessToken::create([
            'token' => 'qV32ZZ90fGaUqF0p6CcmyU452tL7H4LCjzggxmbsBap11VLY0r6EzMb6k0p8NOGM'
            // 'token' => Str::random(64)
        ]);
    }
}
