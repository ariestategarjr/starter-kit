<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'barcode' => '60237425',
                'name' => 'Extra Joss',
                'unit_id' => 1,
                'category_id' => 2,
                'stock' => 36,
                'purchase_price' => 1000,
                'selling_price' => 1500,
            ],
            [
                'barcode' => '33025323',
                'name' => 'Peyek',
                'unit_id' => 1,
                'category_id' => 1,
                'stock' => 48,
                'purchase_price' => 10000,
                'selling_price' => 12000,
            ],
            [
                'barcode' => '14601515',
                'name' => 'Kain Lap',
                'unit_id' => 1,
                'category_id' => 3,
                'stock' => 24,
                'purchase_price' => 4000,
                'selling_price' => 5000,
            ],
        ]);
    }
}
