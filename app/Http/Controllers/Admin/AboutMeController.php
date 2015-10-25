<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Exceptions\Handler;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\AboutMe;

class AboutMeController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('aboutMe')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access About Me page.']);
        }

        $aboutMe = AboutMe::orderBy('sortorder', 'ASC')
            ->addSelect('aboutMeId')
            ->addSelect('title')
            ->addSelect('sortorder')
            ->get();

        return view('admin.aboutMe.index')->with(compact('aboutMe'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('aboutMe', 'add')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for add new text.']);
        }

        return view('admin.aboutMe.add');
    }

    public function postAdd(Request $request)
    {
        if (! ACL::hasPermission('aboutMe', 'add')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for add new text.']);
        }

        $this->validate($request, [
            'title'         => 'required|max:45',
            'text'          => 'required'
        ]);

        $lastAboutMe = AboutMe::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();

        $aboutMe = new AboutMe();
        $aboutMe->title     = $request->title;
        $aboutMe->text      = $request->text;
        $aboutMe->sortorder = $lastAboutMe->sortorder+1;

        $aboutMe->save();

        $success = "Text added successfully.";

        return redirect(route('aboutMe'))->with(compact('success'));

    }

    public function getEdit($aboutMeId)
    {
        if (! ACL::hasPermission('aboutMe', 'edit')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for edit the text.']);
        }

        $aboutMe = AboutMe::where('aboutMeId', '=', $aboutMeId)->first();

        return view('admin.aboutMe.edit')->with(compact('aboutMe'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('aboutMe', 'edit')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for edit the text.']);
        }

        $this->validate($request, [
            'title'         => 'required|max:45',
            'text'          => 'required'
        ]);

        $aboutMe = AboutMe::find($request->aboutMeId);
        $aboutMe->title     = $request->title;
        $aboutMe->text      = $request->text;

        $aboutMe->save();

        $success = "Text edited successfully.";

        return redirect(route('aboutMe'))->with(compact('success'));

    }

    public function getOrder()
    {
        if (! ACL::hasPermission('aboutMe', 'edit')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for edit the text.']);
        }

        $aboutMe = AboutMe::orderBy('sortorder', 'ASC')
            ->addSelect('aboutMeId')
            ->addSelect('title')
            ->addSelect('sortorder')
            ->get();

        return view('admin.aboutMe.order')->with(compact('aboutMe'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('aboutMe', 'delete')) {
            return redirect(route('aboutMe'))->withErrors(['You don\'t have permission for delete the text.']);
        }

        AboutMe::find($request->get('aboutMeId'))->delete();

        $success = "Text deleted successfully.";

        return redirect(route('aboutMe'))->with(compact('success'));
    }
}