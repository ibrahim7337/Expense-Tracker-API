<?php

use App\Controllers\AuthController;
use Helpers\Router;
use Src\Controllers\TestController;
use Src\Models\TestDBConnection;

Router::get("/api/test", [TestController::class, "index"]);
Router::get("/api/test_db", [TestDBConnection::class, "index"]);

// Authentication
Router::post("/api/login", [AuthController::class, "login"]);
Router::post("/api/register", [AuthController::class, "register"]);
Router::post("/api/logout", [AuthController::class, "logout"]);
