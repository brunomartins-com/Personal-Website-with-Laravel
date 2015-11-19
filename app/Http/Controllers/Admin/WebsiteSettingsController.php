<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Exceptions\Handler;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use League\Flysystem\Filesystem;
use Carbon\Carbon;

use App\WebsiteSettings;

class WebsiteSettingsController extends Controller
{
    public $websiteSettingsId;
    public $logotypeWidth;
    public $logotypeHeight;
    public $faviconWidth;
    public $faviconHeight;
    public $avatarWidth;
    public $avatarHeight;
    public $appleTouchIconWidth;
    public $appleTouchIconHeight;

    public function __construct(){
        $this->websiteSettingsId    = 1;
        $this->logotypeWidth        = 217;
        $this->logotypeHeight       = 76;
        $this->faviconWidth         = 16;
        $this->faviconHeight        = 16;
        $this->avatarWidth          = 250;
        $this->avatarHeight         = 250;
        $this->appleTouchIconWidth  = 129;
        $this->appleTouchIconHeight = 129;

    }
    public function getIndex()
    {
        if (! ACL::hasPermission('websiteSettings', 'edit')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for edit the website settings.']);
        }

        $imagesSize = [
            'logotypeWidth'         => $this->logotypeWidth,
            'logotypeHeight'        => $this->logotypeHeight,
            'faviconWidth'          => $this->faviconWidth,
            'faviconHeight'         => $this->faviconHeight,
            'avatarWidth'           => $this->avatarWidth,
            'avatarHeight'          => $this->avatarHeight,
            'appleTouchIconWidth'   => $this->appleTouchIconWidth,
            'appleTouchIconHeight'  => $this->appleTouchIconHeight
        ];

        $websiteSettings = WebsiteSettings::where('websiteSettingsId', '=', $this->websiteSettingsId)->first();

        return view('admin.websiteSettings.index')->with(compact('websiteSettings', 'imagesSize'));
    }

    public function putUpdate(Request $request, $folder = "assets/images/_upload/websiteSettings/")
    {

        if (! ACL::hasPermission('websiteSettings', 'edit')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for edit the website settings.']);
        }

        $this->validate($request, [
            'title'         => 'required|max:50',
            'description'   => 'required|max:200',
            'email'         => 'required|email|max:50',
            'keywords'      => 'required'
        ]);

        $websiteSettings = WebsiteSettings::find($this->websiteSettingsId);
        $websiteSettings->title         = $request->title;
        $websiteSettings->description   = $request->description;
        $websiteSettings->keywords      = $request->keywords;
        $websiteSettings->phone         = $request->phone;
        $websiteSettings->email         = $request->email;
        $websiteSettings->city          = $request->city;
        $websiteSettings->state         = $request->state;
        $websiteSettings->country       = $request->country;
        $websiteSettings->github        = $request->github;
        $websiteSettings->linkedin      = $request->linkedin;

        if ($request->logotype) {
            //DELETE OLD LOGOTYPE
            if($request->currentLogotype != ""){
                if(File::exists($folder.$request->currentLogotype)){
                    File::delete($folder.$request->currentLogotype);
                }
            }
            $extension = $request->logotype->getClientOriginalExtension();
            $nameLogotype = "logo-brunomartins.".$extension;

            Image::make($request->file('logotype'))->resize($this->logotypeWidth, $this->logotypeHeight)->save($folder.$nameLogotype);

            $websiteSettings->logotype = $nameLogotype;
        }
        if ($request->favicon) {
            //DELETE OLD FAVICON
            if($request->currentFavicon != ""){
                if(File::exists($folder.$request->currentFavicon)){
                    File::delete($folder.$request->currentFavicon);
                }
            }
            $extension = $request->favicon->getClientOriginalExtension();
            $nameFavicon = "favicon.".$extension;

            Image::make($request->file('favicon'))->resize($this->faviconWidth, $this->faviconHeight)->save($folder.$nameFavicon);

            $websiteSettings->favicon = $nameFavicon;
        }
        if ($request->avatar) {
            //DELETE OLD AVATAR
            if($request->currentAvatar != ""){
                if(File::exists($folder.$request->currentAvatar)){
                    File::delete($folder.$request->currentAvatar);
                }
            }
            $extension = $request->avatar->getClientOriginalExtension();
            //$nameAvatar = Carbon::now()->format('YmdHis').".".$extension;
            $nameAvatar = "avatar.".$extension;

            $img = Image::make($request->file('avatar'));
            if($request->avatarCropAreaW > 0 or $request->avatarCropAreaH > 0 or $request->avatarPositionX or $request->avatarPositionY){
                $img->crop($request->avatarCropAreaW, $request->avatarCropAreaH, $request->avatarPositionX, $request->avatarPositionY);
            }
            $img->resize($this->avatarWidth, $this->avatarHeight)->save($folder.$nameAvatar);

            $websiteSettings->avatar = $nameAvatar;
        }
        if ($request->appleTouchIcon) {
            //DELETE OLD APPLE TOUCH ICON
            if($request->currentAppleTouchIcon != ""){
                if(File::exists($folder.$request->currentAppleTouchIcon)){
                    File::delete($folder.$request->currentAppleTouchIcon);
                }
            }
            $extension = $request->appleTouchIcon->getClientOriginalExtension();
            $nameAppleTouchIcon = "apple-touch-icon.".$extension;

            Image::make($request->file('appleTouchIcon'))->resize($this->appleTouchIconWidth, $this->appleTouchIconHeight)->save($folder.$nameAppleTouchIcon);

            $websiteSettings->appleTouchIcon = $nameAppleTouchIcon;
        }

        //WRITE JSON
        Handler::writeFile("websiteSettings.json", json_encode($websiteSettings));

        $websiteSettings->save();

        $success = "Website settings edited successfully.";

        return redirect(route('websiteSettings'))->with(compact('success'));

    }
}