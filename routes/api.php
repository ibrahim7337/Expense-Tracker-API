<?php

use Helpers\Router;
use Src\Controllers\TestController;
use Src\Models\TestDBConnection;

Router::get("/api/test", [TestController::class, "index"]);
Router::get("/api/test_db", [TestDBConnection::class, "index"]);
