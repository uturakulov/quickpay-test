<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ClientApplicationInvite;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
