# 🍦 Pikoserve - A truly tiny framework for PHP microservices

## About

Pico is a unit prefix often used for something extremely tiny. Which is just what Pikoserve is! While it is designed for writing **microservices in PHP** calling it a microframework seems excessive.

Pikoserve came to be in this tweet: https://twitter.com/StressedDev/status/1512860967000059907

At its core, Pikoserve is a starter template for creating tiny stateless API services and is essentially a wrapper for writing and reading JSON responses and sending the proper headers all within a single tiny class.

## Installation
Since it is so lightweight you can get started by just downloading the Piko.php file (or copying and pasting it), then reference it in a PHP file (usually index.php). If you want you can even use the Piko.php file as your index.php code, just place your own code under the Piko class. Though I prefer to keep it separate to reduce clutter.

To get started quickly, you can use Composer or Git.

```bash
composer create-project caendesilva/pikoserve
git clone https://github.com/caendesilva/pikoserve
```

## Usage

Create an index.php file containing the Main class. Require the Piko.php file, and write your code in the Main class. Then call Piko::boot() with the Main class. Piko will then send the headers and execute the handle method and return a JSON Response.

## Setting up a starter project
The only file you need is the Piko.php file, but to get started quickly you can use the starter project in the repo.

You can also use Composer to create a new Piko project. It is not available as a package, since if you are writing something that will be dependent on several packages you will probably need something more sophisticated than Piko anyway.

```bash
# Get started with Composer
composer create-project caendesilva/pikoserve

# Get started with Git
git clone https://github.com/caendesilva/pikoserve
```

This will set you up with the Piko.php file which contains the Piko class, and an index.php file that references it. Speaking of, let's take a look at what it looks like.

### Hello World Example
> This is the index.php file that is shipped with Piko but is shown here again to break down how Piko works.

```php
<?php 

// Include the Piko class
require_once 'Piko.php';

// Define the Main class, all your code should go in here
class Main extends App
{
    public function handle(): Response
    {
        return new Response(200, 'Hello World!');
    }
}

// Boot the Piko application with the Main class
Piko::boot(new Main());
```

This is all you need to run Piko. Seriously.

### Extending Piko
Since Piko is designed to be so minimal, it's up to you to add any functionality you may need. 

However, Piko makes it easy to fluently add functionality by adding a callback to the boot method. 

For example, if you want to add a custom error handler or a server log, you can do so by adding a callback to the boot method.

```php
Piko::boot(new Main, function () {
    file_put_contents('server.log',
        'Server started at ' . date('Y-m-d H:i:s') . PHP_EOL,
        FILE_APPEND);
});
```

The callback is executed after the handle method, i.e. after the headers and JSON response are sent.

> I had an idea that this can be used to load callback modules to easily share these kinds of callbacks.
> If you have any ideas for such micro-packages, please let me know your ideas!
