<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model {

    protected $table = 'websiteSettings';

    protected $primaryKey = 'websiteSettingsId';

    public $timestamps = false;

}