<?php namespace App\Http\Controllers\Admin;

use App\ACL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use App\Projects;
use App\ProjectsType;
use App\ProjectsGallery;
use App\ProjectsMovie;

class ProjectsController extends Controller
{
    public $folder;
    public $largeWidth;
    public $largeHeight;
    public $mediumWidth;
    public $mediumHeight;
    public $smallWidth;
    public $smallHeight;

    public function __construct(){
        $this->folder       = "assets/images/_upload/projects/";
        $this->largeWidth   = 760;
        $this->largeHeight  = 480;
        $this->mediumWidth  = 570;
        $this->mediumHeight = 480;
        $this->smallWidth   = 380;
        $this->smallHeight  = 480;
    }

    public function getIndex()
    {
        if (! ACL::hasPermission('projects')) {
            return redirect(route('home'))->withErrors(['You don\'t have permission for access Projects page.']);
        }

        $projects = Projects::orderBy('sortorder', 'ASC')->get();

        return view('admin.projects.index')->with(compact('projects'));
    }

    public function getAdd()
    {
        if (! ACL::hasPermission('projects', 'add')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for add new project.']);
        }

        $imageDetails = [
            'largeWidth'    => $this->largeWidth,
            'largeHeight'   => $this->largeHeight,
            'mediumWidth'   => $this->mediumWidth,
            'mediumHeight'  => $this->mediumHeight,
            'smallWidth'    => $this->smallWidth,
            'smallHeight'   => $this->smallHeight
        ];

        $projectsType = ['' => 'Choose'];
        $projectsTypeConsult = ProjectsType::orderBy('projectsTypeName', 'ASC')->get();
        foreach ($projectsTypeConsult as $projectType) {
            $projectsType[$projectType['projectsTypeId']] = $projectType['projectsTypeName'];
        }

        return view('admin.projects.add')->with(compact('projectsType', 'imageDetails'));
    }

    public function postAdd(Request $request)
    {
        if (! ACL::hasPermission('projects', 'add')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for add new project.']);
        }

        $this->validate($request, [
            'title'         => 'required|max:50',
            'projectsTypeId'=> 'required',
            'projectDate'   => 'required|date_format:m/d/Y',
            'client'        => 'required|max:50',
            'agency'        => 'required|max:50',
            'description'   => 'required',
            'tags'          => 'required',
            'largeImage'    => 'required',
            'mediumImage'   => 'required',
            'smallImage'    => 'required'
        ]);

        $lastProject = Projects::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();
        $sortorder = isset($lastProject) ? ($lastProject->sortorder+1) : 1;

        $project = new Projects();
        $project->title         = $request->title;
        $project->projectsTypeId= $request->projectsTypeId;
        $project->projectDate   = Carbon::createFromFormat('m/d/Y', $request->projectDate)->format('Y-m-d');
        $project->client        = $request->client;
        $project->agency        = $request->agency;
        $project->description   = $request->description;
        $project->tags          = $request->tags;
        $project->sortorder     = $sortorder;
        //NAME IMAGE
        $extension = $request->largeImage->getClientOriginalExtension();
        $nameImage = Carbon::now()->format('YmdHis').".".$extension;
        $project->image = $nameImage;

        $project->save();

        //CREATED FOLDER WITH projectsId NUMBER
        File::makeDirectory($this->folder.$project->projectsId, 0777);

        //LARGE IMAGE
        $nameLargeImage = "large_".$nameImage;
        $largeImage = Image::make($request->file('largeImage'));
        if($request->largeCropAreaW > 0 or $request->largeCropAreaH > 0 or $request->largePositionX or $request->largePositionY){
            $largeImage->crop($request->largeCropAreaW, $request->largeCropAreaH, $request->largePositionX, $request->largePositionY);
        }
        $largeImage->resize($this->largeWidth, $this->largeHeight)->save($this->folder.$project->projectsId."/".$nameLargeImage);

        //MEDIUM IMAGE
        $nameMediumImage = "medium_".$nameImage;
        $mediumImage = Image::make($request->file('mediumImage'));
        if($request->mediumCropAreaW > 0 or $request->mediumCropAreaH > 0 or $request->mediumPositionX or $request->mediumPositionY){
            $mediumImage->crop($request->mediumCropAreaW, $request->mediumCropAreaH, $request->mediumPositionX, $request->mediumPositionY);
        }
        $mediumImage->resize($this->mediumWidth, $this->mediumHeight)->save($this->folder.$project->projectsId."/".$nameMediumImage);

        //SMALL IMAGE
        $nameSmallImage = "small_".$nameImage;
        $smallImage = Image::make($request->file('smallImage'));
        if($request->smallCropAreaW > 0 or $request->smallCropAreaH > 0 or $request->smallPositionX or $request->smallPositionY){
            $smallImage->crop($request->smallCropAreaW, $request->smallCropAreaH, $request->smallPositionX, $request->smallPositionY);
        }
        $smallImage->resize($this->smallWidth, $this->smallHeight)->save($this->folder.$project->projectsId."/".$nameSmallImage);

        $success = "Project added successfully.";

        return redirect(route('projects'))->with(compact('success'));
    }

