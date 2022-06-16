<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collections\ResellerCollection;
use App\Models\Project;
use App\Models\Business;
use App\Models\Advertising;
use App\Models\MainVideo;
use App\Models\Bulletin;
use App\Models\Menu;
use App\Models\AppMenu;
use App\Models\ApkCatagory;
use App\Models\ApkProgram;
use App\Models\Marquee;
use App\Models\Startpage;
use App\Enums\Content;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;

class ResellerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $project_id = $request->input('project_id');
        $user = auth()->user();
        $projects = $user->projects();
        if ($project_id == null) {
            $project = $projects->first();
            $project_id = $project->id;
        }
        $collection = new ResellerCollection($project_id);

        return view('resellers.index', compact('collection'))
               ->with(compact('projects'))
               ->with('project_id', $project_id);
    }

    public function create(Request $request)
    {
        $p = $request->input('p');
        $project_id = $request->input('project_id');
        if ($p == 'business') {
            return view('resellers.business.create', ['project_id' => $project_id]);
        } else if ($p == 'advertising') {
            return view('resellers.advertising.create', ['project_id' => $project_id]);
        } else if ($p == 'mainvideo') {
            return view('resellers.mainvideo.create', ['project_id' => $project_id]);
        } else if ($p == 'bulletin') {
            return view('resellers.bulletin.create', ['project_id' => $project_id]);
        } else if ($p == 'menu') {
            return view('resellers.menu.create', ['project_id' => $project_id]);
        } else if ($p == 'appmenu') {
            $position = $request->input('position');
            $catagories = ApkCatagory::where('status', true)->get();
            $apks = ApkProgram::where('status', true)->get();
            return view('resellers.appmenu.create', ['project_id' => $project_id, 'position' => $position, 'catagory_id' => 0])
                   ->with(compact('catagories'))
                   ->with(compact('apks'));
        } else if ($p == 'marquee') {
            return view('resellers.marquee.create', ['project_id' => $project_id]);
        } else if ($p == 'startpage') {
            return view('resellers.startpage.create', ['project_id' => $project_id]);
        }
    }

    public function store(Request $request)
    {
        $p = $request->input('p');
        if ($p == 'business') {
            return $this->business('store', $request);
        } else if ($p == 'advertising') {
            return $this->advertising('store', $request);
        } else if ($p == 'mainvideo') {
            return $this->mainvideo('store', $request);
        } else if ($p == 'bulletin') {
            return $this->bulletin('store', $request);
        } else if ($p == 'menu') {
            //var_dump($request->all());
            return $this->menu('store', $request);
        } else if ($p == 'appmenu') {

        } else if ($p == 'marquee') {
            return $this->marquee('store', $request);
        }
    }

    public function edit(Request $request, $param)
    {
        $p = $request->input('p');
        //$collection = new ResellerCollection($project_id);
        if ($p == 'business') {
           $business = Business::find($param);
           return view('resellers.business.edit', compact('business'));
        } else if ($p == 'advertising') {
           $advertising = Advertising::find($param);
           return view('resellers.advertising.edit', compact('advertising'));
        } else if ($p == 'mainvideo') {
           $mainvideo = MainVideo::find($param);
           return view('resellers.mainvideo.edit', compact('mainvideo'));
        } else if ($p == 'bulletin') {
           $bulletin = Bulletin::find($param);
           return view('resellers.bulletin.edit', compact('bulletin'));
        } else if ($p == 'menu') {
           $menu = Menu::find($param);
           return view('resellers.menu.edit', compact('menu'));
        } else if ($p == 'appmenu') {

        } else if ($p == 'marquee') {
           $marquee = Marquee::find($param);
           return view('resellers.marquee.edit', compact('marquee'));
        } else if ($p == 'startpage') {
           $startpage = Startpage::find($param);
           return view('resellers.startpage.edit', compact('startpage'));
        }
    }

    public function update(Request $request, $param)
    {
        $p = $request->input('p');
        if ($p == 'business') {
           return $this->business('update', $request, $param);
        } else if ($p == 'advertising') {
           return $this->advertising('update', $request, $param);
        } else if ($p == 'mainvideo') {
           return $this->mainvideo('update', $request, $param);
        } else if ($p == 'bulletin') {
           return $this->bulletin('update', $request, $param);
        } else if ($p == 'menu') {
           return $this->menu('update', $request, $param);
        } else if ($p == 'appmenu') {

        } else if ($p == 'marquee') {
           return $this->marquee('update', $request, $param);
        }
    }

    public function show(Request $request, $param)
    {
        $p = $request->input('p');
        //$collection = new ResellerCollection($param);
        if ($p == 'business') {
            $business = Business::find($param);
            return view('businesses.show', compact('business'));
        } else if ($p == 'advertising') {
            $advertising = Advertising::find($param);
            return view('advertisings.show', compact('advertising'));
        } else if ($p == 'mainvideo') {
            $mainvideo = MainVideo::find($param);
            return view('mainvideos.show', compact('mainvideo'));
        } else if ($p == 'bulletin') {
            $bulletin = Bulletin::find($param);
            return view('bulletins.show', compact('bulletin'));
        } else if ($p == 'appmenu') { // no used
        } else if ($p == 'menu') {
            $menu = Menu::find($param);
            return view('menus.show', compact('menu'));
        } else if ($p == 'marquee') {
            $marquee = Marquee::find($param);
            return view('marquees.show', compact('marquee'));
        } else if ($p == 'startpage') {
            $startpage = StartPage::find($param);
            return view('startpages.show', compact('startpage'));
        }
    }

    public function destroy(Request $request)
    {

    }

    protected function business($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $upload = new ImageUpload('businesses');
            $result = $upload->process($request->file);
            $data['logo_url'] = $result->url;
            $data['file_id']  = $result->id;

            try {
                Business::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                             ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $business = Business::find($id);
            if ($request->file()) {
                $upload = new ImageUpload('businesses');
                $result = $upload->process($request->file);
                $data['logo_url'] = $result->url;
                $data['file_id']  = $result->id;
            }
            try {
                $business->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                             ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        }

    }

    protected function advertising($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $upload = new ImageUpload('advertisings');
            $result = $upload->process($request->file);
            $data['thumbnail'] = $result->url;
            $data['file_id']   = $result->id;
            try {
                Advertising::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                             ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $advertising = Advertising::find($id);
            if ($request->file()) {
                $upload = new ImageUpload('advertisings');
                $result = $upload->process($request->file);
                $data['thumbnail'] = $result->url;
                $data['file_id']   = $result->id;
            }
            try {
                $advertising->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                             ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        }
    }

    protected function mainvideo($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $project_id = $data['project_id'];
            $project = Project::find($project_id);
            $data['status'] = true;
            $array = explode("\r\n", $data['playlist']);
            $json = json_encode($array);
            $data['playlist'] = $json;
            $data['created_by'] = $user->id;

            try {
                $mainvideo = MainVideo::create($data);
            } catch (Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $mainvideo = MainVideo::find($id);
            $array = explode("\r\n", $data['playlist']);
            $json = json_encode($array);
            $data['playlist'] = $json;
            try {
              $mainvideo->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('resellers.index')
                             ->with('update-success', 'update OK');
        }
    }

    protected function bulletin($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $project_id = $data['project_id'];
            $project = Project::find($project_id);

            if ($data['date'] == null) {
                $data['date'] = now();
            }
            try {
                $bulletin = Bulletin::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $bulletin = Bulletin::find($id);
            try {
                $bulletin->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('resellers.index')
                             ->with('update-success', 'update OK');
        }
    }

    protected function menu($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['status'] = true;
            $data['created_by'] = $user->id;

            if ($request->file()) {
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                $path = $request->file('file')->storeAs('menus', $imagefile, 'images');
                $data['icon'] = env('APP_URL').'/images/menus/'.$imagefile;
            }

            try {
                Menu::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $menu = Menu::find($id);
            if ($request->file()) {
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                $path = $request->file('file')->storeAs('menus', $imagefile, 'images');
                $data['icon'] = env('APP_URL').'/images/menus/'.$imagefile;
            }

            try {
                $menu->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        }
    }

    protected function appmenu($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
        } else if ($command == 'update') {
        }
    }

    protected function marquee($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['status'] = true;
            $data['created_by'] = $user->id;
            try {
                Marquee::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }
            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert OK');
        } else if ($command == 'update') {
            $marquee = Marquee::find($id);
            try {
                $marquee->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('resellers.index')
                             ->with('update-success', 'update OK');
        }
    }

    protected function startpage($command, Request $request, $id = 0)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($command == 'store') {
            $data['created_by'] = $user->id;
            $data['status'] = true;

            if ($data['mime_type'] == 'image' || $data['mime_type'] == 'i_video') {
                if (!$request->file()) {
                    return redirect()->route('startpages.index')
                                     ->with('error', 'No file upload');
                }
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                if ($data['mime_type'] == 'image' ) {
                    $upload = new ImageUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                } else {
                    $upload = new VideoUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                }
            }

            try {
                Startpage::create($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('insert-error', 'insert error');
            }

            return redirect()->route('resellers.index')
                             ->with('insert-success', 'insert success');
        } else if ($command == 'update') {
            $startpage = Startpage::find($id);
            if ($request->file()) {
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                if ($data['mime_type'] == 'image' ) {
                    $upload = new ImageUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                } else {
                    $upload = new VideoUpload('startpages');
                    $result = $upload->process($result->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                }
            }
            try {
                $startpage->update($data);
            } catch(Exception $e) {
                return redirect()->route('resellers.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('resellers.index')
                             ->with('update-success', 'update success');
        }
    }
}
