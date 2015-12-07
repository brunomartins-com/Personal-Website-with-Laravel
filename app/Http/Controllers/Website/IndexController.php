<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;

use App\Projects;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        if($request->getRequestUri() != '/'){
            $buttonClick = $request->getUri();
        }

        //WEBSITE SETTINGS
        $websiteSettings = Handler::readFile("websiteSettings.json");

        $projects = Projects::orderBy('sortorder', 'asc')->get();
        $lastProject = 0;
        foreach($projects as $key => $project){
            array_add($project, 'bootstrapColumn', Projects::bootstrapColumns($key));
            array_add($project, 'imagePrefixName', Projects::imagePrefixName($key));
            array_add($project, 'slug', Handler::createSlug($project->title, '-'));
            $lastProject = $project->sortorder;
        }

        return view('website.index')->with(compact('websiteSettings', 'projects', 'lastProject', 'buttonClick'));
    }
}