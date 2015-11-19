<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $table = 'language';

    protected $primaryKey = 'languageId';

    public $timestamps = false;

    public function writeName()
    {
        return $this->hasOne('App\LanguageLevels', 'languageLevelsId', 'write');
    }

    public function readName()
    {
        return $this->hasOne('App\LanguageLevels', 'languageLevelsId', 'read');
    }

    public function speakName()
    {
        return $this->hasOne('App\LanguageLevels', 'languageLevelsId', 'speak');
    }

    public function listenName()
    {
        return $this->hasOne('App\LanguageLevels', 'languageLevelsId', 'listen');
    }
}