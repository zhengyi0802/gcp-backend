<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Product;
use App\Models\Logo;
use App\Models\Startpage;
use App\Models\Business;
use App\Models\Advertising;
use App\Models\MainVideo;
use App\Models\AppMenu;
use App\Models\Menu;
use App\Models\VoiceSetting;
use App\Models\AppManager;
use App\Models\HotApp;
use App\Models\OneKeyInstaller;
use App\Models\CustomerSupport;
use App\Models\QACatagory;
use App\Models\QAList;
use App\Models\Marquee;
use App\Models\AppAdvertising;
use App\Models\ApkProgram;
use App\Enums\Content;
use App\Collections\AppMenuCollection;
use Illuminate\Http\Request;

class InterfaceController extends Controller {

    private function getProject($mac)
    {
        if (strlen($mac) < 17) {
            $mac_array = str_split($mac, 2);
            $mac = implode(':', $mac_array);
        }
        $product = Product::where('ether_mac', $mac)->orWhere('wifi_mac', $mac)->first();
        return ($product) ? $product->project_id : null;
    }

    private function parseInput(Request $request)
    {
        $project_id = null;
        if ($request->input('mac')) {
            $mac = $request->input('mac');
            $project_id = $this->getProject($mac);
        } else if ($request->input('project_id')) {
            $project_id = $request->input('project_id');
        }
        return $project_id;
    }

    public function logo(Request $request, $internal = false)
    {

        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $logo = Logo::select('image', 'link_url', 'updated_at')
                    ->where('project_id', $project_id)
                    ->where('status', true)
                    ->latest()->first();
        if ($logo) {
            $result = json_encode($logo->toArray(), JSON_UNESCAPED_UNICODE);
            if ($internal) {
                return $logo->toArray();
            } else {
                return $result;
            }
        } else {
            return json_encode(null);
        }
    }

    public function startpage(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $startpage = Startpage::select('name', 'mime_type', 'url', 'url_http', 'intervals', 'start_time', 'stop_time')
                              ->where('project_id', $project_id)
                              ->where('status', true)
                              ->latest()->first();
        if ($startpage) {
            if ($startpage->mime_type == 'i_video' || $startpage->mime_type == 'e_video') {
                $startpage->mime_type = 'video';
            }
            $result = json_encode($startpage->toArray(), JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }

    }

    public function customLogo(Request $request, $internal = false)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $business = Business::select('serial', 'logo_url as image', 'link_url', 'intervals', 'updated_at')
                            ->where('project_id', $project_id)
                            ->where('status', true)
                            ->get();
        if ($business) {
            $result = json_encode($business->toArray(), JSON_UNESCAPED_UNICODE);
            if ($internal) {
                return $business->toArray();
            } else {
                return $result;
            }
        } else {
            return json_encode(null);
        }
    }

