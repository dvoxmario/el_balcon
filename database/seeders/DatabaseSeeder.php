<?php

namespace Database\Seeders;

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

        $this->call([
            IdentificationTypeSeeder::class,
            UserSeeder::class,
            RolSeeder::class,
            UserRolSeeder::class,
            PriceSeeder::class,
            RoomCategorySeeder::class,
            RoomSeeder::class,
            PaymentMethodSeeder::class,
            InvoiceStatusSeeder::class,
            ReservationSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
