<?php

use Src\Controllers\AuthController;
use Helpers\Router;

// Authentication
Router::post("/api/login", [AuthController::class, "login"]);
Router::post("/api/register", [AuthController::class, "register"]);
Router::post("/api/logout", [AuthController::class, "logout"]);
