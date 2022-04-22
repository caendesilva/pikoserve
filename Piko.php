<?php

class Piko
{
    public const VERSION = '1.1.0-dev';

    public static function boot(App $main, ?Closure $callback = null)
    {
        header('Content-Type: application/json');

        $main->handle();

        if ($callback) {
            $callback($main);
        }
    }
}

abstract class App
{
    abstract public function handle(): Response;
}

class Response
{
    public function __construct(int $statusCode = 200, string $statusMessage = 'OK', array $data = [])
    {
        header("HTTP/1.1 $statusCode $statusMessage");

        $response = array_merge([
            'statusCode'    => $statusCode,
            'statusMessage' => $statusMessage,
        ], $data);

        echo json_encode($response);
    }
}

class Request
{
    public array $data;
    public string $method;
    public string $path;

    public function __construct(array $data = [])
    {
        $this->data = $data;

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

    public function __get(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }
}

$request = new Request($_REQUEST);
