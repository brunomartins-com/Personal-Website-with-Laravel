<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model {

    protected $table = 'experience';

    protected $primaryKey = 'experienceId';

    protected $dates = ['dateStart', 'dateEnd'];

    public $timestamps = false;

}