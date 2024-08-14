<?php

use Hellm\XenonBank\base\BaseRouter;
use Hellm\XenonBank\controller\TestController;

$route = new BaseRouter();

$route->add("GET", "/test/{id}", [TestController::class, "index"]);
$route->add("GET", "/test", [TestController::class, "test"]);

$route->dispatch();
