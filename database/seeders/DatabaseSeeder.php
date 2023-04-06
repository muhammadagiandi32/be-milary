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
        // \App\Models\User::factory(10)->create();

        ModelsUser::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'post_code' => '',
        ]);


        Items::create([
            'uuid' => Str::uuid(),
            'ItemName' => 'AEROSPACE XXL',
            'Size' => 'XXL',
            'Price' => 690850
        ]);
        Items::create([
            'uuid' => Str::uuid(),
            'ItemName' => 'AEROSPACE XL',
            'Size' => 'XL',
            'Price' => 690850
        ]);
        Items::create([
            'uuid' => Str::uuid(),
            'ItemName' => 'AEROSPACE L',
            'Size' => 'L',
            'Price' => 690850
        ]);
        Items::create([
            'uuid' => Str::uuid(),
            'ItemName' => 'AEROSPACE M',
            'Size' => 'M',
            'Price' => 690850
        ]);
        Items::create([
            'uuid' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',
            'ItemName' => 'AEROSPACE S',
            'Size' => 'S',
            'Price' => 690850
        ]);

        // for ($i = 0; $i < 5; $i++) {
        Stock::create([
            'ItemsId' => '30ac5d4c-dcb4-4b79-a82a-f636931af156',
            'Stock' => 200
        ]);
        // }

        AccessToken::create([
            'token' => 'qV32ZZ90fGaUqF0p6CcmyU452tL7H4LCjzggxmbsBap11VLY0r6EzMb6k0p8NOGM'
            // 'token' => Str::random(64)
        ]);
    }
}
