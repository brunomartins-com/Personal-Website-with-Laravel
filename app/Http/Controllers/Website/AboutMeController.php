<?php namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AboutMe;
use App\Experience;
use App\Skills;
use App\Language;
use App\LanguageLevels;

class AboutMeController extends Controller
{
    public function index()
    {
        $websiteSettings = \App\Exceptions\Handler::readFile("websiteSettings.json");

        $aboutMe = AboutMe::orderBy('sortorder', 'asc')->get();
        $experiences = Experience::orderBy('dateStart', 'desc')->get();
        $skills = Skills::orderBy('sortorder', 'asc')->get();
        $languages = Language::orderBy('sortorder', 'asc')->get();
        //foreach($languages as $language):
        //dd($language->writeName);
        //endforeach;

        return view('website.aboutme')->with(compact('websiteSettings', 'aboutMe', 'experiences', 'skills', 'languages'));
    }
}