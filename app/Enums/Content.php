<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Content extends Enum
{
    const ApiTest               =   0;
    const ProductCatagory       =   1;
    const ProductType           =   2;
    const ProductStatus         =   3;
    const Product               =   4;
    const ProductRecord         =   5;
    const User                  =   6;
    const UserPermission        =   7;
    const Project               =   8;
    const Startpage             =   9;
    const Logo                  =   10;
    const Business              =   11;
    const Advertising           =   12;
    const MainVideo             =   13;
    const Bulletin              =   14;
    const AppMenu               =   15;
    const Menu                  =   16;
    const AppMarketAdvertising  =   17;
    const Medias                =   18;
    const QA                    =   19;
    const Marquee               =   20;
    const ApkManager            =   21;
    const OneKeyInstaller       =   22;
    const AppMarket             =   23;
    const HotApp                =   24;
    const VoiceSetting          =   25;
    const CustomerSupport       =   26;
    //const MediaGroup            =   27;
    const LogMessage            =   28;

//
    const MediaCatagory         =   51;
    const MediaContent          =   52;
    const BulletinCatagory      =   53;
    const BulletinItem          =   54;

//API專用
    const Homepage              =   101;
    const CheckDate             =   102;
    const Shopping              =   103;
}
