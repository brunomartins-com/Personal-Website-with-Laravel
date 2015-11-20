<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model {

    protected $table = 'projects';

    protected $primaryKey = 'projectsId';

    protected $dates = ['projectDate'];

    public $timestamps = false;

    public function type()
    {
        return $this->hasOne('App\ProjectsType', 'projectsTypeId', 'projectsTypeId');
    }

    public function gallery()
    {
        return $this->hasMany(ProjectsGallery::class, 'projectsId', 'projectsId')->orderBy('sortorder', 'asc');
    }

    public function movie()
    {
        return $this->hasMany(ProjectsMovie::class, 'projectsId', 'projectsId')->orderBy('sortorder', 'asc');
    }

    public static function bootstrapColumns($key)
    {
        for($x=$key; $x>7; $x -= 8){ }
        if($key > 7){
            $key = $x;
        }
        if($key == 0 or $key == 5) {
            return "col-lg-3 col-md-3 col-sm-6 col-xs-7";
        }else if($key == 4) {
            return "col-lg-2 col-md-2 col-sm-6 col-xs-5";
        }else if ($key == 1 or $key == 2 or $key == 7) {
            return "col-lg-2 col-md-2 col-sm-3 col-xs-5";
        }else if ($key == 3 or $key == 6) {
            return "col-lg-5 col-md-5 col-sm-6 col-xs-7";
        }
    }

    public static function imagePrefixName($key)
    {
        for($x=$key; $x>7; $x -= 8){ }
        if($key > 7){
            $key = $x;
        }
        if($key == 0 or $key == 5) {
            return "medium_";
        }else if($key == 4) {
            return "medium_";
        }else if ($key == 1 or $key == 2 or $key == 7) {
            return "small_";
        }else if ($key == 3 or $key == 6) {
            return "large_";
        }
    }
}