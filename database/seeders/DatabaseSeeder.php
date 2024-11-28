<?php

namespace Database\Seeders;

use App\Models\ProcessShipping;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([ProcessShippingDatabaseSeeder::class]);
        $this->call([ShippingRatesSeeder::class]);
    }
}

class ProcessShippingDatabaseSeeder extends Seeder
{
    public function run()
    {
        ProcessShipping::insert([
            ['name' => 'Đang xử lý'],
            ['name' => 'Chờ đơn vị vận chuyển'],
            ['name' => 'Đang vận chuyển'],
            ['name' => 'Tiến hành giao hàng'],
            ['name' => 'Đã giao']
        ]);
    }
}
