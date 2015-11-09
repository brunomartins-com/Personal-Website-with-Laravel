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
        //return $this->belongsTo(ProjectsType::class, 'projectsTypeId', 'projectsTypeId');
    }

    public function gallery()
    {
        return $this->belongsTo(ProjectsGallery::class, 'projectsId', 'projectsId');
    }

    public function movie()
    {
        return $this->belongsTo(ProjectsMovie::class, 'projectsId', 'projectsId');
    }
}