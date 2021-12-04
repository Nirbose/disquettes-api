<?php

use Bramus\Router\Router;

require("./vendor/autoload.php");

$router = new Router();

$router->get('/', '\Api\Api@getAll');
$router->get('/info', '\Api\Api@getApi');
$router->get('/all', '\Api\Api@getAll');
$router->get('/random', '\Api\Api@getRandom');
$router->get('/firstname/{firstname}', '\Api\Api@getName');
$router->get('/id/(\d+)', '\Api\Api@getID');

$router->run();
