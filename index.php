<?php

require_once 'Piko.php';

class Main extends App
{
    public function handle(): Response
    {
        return new Response(200, 'Hello World!');
    }
}

Piko::boot(new Main());
