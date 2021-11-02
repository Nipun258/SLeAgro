<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'vision' => 'Achieve excellence in agriculture for national prosperity...',
            'mision' => 'Achieve an equitable and sustainable agriculture development through development and dissemination of improved agriculture technology...',
            'discription' => 'The Department of Agriculture (DOA) functions under the Ministry of Agriculture and the DOA is one of the largest government departments with a high profile community of agricultural scientists and a network of institutions covering different agro ecological regions island wide.',
        ]);
    }
}
