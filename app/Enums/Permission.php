<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Permission extends Enum
{
    const Read        =   1 << 0;  //可讀
    const Create      =   1 << 1;  //可建立
    const Update      =   1 << 2;  //可更新
    const Audit       =   1 << 3;  //科審核
    const Disable     =   1 << 4;  //記錄停用
    const Delete      =   1 << 5;  //可刪除
    const Copy        =   1 << 6;  //客服址

    const Admin       = self::Read | self::Create | self::Update | self::Audit |
                        self::Disable | self::Delete | self::Copy;
    const Engineer    = self::Admin;
    const MainManager = self::Read | self::Create | self::Update | self::Audit |
                        self::Disable | self::Copy;
    const Manager     = self::Read | self::Create | self::Update | self::Audit |
                        self::Disable;
    const Operator    = self::Read | self::Update | self::Audit | self::Disable;
    const Reseller    = self::Read | self::Create | self::Update | self::Disable;
    const Advertiser  = self::Read | self::Create | self::Update | self::Disable;
    const System      = self::Read | self::Create | self::Update | self::Disable;
    const User        = self::Read;
}
