<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApkCatagory;

class ApkCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'parent_id'    => 0,
            'name'         => '系統應用',
            'description'  => '系統應用',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);


        $data = array(
            'parent_id'    => 0,
            'name'         => '工具應用',
            'description'  => '工具應用',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 0,
            'name'         => '影音應用',
            'description'  => '影音應用',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 0,
            'name'         => '遊戲',
            'description'  => '遊戲',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 1,
            'name'         => '首頁',
            'description'  => '首頁',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 1,
            'name'         => '應用商城',
            'description'  => '應用商城',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 2,
            'name'         => '語音控制',
            'description'  => '語音控制',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 2,
            'name'         => '遠程遙控',
            'description'  => '遠程遙控',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 3,
            'name'         => '影視應用',
            'description'  => '影視應用',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

        $data = array(
            'parent_id'    => 3,
            'name'         => '卡拉OK',
            'description'  => '卡拉OK',
            'status'       => true,
            'created_by'   => 1,
        );
        ApkCatagory::create($data);

    }
}
