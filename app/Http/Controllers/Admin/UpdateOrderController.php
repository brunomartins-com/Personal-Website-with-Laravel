<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UpdateOrderController extends Controller
{
    public function postOrder(Request $request)
    {
        //dd($request);
        /* split the value of the sortation */
        $ids = explode(',', $request->sortorder);
        /* run the update query for each id */
        foreach ($ids as $index => $id) {
            $id = (int)$id;
            if ($id != '') {
                DB::update('UPDATE '.$request->databaseTable.' SET sortorder = '.($index + 1).' WHERE '.$request->primaryKey.' = '.$id);
            }
        }
    }
}