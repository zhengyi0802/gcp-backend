<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const System        =   0;  //系統
    const Administrator =   1;  //超級管理者
    const Developer     =   2;  //開發人員
    const MainManager   =   3;  //主管理者
    const Manager       =   4;  //管理者
    const Operator      =   5;  //操作員
    const Reseller      =   6;  //代理經銷商
    const Advertiser    =   7;  //廣告商
    const User          =   8;  //一般使用者
}
