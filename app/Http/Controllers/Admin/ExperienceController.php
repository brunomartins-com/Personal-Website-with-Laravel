<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Experience;

class ExperienceController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('experience')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access Experience page.']);
        }

        $experiences = Experience::orderBy('sortorder', 'ASC')
            ->addSelect('experienceId')
            ->addSelect('dateStart')
            ->addSelect('dateEnd')
            ->addSelect('position')
            ->addSelect('company')
            ->get();

        return view('admin.experience.index')->with(compact('experiences'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('experience', 'add')) {
            return redirect(route('experience'))->withErrors(['You don\'t have permission for add new experience.']);
        }

        return view('admin.experience.add');
    }

    public function postAdd(Request $request)
    {
        if (! ACL::hasPermission('experience', 'add')) {
            return redirect(route('experience'))->withErrors(['You don\'t have permission for add new experience.']);
        }

        $this->validate($request, [
            'dateStart'     => 'required|date_format:m/d/Y',
            'dateEnd'       => 'date_format:m/d/Y',
            'position'      => 'required|max:50',
            'company'       => 'required|max:50',
            'description'   => 'required'
        ]);

        $experience = new Experience();
        $experience->dateStart      = Carbon::createFromFormat('m/d/Y', $request->dateStart)->format('Y-m-d');
        if(!empty($request->dateEnd)) {
            $experience->dateEnd    = Carbon::createFromFormat('m/d/Y', $request->dateEnd)->format('Y-m-d');
        }
        $experience->position       = $request->position;
        $experience->company        = $request->company;
        $experience->description    = $request->description;
        $experience->save();

        $success = "Experience added successfully.";

        return redirect(route('experience'))->with(compact('success'));
    }

    public function getEdit($experienceId)
    {
        if (! ACL::hasPermission('experience', 'edit')) {
            return redirect(route('experience'))->withErrors(['You don\'t have permission for edit the experience.']);
        }

        $experience = Experience::where('experienceId', '=', $experienceId)->first();

        return view('admin.experience.edit')->with(compact('experience'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('experience', 'edit')) {
            return redirect(route('experience'))->withErrors(['You don\'t have permission for edit the experience.']);
        }

        $this->validate($request, [
            'dateStart'     => 'required|date_format:m/d/Y',
            'dateEnd'       => 'date_format:m/d/Y',
            'position'      => 'required|max:50',
            'company'       => 'required|max:50',
            'description'   => 'required'
        ]);

        $experience = Experience::find($request->experienceId);
        $experience->dateStart      = Carbon::createFromFormat('m/d/Y', $request->dateStart)->format('Y-m-d');
        if(!empty($request->dateEnd)) {
            $experience->dateEnd    = Carbon::createFromFormat('m/d/Y', $request->dateEnd)->format('Y-m-d');
        }
        $experience->position       = $request->position;
        $experience->company        = $request->company;
        $experience->description    = $request->description;
        $experience->save();

        $success = "Experience edited successfully.";

        return redirect(route('experience'))->with(compact('success'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('experience', 'delete')) {
            return redirect(route('experience'))->withErrors(['You don\'t have permission for delete the experience.']);
        }

        Experience::find($request->get('experienceId'))->delete();

        $success = "Experience deleted successfully.";

        return redirect(route('experience'))->with(compact('success'));
    }
}