<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\PagesAdmin;
use App\Permissions;

class UsersController extends Controller
{
    public function getIndex()
    {
        if (! ACL::hasPermission('users')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access Users page.']);
        }

        $users = User::where('email', '!=', 'hello@brunomartins.com')
            ->orderBy('name', 'ASC')
            ->addSelect('id')
            ->addSelect('name')
            ->addSelect('email')
            ->get();

        return view('admin.users.index')->with(compact('users'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('users', 'add')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for add new user.']);
        }

        return view('admin.users.add');
    }

    public function postAdd(Request $request)
    {
        if (!ACL::hasPermission('users', 'add')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for add new user.']);
        }

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|max:12',
        ]);

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        $success = "User added successfully.";

        return redirect(route('usersPermissions', $user->id))->with(compact('success'));
    }

    public function getEdit($userId)
    {
        if (! ACL::hasPermission('users', 'edit')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for edit the user.']);
        }

        $user = User::where('id', '=', $userId)->first();

        return view('admin.users.edit')->with(compact('user'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('users', 'edit')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for edit the user.']);
        }

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:255',
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

        $success = "User edited successfully!";

        return redirect(route('users'))->with(compact('success'));
    }

    public function getPermissions($userId)
    {
        if (! ACL::hasPermission('users', 'edit') || ! ACL::hasPermission('users', 'add') || ! ACL::hasPermission('users', 'delete')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for to give permissions users.']);
        }

        $pagesAdmin = PagesAdmin::permissionsByUser($userId);

        $user = User::where('id', '=', $userId)->first();

        return view('admin.users.permissions')->with(compact('pagesAdmin', 'user'));
    }

    public function postPermissions(Request $request)
    {
        //DELETE ALL
        Permissions::deletePermissionByUser($request->userId);
        //RECORD AGAIN
        $this->savePermissionsForUser($request->userId, $request->all());

        $success = "Permissions updated successfully!";

        return redirect(route('users'))->with(compact('success'));
    }

    private function savePermissionsForUser($userId, Array $data)
    {
        $pages = [];

        foreach ($data as $k => $value) {
            $page = explode('@', $k);
            if (! isset($page[1])) {
                continue;
            }
            $pages[$page[0]][$page[1]] = $value;
        }

        foreach ($pages as $pageId => $values) {
            Permissions::create([
                'userId'       => $userId,
                'pageAdminId'   => $pageId,
                'access'        => (isset($values['access']))? $values['access'] : 0,
                'add'           => (isset($values['add']))? $values['add'] : 0,
                'edit'          => (isset($values['edit']))? $values['edit'] : 0,
                'delete'        => (isset($values['delete']))? $values['delete'] : 0
            ]);
        }
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('users', 'delete')) {
            return redirect(route('users'))->withErrors(['You don\'t have permission for delete the users.']);
        }

        Permissions::deletePermissionByUser($request->get('userId'));
        User::find($request->get('userId'))->delete();

        $success = "User deleted successfully.";

        return redirect(route('users'))->with(compact('success'));
    }
}