<?php
namespace Controllers;

class ProductController extends Controller
{
    public static function index()
    {
        self::view('products');
    }
}