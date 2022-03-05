<?php
namespace Controllers;

use Repositories\UserRepository;

class UserController extends Controller
{
    public static function index()
    {
        $user = UserRepository::first(['id' => 1]);

        self::view('users', [
            'user' => $user,
        ]);
    }
}