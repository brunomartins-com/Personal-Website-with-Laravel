<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class PagesAdmin extends Model
{
    protected $table = 'pagesAdmin';

    protected $primaryKey = 'pagesAdminId';

    public $timestamps = false;

    public static function permissionsByUser($userId)
    {
        $pages = self::all();

        $noPermission = new Permissions();

        foreach ($pages as &$page) {
            $permission = Permissions::permissionByUserAndPage($userId, $page->pagesAdminId);
            $page->permission = (null == $permission)? $noPermission : $permission;
        }
        return $pages;
    }
}