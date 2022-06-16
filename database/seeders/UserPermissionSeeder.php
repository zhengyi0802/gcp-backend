<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPermission;
use App\Enums\Permission;
use App\Enums\Content;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedAdministrator();
        $this->seedEngineer();
        $this->seedMainManager();
        $this->seedManager();
        $this->seedOperator();
        $this->seedReseller();
        $this->seedAdvertiser();
        $this->seedUser();
    }

    public function seedAdministrator()
    {
        $data = array(
                'user_id'    => 3,
                'permission' => Permission::Admin,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        };

    }

    public function seedEngineer()
    {
        $data = array(
                'user_id'    => 4,
                'permission' => Permission::Engineer,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        };

        $data = array(
                'user_id'    => 5,
                'permission' => Permission::Engineer,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        };

    }

    public function seedMainManager()
    {
        $data = array(
                'user_id'    => 6,
                'permission' => Permission::MainManager,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::ApiTest,
                    Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        }
    }

    public function seedManager()
    {
        $data = array(
                'user_id'    => 7,
                'permission' => Permission::Manager,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::ApiTest,
                    Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        }
    }

    public function seedOperator()
    {
        $data = array(
                'user_id'    => 8,
                'permission' => Permission::Operator,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::ApiTest,
                    Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        }
    }

    public function seedReseller()
    {
        $data = array(
                'user_id'    => 9,
                'permission' => Permission::Reseller,
                'created_by' => 1,
        );

        $values = [ Content::Startpage,
                    Content::Business,
                    Content::Advertising,
                    Content::MainVideo,
                    Content::Bulletin,
                    Content::AppMenu,
                    Content::Menu,
                    Content::Marquee,
                    Content::VoiceSetting,
                    Content::Medias,
                  ];

        foreach ($values as $value) {
                $data['content_id'] = $value;
                UserPermission::create($data);
        }
    }

    public function seedAdvertiser()
    {
        $data = array(
                'user_id'    => 10,
                'permission' => Permission::Advertiser,
                'created_by' => 1,
        );

        $values = [ Content::Startpage,
                    Content::MainVideo,
                    Content::AppMarketAdvertising,
                  ];

        foreach ($values as $value) {
                $data['content_id'] = $value;
                UserPermission::create($data);
        }
    }

    public function seedUser()
    {
        $data = array(
                'user_id'    => 11,
                'permission' => Permission::User,
                'created_by' => 1,
        );

        $values = Content::getValues();
        $except = [ Content::ApiTest,
                    Content::MediaCatagory,
                    Content::MediaContent,
                    Content::BulletinCatagory,
                    Content::BulletinItem,
                  ];

        foreach ($values as $value) {
            if (!in_array($value, $except)) {
                $data['content_id'] = $value;
                UserPermission::create($data);
            }
        }
    }

}
