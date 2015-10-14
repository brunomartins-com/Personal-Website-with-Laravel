<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $websiteSettings = \App\Exceptions\Handler::readFile("websiteSettings.json");

        /*
        $sites = $this->site->where('s.entityId', '=', $entityId)
            ->addSelect('s.siteId')
            ->addSelect('s.name')
            ->orderBy('s.name', 'asc')
            ->get();
        */

        return view('website.index')->with(compact('websiteSettings'));
    }
}