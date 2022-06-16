<?php

namespace App\Collections;

use Illuminate\Support\Collection;
use App\Models\Startpage;
use App\Models\Logo;
use App\Models\Business;
use App\Models\Advertising;
use App\Models\MainVideo;
use App\Models\Marquee;
use App\Models\Bulletin;
use App\Models\AppMenu;
use App\Models\Menu;
use App\Models\MediaCatagory;
use App\Models\MediaContent;
use App\Models\Project;

class ResellerCollection
{

    public ?Project        $project;
    public int             $project_id;
    public ?Logo           $logo;
    public ?Collection     $businesses;
    public ?Collection     $advertisings;
    public ?Collection     $mainvideos;
    public ?Collection     $marquees;
    public ?Collection     $bulletins;
    public ?AppMenuCollection     $appmenus;
    public ?Collection     $menus;
    public ?Collection     $mediacatagories;
    public ?StartPage      $startpage;

    public function __construct($id)
    {
        $this->project_id      = $id;
        $this->project         = Project::find($id);
        $this->mainvideos      = MainVideo::where('project_id', $id)->where('status', true)->latest()->get();
        $this->logo            = Logo::where('status', true)->where('project_id', $id)->orWhere('project_id', 1)->orderBy('id', 'DESC')->first();
        $this->businesses      = Business::where('project_id', $id)->where('status', true)->latest()->get();
        $this->advertisings    = Advertising::where('project_id', $id)->where('status', true)->latest()->get();
        $this->marquees        = Marquee::where('project_id', $id)->where('status', true)->latest()->get();
        $this->bulletins       = Bulletin::where('project_id', $id)->where('status', true)->latest()->get();
        $this->menus           = Menu::where('project_id', $id)->orWhere('project_id', 0)->where('status', true)->latest()->get();
        $this->mediacatagories = MediaCatagory::where('project_id', $id)->where('status', true)->orderBy('menu_id','asc')->latest()->get();
        $appmenus              = AppMenu::where('project_id', $id)->where('status', true)->latest()->get();
        $this->appmenus        = new AppMenuCollection($appmenus);
        $this->startpage       = StartPage::where('project_id', $id)->where('status', true)->orderBy('id', 'DESC')->first();

    }

    public function menucontent($menu_id, $parent = 0)
    {
        $mediacatagories = MediaCatagory::where('project_id', $this->project_id)
                                        ->where('menu_id', $menu_id)
                                        ->where('parent_id', $parent)
                                        ->where('status', true)
                                        ->get();

        return $mediacatagories;
    }
}
