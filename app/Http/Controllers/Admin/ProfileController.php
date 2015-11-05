<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('profile', 'edit')) {
            return redirect(route('profile'))->withErrors(['You don\'t have permission for edit your data.']);
        }

        $user = User::where('id', '=', \Auth::getUser()->id)->first();

        return view('admin.profile.index')->with(compact('user'));
    }

    public function putUpdate(Request $request)
    {
        if (! ACL::hasPermission('profile', 'edit')) {
            return redirect(route('profile'))->withErrors(['You don\'t have permission for edit your data.']);
        }

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'confirmed|min:6|max:12',
        ]);

        $consultEmail = User::where('email', '=', $request->email)->where('id', '!=', $request->userId)->count();
        if($consultEmail > 0){
            $error = "The email has already been taken for another user";
            return redirect(route('users'))->withErrors(compact('error'));
        }

        $user = User::find($request->userId);
        $user->name     = $request->name;
        $user->email    = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $success = "Data edited successfully.";

        return redirect(route('profile'))->with(compact('success'));
    }
}