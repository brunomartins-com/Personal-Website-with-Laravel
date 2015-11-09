<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsGallery extends Model {

    protected $table = 'projectsGallery';

    protected $primaryKey = 'projectsGalleryId';

    public $timestamps = false;

    public static function deleteGalleryByProject($projectsId)
    {
        return self::where('projectsId', $projectsId)->delete();
    }
}