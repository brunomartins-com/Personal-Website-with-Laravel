<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        return view('admin.home.index');
    }
}