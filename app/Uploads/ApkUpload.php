<?php

namespace App\Uploads;

use Illuminate\Support\Facades\Storage;

class ApkUpload extends Upload
{
    public function __construct()
    {
        $param = array(
                 'path'    => 'packages',
                 'subpath' => null,
                 'type'    => 'apk',
               );
        parent::__construct($param);
    }

    public function process($package)
    {
        $result = parent::storage($package, false);
        $info   = $this->getPackageInfo($result->storename);
        $info['id']   = $result->id;
        $info['path'] = $result['url'];

        return $info;
    }

    public function getPackageInfo($file)
    {
        $config['manifest_only'] = false;
        $filepath = public_path('packages').'/'.$file;
        $apk = new \ApkParser\Parser($filepath, $config);
        $manifest = $apk->getManifest();
        //$apk_data['path'] = env('APP_URL').$filepath;
        $apk_data['package_name'] = $manifest->getPackageName();
        $apk_data['package_version_name'] = $manifest->getVersionName();
        $apk_data['package_version_code'] = $manifest->getVersionCode();
        $apk_data['sdk_version'] = $manifest->getTargetSdk()->platform;
        $resourceId = $manifest->getApplication()->getIcon();
        $resources = $apk->getResources($resourceId);
        $apk_data['icon'] = $resources[0];
        $labelResourceId = $manifest->getApplication()->getLabel();
        $appLabel = $apk->getResources($labelResourceId);
        $apk_data['label'] = $appLabel[0];
        $iconfile = date('Y-m-d-H-i-s-').str_replace(".apk", ".png", $file);
        $content = stream_get_contents($apk->getStream($resources[0]));
        $icon_path = "public/images/packages/".$iconfile;
        Storage::put($icon_path, $content);
        $apk_data['icon'] = env('APP_URL')."/storage/images/packages/".$iconfile;
        return $apk_data;
    }

}
