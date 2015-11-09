<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsMovie extends Model {

    protected $table = 'projectsMovie';

    protected $primaryKey = 'projectsMovieId';

    public $timestamps = false;

    public static function deleteMoviesByProject($projectsId)
    {
        return self::where('projectsId', $projectsId)->delete();
    }

    /**
     * @param $url
     * @param $play
     * @throws \Exception
     */
    public static function embedVideo($url, $play='false'){
        try {
            $urlVideo = parse_url($url);
            if($urlVideo['host'] == 'www.youtube.com' || $urlVideo['host'] == 'youtube.com' || $urlVideo['host'] == 'youtu.be'){
                return 'http://www.youtube.com/embed/'.self::idYouTube($url).'?autoplay='.$play;
            } else if($urlVideo['host'] == 'www.vimeo.com' || $urlVideo['host'] == 'vimeo.com'){
                return 'http://player.vimeo.com/video/'.self::idVimeo($url).'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$play;
            } else if($urlVideo['host'] == 'www.soundcloud.com' || $urlVideo['host'] == 'soundcloud.com'){
                return 'https://w.soundcloud.com/player/?url='.$url.'&amp;auto_play='.$play.'';
            }
        } catch (\Exception $e) {
            throw new \Exception("Error open URL: " . $e->getMessage());
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public static function imageVideo($url){
        try {
            $urlVideo = parse_url($url);
            if($urlVideo['host'] == 'www.youtube.com' || $urlVideo['host'] == 'youtube.com'){
                $array = explode("&", $urlVideo['query']);
                return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
            }else if($urlVideo['host'] == 'www.youtu.be' || $urlVideo['host'] == 'youtu.be'){
                $array = explode(".be/", $url);
                return "http://img.youtube.com/vi/".substr($array[1],0,11)."/0.jpg";
            } else if($urlVideo['host'] == 'www.instagram.com' || $urlVideo['host'] == 'instagram.com'){
                $justUrl = explode('?', $url);
                if(substr($justUrl[0], -1) == "/"){
                    $complement = "media";
                }else{
                    $complement = "/media";
                }
                return $justUrl[0].$complement;
            } else if($urlVideo['host'] == 'www.vimeo.com' || $urlVideo['host'] == 'vimeo.com'){
                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($urlVideo['path'], 1).".php"));
                return $hash[0]["thumbnail_small"];
            }
        } catch (\Exception $e) {
            throw new \Exception("Error get image: " . $e->getMessage());
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public static function idVimeo($url){
        try {
            $var = explode(".com/", $url);
            $final = substr($var[1],0,8);
            return $final;
        } catch (\Exception $e) {
            throw new \Exception("Error identify video on Vimeo: " . $e->getMessage());
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public static function idYouTube($url){
        try {
            $urlVideo = parse_url($url);
            $final = "";
            if($urlVideo['host'] == 'www.youtube.com' || $urlVideo['host'] == 'youtube.com'){
                $var = explode("watch?v=", $url);
                $final = substr($var[1],0,11);
            }else if($urlVideo['host'] == 'youtu.be'){
                $var = explode(".be/", $url);
                $final = substr($var[1],0,11);
            }
            return $final;
        } catch (\Exception $e) {
            throw new \Exception("Error identify video on Youtube: " . $e->getMessage());
        }
    }
}