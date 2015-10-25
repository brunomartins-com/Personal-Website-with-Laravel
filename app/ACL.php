<?php namespace App;

use Redirect;
use Session;

class ACL
{
    protected static $permissions = [];

    public static function hasPermission($pageAdminId, $action = null)
    {
        self::loadPermissions();

        foreach (self::$permissions as $permission) {
            if ($permission->pageAdminId == $pageAdminId && $permission->access){
                if (!is_null($action)){
                    if ($permission->$action == true) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    public static function showErrors()
    {
        return Redirect::back()
            ->withErrors('You don\'t have permission to do this action.')
            ->withInput();
    }

    public static function loadPermissions()
    {
        Session::set('pagesAdmin', Permissions::getUserPermission());

        self::$permissions = Session::get('pagesAdmin');
    }
}