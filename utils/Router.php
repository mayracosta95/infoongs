<?php
namespace Utils;

use Controllers\Controller;

class Router
{
    public function __construct(
        public array $routes = []
    ) {}

    public function set(string $url, string $class, string $function)
    {
        $url = rtrim($url, '/');

        if($url == '')
        {
            $this->routes[] = ['url' => 'index.php', 'class' => $class, 'function' => $function];
            $this->routes[] = ['url' => 'index.php/', 'class' => $class, 'function' => $function];
            $this->routes[] = ['url' => '/index.php', 'class' => $class, 'function' => $function];
            $this->routes[] = ['url' => '/index.php/', 'class' => $class, 'function' => $function];
        }

        $this->routes[] = [
            'url' => $url,
            'class' => $class,
            'function' => $function,
        ];

        $url .= '/';
        $this->routes[] = [
            'url' => $url,
            'class' => $class,
            'function' => $function,
        ];
    }

    public function run()
    {
        $urlRequest = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        foreach($this->routes as $r) {
            if($r['url'] == $urlRequest) {
                $r['class']::{$r['function']}();
                exit;
            }
        }
        
        Controller::show404();
    }
}