<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }

    /**
     * @param $filename
     * @throws Exception
     * @return array
     */
    public static function readFile($filename)
    {
        try {
            $file = "assets/json/" . $filename;
            $content = file_get_contents($file);
        } catch (Exception $e) {
            throw new Exception("Error open file: " . $e->getMessage());
        }
        return json_decode($content, true);
    }

    /**
     * @param $file
     * @param $content
     * @throws Exception
     */
    public static function writeFile($file, $content)
    {
        $file = "assets/json/" . $file;
        try {
            if (file_exists($file)) {
                unlink($file);
            }

            $fh = fopen($file, 'w+');
            fwrite($fh, $content);
            fclose($fh);

        } catch (Exception $e) {
            throw new Exception("Error open file: " . $e->getMessage());
        }
    }

    /**
     * @param $title
     * @throws Exception
     */
    public static function createSlug($string, $slug = false)
    {
        try {
            $original = array("á","à","ã","ä","â",
                "é","è","ê","ë",
                "í","ì","ï","î",
                "ó","ò","õ","ô","ö",
                "ú","ù","ü","û",
                "ç",
                "Á","À","Ã","Ä","Â",
                "É","À","Ê","Ë",
                "Í","Ì","Ï","Î",
                "Ó","Ò","Õ","Ô","Ö",
                "Ú","Ù","Ü","Û",
                "Ç");
            $normals = array("a","a","a","a","a",
                "e","e","e","e",
                "i","i","i","i",
                "o","o","o","o","o",
                "u","u","u","u",
                "c",
                "a","a","a","a","a",
                "e","e","e","e",
                "i","i","i","i",
                "o","o","o","o","o",
                "u","u","u","u",
                "c");

            $string = str_replace($original, $normals, $string);
            $string = strtolower($string);

            $chars = array ('&','ã ','ã¡','ã¢','ã£','ã¤','ã¥','ã¦','ã§','ã¨','ã©',
                'ãª','ã«','ã¬','ã­','ã®','ã¯','ã°','ã±','ã²','ã³','ã´',
                'ãµ','ã¶','ã¸','ã¹','ãº','ã»','ã¼','ã½','ã¾','ã¿','ã€',
                'ã','ã‚','ãƒ','ã"','ã…','ã†','ã‡','ãˆ','ã‰','ãŠ','ã‹',
                'ãŒ','ã','ãŽ','ã','ã','ã\'','ã\'','ã"','ã"','ã•','ã–',
                'ã˜','ã™','ãš','ã›','ãœ','ã','ãž','â‚¬','"','ãŸ','â¢','â£','â¤','â¥','â¦','â§','â¨','â©','âª','â«',
                'â¬','â­','â®','â¯','â°','â±','â²','â³','â´','âµ','â¶',
                'â·','â¸','â¹','âº','â»','â¼','â½','â¾', ' ', ':',
                '!','@','#','$','%','â¨','&','*','(',')','_','+','[','{','}','\'');

            $entities = array ('e','a','a','a','a','a','a',
                'ae','c','e','e','e','e','i',
                'i','i','i','o','n','o','o',
                'o','o','o','o','u','u','u',
                'u','y','','y','a','a','a',
                'a','a','a','ae','c','e','e',
                'e','e','e','e','e','e','e','n',
                'o','o','o','o','o','o','u',
                'u','u','u','y','-','e','-','b',
                '-','-','c','f','x','y','-','s','-',
                'c','a','-','-','-','r','-','-','-',
                '2','3','-','u','-','-','2','1',
                '-','-','-','-','-', '-', '-',
                '-','-','-','-','-','-','-','-','-','-','-','-',
                '-','-','-', '');

            $string = str_replace($chars, $entities, $string);
            $string = preg_replace("/([^a-z0-9]+)/", "-", $string);
            $string = (substr($string,-1) == "-") ? substr($string,0,-1) : $string;

            if ($slug) {
                $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
                $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
                $string = trim($string, $slug);
            }
            return $string;
        } catch (Exception $e) {
            throw new Exception("Error while slug create: " . $e->getMessage());
        }
    }
}
