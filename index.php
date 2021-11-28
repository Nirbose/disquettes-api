<?php

use Bramus\Router\Router;

require("./vendor/autoload.php");

$router = new Router();

$router->get('/', '\Api\Api@getAll');
$router->get('/random', '\Api\Api@getRandom');
$router->get('/(\d+)', '\Api\Api@getID');

$router->run();
