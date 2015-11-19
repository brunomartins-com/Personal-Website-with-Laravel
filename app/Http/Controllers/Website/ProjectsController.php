<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\Handler;

use App\Projects;
use App\ProjectsMovie;

class ProjectsController extends Controller
{
    public function project(Request $request)
    {
        $project = Projects::where('projectsId', '=', $request->projectsId)->first();
        array_add($project, 'slug', Handler::createSlug($project->title, '-'));

        if(count($project->movie) > 0){
            foreach($project->movie as $movie){
                array_add($movie, 'embed', ProjectsMovie::embedVideo($movie->url));
            }
        }
        $project->tags = str_replace(',', ', ', $project->tags);

        return view('website.project')->with(compact('project'));
    }

    /*public function pagination(Request $request)
    {

        $projects = Projects::where('sortorder', '>', $request->lastProjects)
            ->orderBy('sortorder', 'asc')
            ->limit($request->limit)
            ->get();
        $lastProject = 0;
        $newProjects = "";
        foreach($projects as $key => $project){
            $newProjects .= '<div class="'.Projects::bootstrapColumns($key).' latest-projects" data-sort="'.$project->sortorder.'">
                <a href="'.route('projectIndex', [$project->projectDate->format('m'), $project->projectDate->format('Y'), Handler::createSlug($project->title, '-')]).'"
                data-href="'.route('project', [$project->projectsId, Handler::createSlug($project->title, '-')]).'" title="'.$project->title.'">
                    <span class="animate-arrows"></span>
                    <img src="'.url('assets/images/_upload/projects/'.$project->projectsId.'/'.Projects::imagePrefixName($key).$project->image).'" alt="'.$project->title.'" />
                    <span class="title-project">
                        <strong>'.$project->title.'</strong>
                        <em>'.$project->type->projectsTypeName.'</em>
                    </span>
                </a>
            </div>';
            $lastProject = $project->sortorder;
        }
        sleep(2);
        return $newProjects;
        //view('website.project')->with(compact('project'));

    }*/
}