    public function getEdit($projectsId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the project.']);
        }

        $imageDetails = [
            'folder'        => $this->folder,
            'largeWidth'    => $this->largeWidth,
            'largeHeight'   => $this->largeHeight,
            'mediumWidth'   => $this->mediumWidth,
            'mediumHeight'  => $this->mediumHeight,
            'smallWidth'    => $this->smallWidth,
            'smallHeight'   => $this->smallHeight
        ];

        $projectsTypeConsult = ProjectsType::orderBy('projectsTypeName', 'ASC')->get();
        foreach ($projectsTypeConsult as $projectType) {
            $projectsType[$projectType['projectsTypeId']] = $projectType['projectsTypeName'];
        }
        $project = Projects::where('projectsId', '=', $projectsId)->first();

        return view('admin.projects.edit')->with(compact('project', 'projectsType', 'imageDetails'));
    }

    public function putEdit(Request $request)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the project.']);
        }

        $this->validate($request, [
            'title'         => 'required|max:50',
            'projectsTypeId'=> 'required',
            'projectDate'   => 'required|date_format:m/d/Y',
            'client'        => 'required|max:50',
            'agency'        => 'required|max:50',
            'description'   => 'required',
            'tags'          => 'required'
        ]);

        $project = Projects::find($request->projectsId);
        $project->title         = $request->title;
        $project->projectsTypeId= $request->projectsTypeId;
        $project->projectDate   = Carbon::createFromFormat('m/d/Y', $request->projectDate)->format('Y-m-d');
        $project->client        = $request->client;
        $project->agency        = $request->agency;
        $project->description   = $request->description;
        $project->tags          = $request->tags;
        //LARGE IMAGE
        if ($request->largeImage) {
            //DELETE OLD LARGE IMAGE
            if($request->currentImage != ""){
                if(File::exists($this->folder.$request->projectsId."/large_".$request->currentImage)){
                    File::delete($this->folder.$request->projectsId."/large_".$request->currentImage);
                }
            }
            $nameLargeImage = "large_".$request->currentImage;

            $largeImage = Image::make($request->file('largeImage'));
            if($request->largeCropAreaW > 0 or $request->largeCropAreaH > 0 or $request->largePositionX or $request->largePositionY){
                $largeImage->crop($request->largeCropAreaW, $request->largeCropAreaH, $request->largePositionX, $request->largePositionY);
            }
            $largeImage->resize($this->largeWidth, $this->largeHeight)->save($this->folder.$request->projectsId."/".$nameLargeImage);
        }
        //MEDIUM IMAGE
        if ($request->mediumImage) {
            //DELETE OLD MEDIUM IMAGE
            if($request->currentImage != ""){
                if(File::exists($this->folder.$request->projectsId."/medium_".$request->currentImage)){
                    File::delete($this->folder.$request->projectsId."/medium_".$request->currentImage);
                }
            }
            $nameMediumImage = "medium_".$request->currentImage;

            $mediumImage = Image::make($request->file('mediumImage'));
            if($request->mediumCropAreaW > 0 or $request->mediumCropAreaH > 0 or $request->mediumPositionX or $request->mediumPositionY){
                $mediumImage->crop($request->mediumCropAreaW, $request->mediumCropAreaH, $request->mediumPositionX, $request->mediumPositionY);
            }
            $mediumImage->resize($this->mediumWidth, $this->mediumHeight)->save($this->folder.$request->projectsId."/".$nameMediumImage);
        }
        //SMALL IMAGE
        if ($request->smallImage) {
            //DELETE OLD SMALL IMAGE
            if($request->currentImage != ""){
                if(File::exists($this->folder.$request->projectsId."/small_".$request->currentImage)){
                    File::delete($this->folder.$request->projectsId."/small_".$request->currentImage);
                }
            }
            $nameSmallImage = "small_".$request->currentImage;

            $smallImage = Image::make($request->file('smallImage'));
            if($request->smallCropAreaW > 0 or $request->smallCropAreaH > 0 or $request->smallPositionX or $request->smallPositionY){
                $smallImage->crop($request->smallCropAreaW, $request->smallCropAreaH, $request->smallPositionX, $request->smallPositionY);
            }
            $smallImage->resize($this->smallWidth, $this->smallHeight)->save($this->folder.$request->projectsId."/".$nameSmallImage);
        }

        $project->save();

        $success = "Project edited successfully.";

        return redirect(route('projects'))->with(compact('success'));
    }

    public function getGallery($projectsId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the project.']);
        }

        $imageDetails = [
            'folder' => $this->folder,
        ];

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $projectGallery = ProjectsGallery::where('projectsId', '=', $projectsId)
            ->orderBy('sortorder', 'ASC')
            ->get();

        return view('admin.projects.gallery')->with(compact('project', 'projectGallery', 'imageDetails'));
    }

    public function postGallery(Request $request)
    {
        if (!ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the project.']);
        }

        $files = $request->file('file');

        foreach($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $nameImage = Carbon::now()->format('YmdHis') . "_" . rand(0, 999999999) . "." . $extension;
            $makeImage = Image::make($file)->resize(713, '', function ($constraint) {
                $constraint->aspectRatio();
            })->save($this->folder . $request->projectsId . "/" . $nameImage);

            $lastGallery = ProjectsGallery::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();
            $sortorder = isset($lastGallery) ? ($lastGallery->sortorder + 1) : 1;

            $gallery = new ProjectsGallery();
            $gallery->projectsId = $request->projectsId;
            $gallery->image = $nameImage;
            $gallery->sortorder = $sortorder;
            $gallery->save();

            if ($makeImage) {
                return json_encode('success', 200);
            } else {
                return json_encode('error', 400);
            }
        }
    }

    public function deleteGallery(Request $request)
    {
        if (! ACL::hasPermission('projects', 'delete')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for delete images of the project.']);
        }

        //DELETE IMAGE BEFORE DELETE IN DATABASE
        if ($request->image) {
            if ($request->image != "") {
                if (File::exists($this->folder . $request->projectsId . "/" . $request->image)) {
                    File::delete($this->folder . $request->projectsId . "/" . $request->image);
                }
            }
        }
        ProjectsGallery::find($request->get('projectsGalleryId'))->delete();

        $success = "Image deleted successfully.";

        return redirect(route('projectsGallery', $request->projectsId))->with(compact('success'));
    }

    public function getGalleryEdit($projectsId, $projectsGalleryId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the gallery of project.']);
        }

        $imageDetails = [
            'folder' => $this->folder,
        ];

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $projectGallery = ProjectsGallery::where('projectsGalleryId', '=', $projectsGalleryId)->first();

        return view('admin.projects.editGallery')->with(compact('project', 'projectGallery', 'imageDetails'));
    }

    public function putGalleryEdit(Request $request)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the gallery of project.']);
        }

        $this->validate($request, [
            'label' => 'max:100'
        ]);

        $gallery = ProjectsGallery::find($request->projectsGalleryId);
        $gallery->label = $request->label;
        $gallery->save();

        $success = "Label edited successfully.";

        return redirect(route('projectsGallery', $request->projectsId))->with(compact('success'));
    }

    public function getGalleryOrder($projectsId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the gallery of project.']);
        }

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $galleries = ProjectsGallery::where('projectsId', '=', $projectsId)
            ->orderBy('sortorder', 'ASC')
            ->get();

        return view('admin.projects.orderGallery')->with(compact('project', 'galleries'));
    }

    public function getMovie($projectsId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit movie the project.']);
        }

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $movies = ProjectsMovie::where('projectsId', '=', $projectsId)
            ->orderBy('sortorder', 'ASC')
            ->get();
        foreach ($movies as $movie) {
            array_add($movie, "image", ProjectsMovie::imageVideo($movie->url));
            array_set($movie, "url", ProjectsMovie::embedVideo($movie->url, 1));
        }

        return view('admin.projects.movie')->with(compact('project', 'movies'));
    }

    public function getMovieAdd($projectsId)
    {
        if (! ACL::hasPermission('projects', 'add')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for add movie of the project.']);
        }

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        return view('admin.projects.addMovie')->with(compact('project'));
    }

    public function postMovieAdd(Request $request)
    {
        if (! ACL::hasPermission('projects', 'add')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for add movie of the project.']);
        }

        $this->validate($request, [
            'label' => 'max:100',
            'url'   => 'required|max:255'
        ]);

        $lastMovie = ProjectsMovie::orderBy('sortorder', 'DESC')->addSelect('sortorder')->first();
        $sortorder = isset($lastMovie) ? ($lastMovie->sortorder + 1) : 1;

        $movie = new ProjectsMovie();
        $movie->projectsId  = $request->projectsId;
        $movie->label       = $request->label;
        $movie->url         = $request->url;
        $movie->sortorder   = $sortorder;
        $movie->save();

        $success = "Movie added successfully.";

        return redirect(route('projectsMovie', $request->projectsId))->with(compact('success'));
    }

    public function getMovieEdit($projectsId, $projectsMovieId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the movie of project.']);
        }

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $projectMovie = ProjectsMovie::where('projectsMovieId', '=', $projectsMovieId)->first();

        return view('admin.projects.editMovie')->with(compact('project', 'projectMovie'));
    }

    public function putMovieEdit(Request $request)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the movie of project.']);
        }

        $this->validate($request, [
            'label' => 'max:100',
            'url'   => 'required|max:255'
        ]);

        $movie = ProjectsMovie::find($request->projectsMovieId);
        $movie->label         = $request->label;
        $movie->url           = $request->url;
        $movie->save();

        $success = "Movie edited successfully.";

        return redirect(route('projectsMovie', $request->projectsId))->with(compact('success'));
    }

    public function deleteMovie(Request $request)
    {
        if (! ACL::hasPermission('projects', 'delete')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for delete movies of the project.']);
        }

        ProjectsMovie::find($request->get('projectsMovieId'))->delete();

        $success = "Movie deleted successfully.";

        return redirect(route('projectsMovie', $request->projectsId))->with(compact('success'));
    }

    public function getMovieOrder($projectsId)
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the movie of project.']);
        }

        $project = Projects::where('projectsId', '=', $projectsId)->first();

        $movies = ProjectsMovie::where('projectsId', '=', $projectsId)
            ->orderBy('sortorder', 'ASC')
            ->get();
        foreach ($movies as $movie) {
            array_add($movie, "image", ProjectsMovie::imageVideo($movie->url));
            array_set($movie, "url", ProjectsMovie::embedVideo($movie->url, 1));
        }

        return view('admin.projects.orderMovie')->with(compact('project', 'movies'));
    }

    public function getOrder()
    {
        if (! ACL::hasPermission('projects', 'edit')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for edit the project.']);
        }

        $projects = Projects::orderBy('sortorder', 'ASC')
            ->addSelect('projectsId')
            ->addSelect('title')
            ->addSelect('sortorder')
            ->get();

        return view('admin.projects.order')->with(compact('projects'));
    }

    public function delete(Request $request)
    {
        if (! ACL::hasPermission('projects', 'delete')) {
            return redirect(route('projects'))->withErrors(['You don\'t have permission for delete the projects.']);
        }

        //DELETE FOLDER BEFORE DELETE IN DATABASE
        $directory = $this->folder.$request->get('projectsId');
        File::deleteDirectory($directory);

        ProjectsGallery::deleteGalleryByProject($request->get('projectsId'));
        ProjectsMovie::deleteMoviesByProject($request->get('projectsId'));
        Projects::find($request->get('projectsId'))->delete();

        $success = "Project deleted successfully.";

        return redirect(route('projects'))->with(compact('success'));
    }
}