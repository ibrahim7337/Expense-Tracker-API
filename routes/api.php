<?php

use Helpers\Router;
use Src\Controllers\TestController;

Router::get("/api/test", [TestController::class, "index"]);