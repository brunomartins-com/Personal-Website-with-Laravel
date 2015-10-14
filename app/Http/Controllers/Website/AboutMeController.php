<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    public function index()
    {
        /*
        $sites = $this->site->where('s.entityId', '=', $entityId)
            ->addSelect('s.siteId')
            ->addSelect('s.name')
            ->orderBy('s.name', 'asc')
            ->get(); */

        return view('website.aboutme');
    }
}