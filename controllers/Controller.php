<?php
namespace Controllers;

class Controller
{
    public static function view(string $page, array $vars = [], int $status = 200)
    {
        $_viewPath = APP_PATH . "/views/$page.php";
        $_layoutPath = self::getLayout($page);

        foreach($vars as $k => $v) { $$k = $v; }

        if($_layoutPath) {
            include_once $_layoutPath;
        } else {
            include_once $_viewPath;
        }

        http_response_code($status);
        exit;
    }

    private static function getLayout(string $page)
    {
        foreach(APP_LAYOUTS as $l => $ps) {
            foreach($ps as $p) {
                if($p == $page) return APP_PATH . "/views/layouts/$l.php"; ;
            }
        }
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }

    public static function show404()
    {
        self::view('errors/404', status: 404);
    }

    public static function show500($msgError = "")
    {
        self::view('errors/500', [
            "msgError" => $msgError,
        ], 500);
    }

    public static function dd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit;
    }
}