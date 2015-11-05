<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $table = 'language';

    protected $primaryKey = 'languageId';

    public $timestamps = false;

}