    public function ad(Request $request, $internal = false)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $advertising = Advertising::select('index', 'thumbnail as image', 'link_url')
                                  ->where('project_id', $project_id)
                                  ->where('status', true)
                                  ->get();
        if ($advertising) {
            $result = json_encode($advertising->toArray(), JSON_UNESCAPED_UNICODE);
            if ($internal) {
                return $advertising->toArray();
            } else {
                return $result;
            }
        } else {
            return json_encode(null);
        }
    }

    public function appmenu(Request $request)
    {
        $project_id = $request->input('project_id');
        $appmenus = AppMenu::where('project_id', $project_id)->where('status', true)->get();

        if ($appmenus) {
            $collection = new AppMenuCollection($appmenus);
            $result = json_encode($collection->result, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }

    }

    public function mainvideo(Request $request, $internal = false)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $project = Project::find($project_id);
        if ($project) {
            $mainvideo = $project->mainvideo();
            $playlist = null;
            if ($mainvideo) {
                $playlist = array(
                           'type' => $mainvideo->type,
                           'playlist' => $mainvideo->playlist,
                );
            }
            $result = json_encode($playlist, JSON_UNESCAPED_UNICODE);
            if ($internal) {
                return $playlist;
            } else {
                return $result;
            }
        } else {
            return json_encode(null);
        }
    }

    public function menu(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $menus = Menu::select('id','name', 'icon', 'tag', 'type')
                     ->where('project_id', $project_id)
                     ->orWhere('project_id', 0)
                     ->where('status', true)
                     ->get();
        $arr = array(
                   'logo'            => $this->logo($request, true),
                   'menu'            => $menus->toArray(),
                   'onekeyinstaller' => $this->onekeyinstaller($request, true),
               );
        if ($arr) {
            $result = json_encode($arr, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function voicesetting(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $voicesettings = VoiceSetting::where('project_id', $project_id)
                                     ->where('status', true)
                                     ->get();
        if ($voicesettings) {
            $VoiceSettings = array();
            foreach($voicesettings as $voicesetting) {
                $voiceSetting = array(
                    'keywords'    => $voicesetting->keywords,
                    'label'       => $voicesetting->apk->label,
                    'name'        => $voicesetting->apk->program_name,
                    'link_url'    => $voicesetting->apk->path,
                );
                array_push($VoiceSettings, $voiceSetting);
            }
            $result = json_encode($VoiceSettings, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }

    }

    public function appmanager(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $appmanagers = AppManager::where('project_id', $project_id)
                                 ->where('status', true)
                                 ->get();
        if ($appmanagers) {
            $appManagers = array();
            foreach($appmanagers as $appmanager) {
                $appManager = array(
                    'label'          => $appmanager->apk->label,
                    'package_name'   => $appmanager->apk->package_name,
                    'thumbnail'      => $appmanager->apk->icon,
                    'url'            => $appmanager->apk->path,
                    'market_id'      => $appmanager->market_id,
                    'installer_flag' => $appmanager->installer_flag,
                    'delaytime'      => $appmanager->delaytime,
                );
                array_push($appManagers, $appManager);
            }
            $result = json_encode($appManagers, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function hotapp(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $hotapps = HotApp::where('project_id', $project_id)
                         ->where('status', true)
                         ->get();

        if ($hotapps) {
            $hotApps = array();
            foreach($hotapps as $hotapp) {
                $hotApp = array(
                    'label'          => $hotapp->apk->label,
                    'package_name'   => $hotapp->apk->package_name,
                    'thumbnail'      => $hotapp->apk->icon,
                    'url'            => $hotapp->apk->path,
                );
                array_push($hotApps, $hotApp);
            }
            $result = json_encode($hotApps, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function onekeyinstaller(Request $request, $internal = false)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $onekeys = OneKeyInstaller::where('project_id', $project_id)
                                  ->where('status', true)
                                  ->get();

        if ($onekeys) {
            $oneKeys = array();
            foreach($onekeys as $onekey) {
                $oneKey = array(
                    'label'          => $onekey->apk->label,
                    'package_name'   => $onekey->apk->package_name,
                    'thumbnail'      => $onekey->apk->icon,
                    'url'            => $onekey->apk->path,
                );
                array_push($oneKeys, $oneKey);
            }
            $result = json_encode($oneKeys, JSON_UNESCAPED_UNICODE);
            if ($internal) {
                return $oneKeys;
            } else {
                return $result;
            }
        } else {
            return json_encode(null);
        }
    }

    public function customersupport(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $customersupports = CustomerSupport::where('project_id', $project_id)
                                           ->where('status', true)
                                           ->get();

        if ($customersupports) {
            $customerSupports = array();
            foreach($customersupports as $customersupport) {
                $customerSupport = array(
                    'qrcode_type'      => $customersupport->qrcode_type,
                    'qrcode_content'   => $customersupport->qrcode_content,
                    'rcapp'            => ($customersupport->apk) ? $customersupport->apk->package_name : null,
                    'rcapp_url'        => ($customersupport->apk) ? $customersupport->apk->path : null,
                );
                array_push($customerSupports, $customerSupport);
            }
            $result = json_encode($customerSupports, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function marquee(Request $request)
    {
        $project_id = $this->parseInput($request);
        $type = $request->input('type');

        if ($project_id == null) {
            return json_encode(null);
        }
        if ($type == 2) {
            $marquees = Marquee::select('type', 'name', 'content', 'url')
                               ->where('type', $type)
                               ->where('project_id', $project_id)
                               ->where('status', true)
                               ->get();
        } else if ($type == 3) {
            $marquees = Marquee::select('type', 'name', 'content', 'url')
                               ->where('type', $type)
                               ->where('status', true)
                               ->get();
        }
        if ($marquees) {
            $result = json_encode($marquees, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function qa(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $qacatagories = QACatagory::where('status', true)->get();
        if ($qacatagories) {
            $QA = array();
            foreach ($qacatagories as $qacatagory) {
                $qalists = $qacatagory->lists;
                if ($qalists) {
                    $items = array();
                    foreach($qalists as $qalist) {
                       $item = array(
                           'question' => $qalist->question,
                           'type'     => $qalist->type,
                           'answer'   => $qalist->answer,
                       );
                       array_push($items, $item);
                    }
                }
                $catagory = array(
                    'title'     => $qacatagory->name,
                    'items'     => $items,
                );
                array_push($QA, $catagory);
            }
            $result = json_encode($QA, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function appad(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $project = Project::find($project_id);
        if ($project) {
            $appads = $project->appadvertisings();
            $appadvertisings = array();
            foreach($appads as $appad) {
               $data = array(
                   'interval'    =>  $appad->interval,
                   'thumbnail'   =>  $appad->thumbnail,
                   'url'         =>  $appad->link_url,
               );
               array_push($appadvertisings, $data);
            }
            $result = json_encode($appadvertisings, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function apk(Request $request)
    {
        $package_name = $request->input('package_name');
        $apk = ApkProgram::select('package_name as name', 'package_version_name as package_version', 'sdk_version',
                                  'description', 'created_at', 'path')
                         ->where('package_name', $package_name)
                         ->orderBy('package_version_code', 'DESC')
                         ->first();
        if ($apk) {
            $result = json_encode($apk, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function checkdate(Request $request)
    {
        $mac = $request->input('mac');
        if (strlen($mac) < 17) {
            $mac_array = str_split($mac, 2);
            $mac = implode(':', $mac_array);
        }
        $product = Product::select('serialno', 'ether_mac', 'wifi_mac', 'expire_date')
                          ->where('ether_mac', $mac)
                          ->orWhere('wifi_mac', $mac)
                          ->first();
        if ($product) {
            $result = json_encode($product->toArray(), JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function shopping(Request $request)
    {

        return json_encode(null);
    }

    public function homepage(Request $request)
    {
        $project_id = $this->parseInput($request);
        if ($project_id == null) {
            return json_encode(null);
        }

        $arr = array(
                   'customLogo' => null,
                   'logos'      => $this->customLogo($request, true),
                   'ad'         => $this->ad($request, true),
                   'videos'     => $this->mainvideo($request, true),
               );

        if ($arr) {
            $result = json_encode($arr, JSON_UNESCAPED_UNICODE);
            return $result;
        } else {
            return json_encode(null);
        }
    }

    public function tests(Request $request)
    {
        $content = $request->input('content');
        $project_id = $request->input('project_id');
        $mac = $request->input('mac');
        $projects = Project::where('status', true)->get();
        $result = null;

        switch($content) {
            case Content::Logo :
                 $result = $this->logo($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/logo?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/logo?mac='.$mac;
                 }
                 break;
            case Content::Startpage :
                 $result = $this->startpage($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/startpage?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/startpage?mac='.$mac;
                 }
                 break;
            case Content::Business :
                 $result = $this->customLogo($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/customLogo?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/customLogo?mac='.$mac;
                 }
                 break;
            case Content::Advertising :
                 $result = $this->ad($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/ad?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/ad?mac='.$mac;
                 }
                 break;
            case Content::MainVideo :
                 $result = $this->mainvideo($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/mainvideo?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/mainvideo?mac='.$mac;
                 }
                 break;
            case Content::AppMenu :
                 $result = $this->appmenu($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/appmenu?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/appmenu?mac='.$mac;
                 }
                 break;
            case Content::Menu :
                 $result = $this->menu($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/menu?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/menu?mac='.$mac;
                 }
                 break;
            case Content::VoiceSetting :
                 $result = $this->voicesetting($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/voicesetting?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/voicesetting?mac='.$mac;
                 }
                 break;
            case Content::AppMarket :
                 $result = $this->appmanager($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/appmanager?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/appmanager?mac='.$mac;
                 }
                 break;
            case Content::HotApp :
                 $result = $this->hotapp($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/hotapp?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/hotapp?mac='.$mac;
                 }
                 break;
            case Content::OneKeyInstaller :
                 $result = $this->onekeyinstaller($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/onekeyinstaller?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/onekeyinstaller?mac='.$mac;
                 }
                 break;
            case Content::CustomerSupport :
                 $result = $this->customersupport($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/customersupport?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/customersupport?mac='.$mac;
                 }
                 break;
            case Content::Marquee :
                 $result = $this->marquee($request);
                 $type = $request->input('type');
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/marquee?project_id='.$project_id.'&type='.$type;
                 } else {
                     $query = env('APP_URL').'/interfaces/marquee?mac='.$mac.'&type='.$type;
                 }
                 break;
            case Content::QA :
                 $result = $this->qa($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/qa?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/qa?mac='.$mac;
                 }
                 break;
            case Content::AppMarketAdvertising :
                 $result = $this->appad($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/appad?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/appad?mac='.$mac;
                 }
                 break;
            case Content::ApkManager :
                 $result = $this->apk($request);
                 $package_name = $request->input('package_name');
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/apk?project_id='.$project_id.'&package_name='.$package_name;
                 } else {
                     $query = env('APP_URL').'/interfaces/apk?mac='.$mac.'&package_name='.$package_name;
                 }
                 break;
            case Content::CheckDate :
                 $result = $this->checkdate($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/checkdate?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/checkdate?mac='.$mac;
                 }
                 break;
            case Content::Shopping :
                 $result = $this->shopping($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/shopping?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/shopping?mac='.$mac;
                 }
                 break;
            case Content::Homepage :
                 $result = $this->homepage($request);
                 if ($project_id) {
                     $query = env('APP_URL').'/interfaces/homepage?project_id='.$project_id;
                 } else {
                     $query = env('APP_URL').'/interfaces/homepage?mac='.$mac;
                 }
                 break;

            default :
                 $result = null;
                 $query = null;
                 break;
        }

        return view('interfaces.tests', compact('projects'))
               ->with('query', $query)
               ->with('mac', $mac)
               ->with('project_id', $project_id)
               ->with('content', $content)
               ->with('result', $result);
    }
}


