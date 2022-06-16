<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\ProductCatagoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRecordController;
use App\Http\Controllers\ApkCatagoryController;
use App\Http\Controllers\ApiTestController;
use App\Http\Controllers\LogMessageController;
use App\Http\Controllers\MainVideoController;
use App\Http\Controllers\MediaGroupController;
use App\Http\Controllers\MediaGroupLinkController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\BulletinItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\QACatagoryController;
use App\Http\Controllers\QAListController;
use App\Http\Controllers\AppAdvertisingController;
use App\Http\Controllers\MediaCatagoryController;
use App\Http\Controllers\MediaContentController;
use App\Http\Controllers\ApkProgramController;
use App\Http\Controllers\VoiceSettingController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\OneKeyInstallerController;
use App\Http\Controllers\AppMenuController;
use App\Http\Controllers\AppManagerController;
use App\Http\Controllers\HotAppController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\FrontendViewController;
use App\Http\Controllers\MediaGroupMemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function() {
    return view('home');
})->middleware('auth');

Route::get('/users/project/createpermission', [App\Http\Controllers\UserController::class, 'createpermission'])
      ->name('users.project.createpermission');

Route::post('/users/project/storepermission', [App\Http\Controllers\UserController::class, 'storePermission'])
      ->name('users.project.storepermission');

Route::get('/users/project/editpermission', [App\Http\Controllers\UserController::class, 'editPermission'])
      ->name('users.project.editpermission');

Route::post('/users/project/updatepermission', [App\Http\Controllers\UserController::class, 'updatePermission'])
      ->name('users.project.updatepermission');

Route::get('/users/project/removepermission', [App\Http\Controllers\UserController::class, 'removePermission'])
      ->name('users.project.removepermission');

Route::resource('/users', UserController::class);

Route::get('/profiles/password', [App\Http\Controllers\UserProfileController::class, 'password'])
      ->name('profiles.password');

Route::post('/profiles/changepassword', [App\Http\Controllers\UserProfileController::class, 'changepassword'])
      ->name('profiles.changepassword');

Route::resource('/profiles', UserProfileController::class);

Route::resource('/permissions', UserPermissionController::class);

Route::resource('/projects', ProjectController::class);

Route::resource('/uploadfiles', UploadFileController::class);

Route::resource('/productstatuses', ProductStatusController::class);

Route::resource('/productcatagories', ProductCatagoryController::class);

Route::resource('/producttypes', ProductTypeController::class);

Route::resource('/products', ProductController::class);

Route::resource('/productrecords', ProductRecordController::class);

Route::resource('/apkcatagories', ApkCatagoryController::class);

Route::resource('/apitests', ApiTestController::class);

Route::get('/logmessages/browse', [App\Http\Controllers\LogMessageController::class, 'browse'])
       ->name('logmessages.browse');

Route::resource('/logmessages', LogMessageController::class);

Route::resource('/mainvideos', MainVideoController::class);

Route::resource('/mediagroups', MediaGroupController::class);

Route::resource('/mediagrouplinks', MediaGroupLinkController::class);

Route::get('/logos/browse', [App\Http\Controllers\LogoController::class, 'browse'])
     ->name('logos.browse');

Route::resource('/logos', LogoController::class);

Route::get('/startpages/browse', [App\Http\Controllers\StartpageController::class, 'browse'])
     ->name('startpages.browse');

Route::resource('/startpages', StartpageController::class);

Route::get('/businesses/browse', [App\Http\Controllers\BusinessController::class, 'browse'])
     ->name('businesses.browse');

Route::resource('/businesses', BusinessController::class);

Route::get('/advertisings/browse', [App\Http\Controllers\AdvertisingController::class, 'browse'])
     ->name('advertisings.browse');

Route::resource('/advertisings', AdvertisingController::class);

Route::resource('/bulletins', BulletinController::class);

Route::resource('/bulletinitems', BulletinItemController::class);

Route::resource('/menus', MenuController::class);

Route::resource('/marquees', MarqueeController::class);

Route::resource('/qacatagories', QACatagoryController::class);

Route::resource('/qalists', QAlistController::class);

Route::get('/appadvertisings/browse', [App\Http\Controllers\AppAdvertisingController::class, 'browse'])
     ->name('appadvertisings.browse');

