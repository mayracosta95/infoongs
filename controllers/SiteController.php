<?php
namespace Controllers;

class SiteController extends Controller
{
    public static function home()
    {
        self::view('home');
    }
}