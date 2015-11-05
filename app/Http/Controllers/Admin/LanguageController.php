<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use App\LanguageLevels;
use App\Language;

class LanguageController extends Controller
{
    public $folder;
    public $flagWidth;
    public $flagHeight;

    public function __construct(){
        $this->folder      = "assets/images/_upload/languages/";
        $this->flagWidth   = 16;
        $this->flagHeight  = 16;
    }

    public function getIndex()
    {
        if (! ACL::hasPermission('languages')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access Language page.']);
        }

        $imageDetails = ['folder' => $this->folder];

        $languages = Language::orderBy('sortorder', 'ASC')
            ->addSelect('languageId')
            ->addSelect('languageName')
            ->addSelect('flag')
            ->addSelect('sortorder')
            ->get();

        return view('admin.language.index')->with(compact('languages', 'imageDetails'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('languages', 'add')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for add new language.']);
        }

        $imageDetails = [
            'folder'        => $this->folder,
            'flagWidth'    => $this->flagWidth,
            'flagHeight'   => $this->flagHeight
        ];

        $languageLevelsConsult = LanguageLevels::orderBy('languageLevelsId', 'ASC')->get();
        $languageLevels = ['' => 'Choose'];
        foreach($languageLevelsConsult as $languageLevel){
            $languageLevels[$languageLevel['languageLevelsId']] = $languageLevel['languageLevelsName'];
        }

        return view('admin.language.add')->with(compact('languageLevels', 'imageDetails'));
    }

    public function postAdd(Request $request)
    {
        if (! ACL::hasPermission('languages', 'add')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for add new language.']);
        }

        $this->validate($request, [
            'languageName'  => 'required|max:45',
            'flag'          => 'required|image|mimes:jpeg,bmp,gif,png',
            'write'         => 'required',
            'read'          => 'required',
            'speak'         => 'required',
            'listen'        => 'required'
        ]);

        $lastLanguage = Language::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();
        $sortorder = isset($lastLanguage) ? ($lastLanguage->sortorder+1) : 1;

        $language = new Language();
        $language->languageName = $request->languageName;
        //FLAG
        $extension = $request->flag->getClientOriginalExtension();
        $nameFlag = Carbon::now()->format('YmdHis').".".$extension;
        $img = Image::make($request->file('flag'));
        $img->resize($this->flagWidth, $this->flagHeight)->save($this->folder.$nameFlag);
        $language->flag         = $nameFlag;
        $language->write        = $request->write;
        $language->read         = $request->read;
        $language->speak        = $request->speak;
        $language->listen       = $request->listen;
        $language->sortorder    = $sortorder;

        $language->save();

        $success = "Language added successfully.";

        return redirect(route('languages'))->with(compact('success'));

    }

    public function getEdit($languageId)
    {
        if (! ACL::hasPermission('languages', 'edit')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for edit the language.']);
        }

        $imageDetails = [
            'folder'        => $this->folder,
            'flagWidth'    => $this->flagWidth,
            'flagHeight'   => $this->flagHeight
        ];

        $languageLevelsConsult = LanguageLevels::orderBy('languageLevelsId', 'ASC')->get();
        foreach($languageLevelsConsult as $languageLevel){
            $languageLevels[$languageLevel['languageLevelsId']] = $languageLevel['languageLevelsName'];
        }
        $language = Language::where('languageId', '=', $languageId)->first();

        return view('admin.language.edit')->with(compact('languageLevels', 'language', 'imageDetails'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('languages', 'edit')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for edit the language.']);
        }

        $this->validate($request, [
            'languageName'  => 'required|max:45',
            'flag'          => 'image|mimes:jpeg,bmp,gif,png',
            'write'         => 'required',
            'read'          => 'required',
            'speak'         => 'required',
            'listen'        => 'required'
        ]);

        $language = Language::find($request->languageId);
        $language->languageName = $request->languageName;
        //FLAG
        if ($request->flag) {
            //DELETE OLD PHOTO
            if ($request->currentFlag != "") {
                if (File::exists($this->folder . $request->currentFlag)) {
                    File::delete($this->folder . $request->currentFlag);
                }
            }
            $extension = $request->flag->getClientOriginalExtension();
            $nameFlag = Carbon::now()->format('YmdHis') . "." . $extension;
            $img = Image::make($request->file('flag'));
            $img->resize($this->flagWidth, $this->flagHeight)->save($this->folder . $nameFlag);
            $language->flag = $nameFlag;
        }
        $language->write        = $request->write;
        $language->read         = $request->read;
        $language->speak        = $request->speak;
        $language->listen       = $request->listen;

        $language->save();

        $success = "Language edited successfully.";

        return redirect(route('languages'))->with(compact('success'));

    }

    public function getOrder()
    {
        if (! ACL::hasPermission('languages', 'edit')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for edit the language.']);
        }

        $languages = Language::orderBy('sortorder', 'ASC')
            ->addSelect('languageId')
            ->addSelect('languageName')
            ->addSelect('flag')
            ->addSelect('sortorder')
            ->get();

        return view('admin.language.order')->with(compact('languages'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('languages', 'delete')) {
            return redirect(route('languages'))->withErrors(['You don\'t have permission for delete the languages.']);
        }

        //DELETE CURRENT FLAG
        if ($request->flag != "") {
            if (File::exists($this->folder . $request->flag)) {
                File::delete($this->folder . $request->flag);
            }
        }

        Language::find($request->get('languageId'))->delete();

        $success = "Language deleted successfully.";

        return redirect(route('languages'))->with(compact('success'));
    }
}