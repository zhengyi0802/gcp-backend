<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductStatus;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productstatus = array(
            'name'        => '已註冊',
            'description' => '已註冊專案並啟用',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

        $productstatus = array(
            'name'        => '已入庫',
            'description' => '已入庫',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

        $productstatus = array(
            'name'        => '已出庫',
            'description' => '已出庫',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

        $productstatus = array(
            'name'        => '已安裝未註冊',
            'description' => '已安裝但未註冊',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

        $productstatus = array(
            'name'        => '送修中',
            'description' => '機器送修中',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

        $productstatus = array(
            'name'        => '報廢品',
            'description' => '報廢品',
            'status'      => true,
            'created_by'  => 1,
        );
        ProductStatus::create($productstatus);

    }
}
