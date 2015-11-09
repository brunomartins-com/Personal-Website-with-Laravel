<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Skills;

class SkillsController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('skills')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access Skills page.']);
        }

        $skills = Skills::orderBy('sortorder', 'ASC')
            ->addSelect('skillsId')
            ->addSelect('name')
            ->addSelect('sortorder')
            ->get();

        return view('admin.skills.index')->with(compact('skills'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('skills', 'add')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for add new skill.']);
        }

        return view('admin.skills.add');
    }

    public function postAdd(Request $request)
    {
        if (! ACL::hasPermission('skills', 'add')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for add new skill.']);
        }

        $this->validate($request, [
            'name'      => 'required|max:45',
            'comment'   => 'max:45'
        ]);

        $lastSkill = Skills::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();
        $sortorder = isset($lastSkill) ? ($lastSkill->sortorder+1) : 1;

        $skills = new Skills();
        $skills->name       = $request->name;
        $skills->comment    = $request->comment;
        $skills->sortorder  = $sortorder;

        $skills->save();

        $success = "Skill added successfully.";

        return redirect(route('skills'))->with(compact('success'));

    }

    public function getEdit($aboutMeId)
    {
        if (! ACL::hasPermission('skills', 'edit')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for edit the skill.']);
        }

        $skill = Skills::where('skillsId', '=', $aboutMeId)->first();

        return view('admin.skills.edit')->with(compact('skill'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('skills', 'edit')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for edit the skill.']);
        }

        $this->validate($request, [
            'name'      => 'required|max:45',
            'comment'   => 'max:45'
        ]);

        $skills = Skills::find($request->skillsId);
        $skills->name       = $request->name;
        $skills->comment    = $request->comment;

        $skills->save();

        $success = "Skill edited successfully.";

        return redirect(route('skills'))->with(compact('success'));

    }

    public function getOrder()
    {
        if (! ACL::hasPermission('skills', 'edit')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for edit the skill.']);
        }

        $skills = Skills::orderBy('sortorder', 'ASC')
            ->addSelect('skillsId')
            ->addSelect('name')
            ->addSelect('sortorder')
            ->get();

        return view('admin.skills.order')->with(compact('skills'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('skills', 'delete')) {
            return redirect(route('skills'))->withErrors(['You don\'t have permission for delete the skills.']);
        }

        Skills::find($request->get('skillsId'))->delete();

        $success = "Skill deleted successfully.";

        return redirect(route('skills'))->with(compact('success'));
    }
}