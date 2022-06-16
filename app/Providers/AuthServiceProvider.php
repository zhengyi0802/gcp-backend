<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public static $permissions = [
        'projects'          => Content::Project,
        'logos'             => Content::Logo,
        'qas'               => Content::QA,
        'startpages'        => Content::Startpage,
        'mainvideos'        => Content::MainVideo,
        'businesses'        => Content::Business,
        'advertisings'      => Content::Advertising,
        'bulletins'         => Content::Bulletin,
        'appmenus'          => Content::AppMenu,
        'menus'             => Content::Menu,
        'marquees'          => Content::Marquee,
        'appadvertisings'   => Content::AppMarketAdvertising,
        'voicesettings'     => Content::VoiceSetting,
        'customersupports'  => Content::CustomerSupport,
        'medias'            => Content::Medias,
        'productstatuses'   => Content::ProductStatus,
        'productcatagories' => Content::ProductCatagory,
        'producttypes'      => Content::ProductType,
        'products'          => Content::Product,
        'productrecords'    => Content::ProductRecord,
        'logmessages'       => Content::LogMessage,
        'users'             => Content::User,
        'permissions'       => Content::UserPermission,
        'apitests'          => Content::ApiTest,
        'appmanagers'       => Content::AppMarket,
        'apkmanagers'       => Content::ApkManager,
        'hotapps'           => Content::HotApp,
        'onekeyinstallers'  => Content::OneKeyInstaller,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Roles based authorization
        Gate::before(
            function ($user, $ability) {
                if ($user->role <= UserRole::Administrator) {
                    return true;
                }
            }
        );

        foreach (self::$permissions as $action => $content) {
            Gate::define(
                $action,
                function ($user) use($content) {
                    if ($user->canRead($content)) {
                        return true;
                    }
                }
            );
        }

    }
}
