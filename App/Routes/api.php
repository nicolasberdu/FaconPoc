<?php

use Facon\Http\Server\Route\Route;
use App\Controllers\WelcomeController;

Route::get("/welcome", [WelcomeController::class, 'index']);