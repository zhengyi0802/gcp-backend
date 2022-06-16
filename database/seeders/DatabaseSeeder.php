<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(UploadFileSeeder::class);
        $this->call(ProductStatusSeeder::class);
        $this->call(ProductCatagorySeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductRecordSeeder::class);
        $this->call(ApkCatagorySeeder::class);
        $this->call(LogMessageSeeder::class);
        $this->call(MainVideoSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProjectPermissionSeeder::class);
        $this->call(LogoSeeder::class);
        $this->call(StartpageSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(AdvertisingSeeder::class);
        $this->call(BulletinSeeder::class);
        $this->call(BulletinItemSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MarqueeSeeder::class);
        $this->call(QACatagorySeeder::class);
        $this->call(QAListSeeder::class);
        $this->call(AppAdvertisingSeeder::class);
        $this->call(MediaCatagorySeeder::class);
        $this->call(MediaContentSeeder::class);
        $this->call(ApkProgramSeeder::class);
        $this->call(VoiceSettingSeeder::class);
        $this->call(CustomerSupportSeeder::class);
        $this->call(OneKeyInstallerSeeder::class);
        $this->call(AppMenuSeeder::class);
        $this->call(AppManagerSeeder::class);
        $this->call(HotAppSeeder::class);
        $this->call(ContentSeeder::class);

        Model::reguard();
    }
}
