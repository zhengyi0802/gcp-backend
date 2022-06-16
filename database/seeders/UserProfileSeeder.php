<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'user_id'       =>  1,
                'company'       =>  '系統程式',
                'job'           =>  '系統程式',
                'contacts'      =>  null,
                'description'   =>  '系統程式',
                'status'        =>  true,
                'created_by'    =>  1,
            ],
            [
                'user_id'       =>  2,
                'company'       =>  '遠端程式',
                'job'           =>  '遠端程式',
                'contacts'      =>  null,
                'description'   =>  '遠端程式',
                'status'        =>  true,
                'created_by'    =>  1,
            ],
            [
                'user_id'       =>  3,
                'company'       =>  '系統程式',
                'job'           =>  '超級管理員',
                'contacts'      =>  null,
                'description'   =>  '超級管理員',
                'status'        =>  true,
                'created_by'    =>  1,
            ],
            [
                'user_id'       =>  4,
                'company'       =>  '響樂科技',
                'job'           =>  '系統工程師',
                'contacts'      =>  null,
                'description'   =>  '系統工程師',
                'status'        =>  true,
                'created_by'    =>  1,
            ],
            [
                'user_id'       =>  5,
                'company'       =>  '響樂科技',
                'job'           =>  '應用工程師',
                'contacts'      =>  null,
                'description'   =>  '應用工程師',
                'status'        =>  true,
                'created_by'    =>  1,
            ],
            [
                'user_id'       =>  6,
                'company'       =>  '響樂科技',
                'job'           =>  '總管理員',
                'contacts'      =>  null,
                'description'   =>  '總管理員',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
            [
                'user_id'       =>  7,
                'company'       =>  '響樂科技',
                'job'           =>  '管理員',
                'contacts'      =>  null,
                'description'   =>  '管理員',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
            [
                'user_id'       =>  8,
                'company'       =>  '響樂科技',
                'job'           =>  '操作員',
                'contacts'      =>  null,
                'description'   =>  '操作員',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
            [
                'user_id'       =>  9,
                'company'       =>  '經銷商',
                'job'           =>  '經銷商',
                'contacts'      =>  null,
                'description'   =>  '經銷商',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
            [
                'user_id'       =>  10,
                'company'       =>  '廣告商',
                'job'           =>  '廣告商',
                'contacts'      =>  null,
                'description'   =>  '廣告商',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
            [
                'user_id'       =>  11,
                'company'       =>  '使用者',
                'job'           =>  '使用者',
                'contacts'      =>  null,
                'description'   =>  '使用者',
                'status'        =>  true,
                'created_by'    =>  4,
            ],
        ];

        foreach($profiles as $profile) {
            UserProfile::create($profile);
        }

    }
}
