<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUs;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            'location' => 'Department of Agriculture,P.O.Box. 01, Peradeniya',
            'phone' => '081- 2388331',
            'fax' => '081- 2388045',
            'email' => 'contact@slemarket.com',
        ]);
    }
}
