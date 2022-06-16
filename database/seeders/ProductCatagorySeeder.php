<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCatagory;

class ProductCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catagory = array(
            'name'        => 'OTTBOX',
            'description' => '電視機上盒',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductCatagory::create($catagory);

        $catagory = array(
            'name'        => 'SoundBar',
            'description' => '聲霸音響',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductCatagory::create($catagory);

        $catagory = array(
            'name'        => 'Dongle',
            'description' => 'HDMI插入式機上盒',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductCatagory::create($catagory);

        $catagory = array(
            'name'        => 'Android TV',
            'description' => 'Android電視',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductCatagory::create($catagory);
    }
}