Route::resource('/appadvertisings', AppAdvertisingController::class);

Route::get('/mediacatagories/browse', [App\Http\Controllers\MediaCatagoryController::class, 'browse'])
     ->name('mediacatagories.browse');

Route::resource('/mediacatagories', MediaCatagoryController::class);

Route::get('/mediacontents/browse', [App\Http\Controllers\MediaContentController::class, 'browse'])
     ->name('mediacontents.browse');

Route::resource('/mediacontents', MediaContentController::class);

Route::get('/medias/browse', [App\Http\Controllers\MediaController::class, 'browse'])
     ->name('medias.browse');

Route::resource('/apkprograms', ApkProgramController::class);

Route::resource('/appmenus', AppMenuController::class);

Route::resource('/voicesettings', VoiceSettingController::class);

Route::resource('/appmanagers', AppManagerController::class);

Route::resource('/hotapps', HotAppController::class);

route::resource('/onekeyinstallers', OneKeyInstallerController::class);

Route::resource('/customersupports', CustomerSupportController::class);

Route::resource('/resellers', ResellerController::class);

Route::get('/frontendviews', [App\Http\Controllers\FrontendViewController::class, 'index'])
       ->name('frontendviews.index');

Route::get('/interfaces/logo', [App\Http\Controllers\InterfaceController::class, 'logo'])
     ->name('interfaces.logo');

Route::get('/interfaces/startpage', [App\Http\Controllers\InterfaceController::class, 'startpage'])
     ->name('interfaces.startpage');

Route::get('/interfaces/customLogo', [App\Http\Controllers\InterfaceController::class, 'customLogo'])
     ->name('interfaces.customLogo');

Route::get('/interfaces/ad', [App\Http\Controllers\InterfaceController::class, 'ad'])
     ->name('interfaces.ad');

Route::get('/interfaces/appmenu', [App\Http\Controllers\InterfaceController::class, 'appmenu'])
     ->name('interfaces.appmenu');

Route::get('/interfaces/mainvideo', [App\Http\Controllers\InterfaceController::class, 'mainvideo'])
     ->name('interfaces.mainvideo');

Route::get('/interfaces/menu', [App\Http\Controllers\InterfaceController::class, 'menu'])
     ->name('interfaces.menu');

Route::get('/interfaces/voicesetting', [App\Http\Controllers\InterfaceController::class, 'voicesetting'])
     ->name('interfaces.voicesetting');

Route::get('/interfaces/appmanager', [App\Http\Controllers\InterfaceController::class, 'appmanager'])
     ->name('interfaces.appmanager');

Route::get('/interfaces/hotapp', [App\Http\Controllers\InterfaceController::class, 'hotapp'])
     ->name('interfaces.hotapp');

Route::get('/interfaces/onekeyinstaller', [App\Http\Controllers\InterfaceController::class, 'onekeyinstaller'])
     ->name('interfaces.onekeyinstaller');

Route::get('/interfaces/customersupport', [App\Http\Controllers\InterfaceController::class, 'customersupport'])
     ->name('interfaces.customersupport');

Route::get('/interfaces/marquee', [App\Http\Controllers\InterfaceController::class, 'marquee'])
     ->name('interfaces.marquee');

Route::get('/interfaces/qa', [App\Http\Controllers\InterfaceController::class, 'qa'])
     ->name('interfaces.qa');

Route::get('/interfaces/appad', [App\Http\Controllers\InterfaceController::class, 'appad'])
     ->name('interfaces.appad');

Route::get('/interfaces/apk', [App\Http\Controllers\InterfaceController::class, 'apk'])
     ->name('interfaces.apk');

Route::get('/interfaces/checkdate', [App\Http\Controllers\InterfaceController::class, 'checkdate'])
     ->name('interfaces.checkdate');

Route::get('/interfaces/shopping', [App\Http\Controllers\InterfaceController::class, 'shopping'])
     ->name('interfaces.shopping');

Route::get('/interfaces/homepage', [App\Http\Controllers\InterfaceController::class, 'homepage'])
     ->name('interfaces.homepage');

Route::get('/interfaces/tests', [App\Http\Controllers\InterfaceController::class, 'tests'])
     ->name('interfaces.tests');

Route::resource('/mediagroupmembers', MediaGroupMemberController::class);
