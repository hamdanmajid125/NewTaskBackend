<?php

use App\Http\Controllers\post\PostController;
Route::resource('post/post', PostController::class);

use App\Http\Controllers\jobtype\JobTypeController;
Route::resource('jobtype/job-type', JobTypeController::class);
use App\Http\Controllers\availability\AvailabilityController;
Route::resource('availability/availability', AvailabilityController::class);

use App\Http\Controllers\tag\TagController;
Route::resource('tag/tag', TagController::class);