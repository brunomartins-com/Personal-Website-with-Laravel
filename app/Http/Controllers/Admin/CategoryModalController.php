<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use DB;

class CategoryModalController extends Controller
{
    public function getIndex(Request $request)
    {
        $modalTitle = $request->modalTitle;
        $modalName = $request->modalName;
        $modalDatabaseTable = $request->modalDatabaseTable;

        $categories = DB::table($request->modalDatabaseTable)
            ->addSelect($request->modalDatabaseTable.'Id AS id')
            ->addSelect($request->modalDatabaseTable.'Name AS title')
            ->orderBy('title')
            ->get();

        return view('admin.categoryModal')->with(compact('categories', 'modalTitle', 'modalName', 'modalDatabaseTable'));
    }

    public function postAdd(Request $request)
    {
        if(!empty($request->databaseTable) and !empty($request->title)){
            $categoryConsult = DB::table($request->databaseTable)
                ->where($request->databaseTable.'Name', '=', $request->title)
                ->count();

            if($categoryConsult > 0){
                $array = array('error'=>1);
            }else{
                $slug = Handler::createSlug($request->title, '-');
                //INSERT
                $category = DB::table($request->databaseTable)
                    ->insert([$request->databaseTable.'Name' => $request->title, $request->databaseTable.'Slug' => $slug]);

                if($category){
                    $array = array('error'=>0);
                }else{
                    $array = array('error'=>2);
                }
            }
        }else{
            $array = array('error'=>3);
        }
        return json_encode($array);
    }

    public function putEdit(Request $request)
    {
        if(!empty($request->databaseTable) and !empty($request->title) and !empty($request->id)){
            $categoryConsult = DB::table($request->databaseTable)
                ->where($request->databaseTable.'Name', '=', $request->title)
                ->where($request->databaseTable.'Id', '!=', $request->id)
                ->count();

            if($categoryConsult > 0){
                $array = array('error'=>1);
            }else{
                $slug = Handler::createSlug($request->title, '-');
                //UPDATE
                $category = DB::table($request->databaseTable)
                    ->where($request->databaseTable.'Id', '=', $request->id)
                    ->update([$request->databaseTable.'Name' => $request->title, $request->databaseTable.'Slug' => $slug]);

                if($category){
                    $array = array('error'=>0, 'data'=>$request->title);
                }else{
                    $array = array('error'=>2);
                }
            }
        }else{
            $array = array('error'=>3);
        }
        return json_encode($array);
    }

    public function delete(Request $request)
    {
        if(!empty($request->databaseTable) and !empty($request->id)){
            //DELETE
            $category = DB::table($request->databaseTable)
                ->where($request->databaseTable.'Id', '=', $request->id)
                ->delete();

            if($category){
                $array = array('error'=>0);
            }else{
                $array = array('error'=>2);
            }
        }else{
            $array = array('error'=>3);
        }
        return json_encode($array);
    }

    public function postRefresh(Request $request)
    {
        $categories = DB::table($request->databaseTable)
            ->addSelect($request->databaseTable.'Id AS id')
            ->addSelect($request->databaseTable.'Name AS title')
            ->orderBy('title')
            ->get();

        return json_encode($categories);
    }
}