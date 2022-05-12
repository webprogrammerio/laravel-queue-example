<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::controller(JobsController::class)->group(function () {
    Route::get("/test-email", "process_queue");
});

Route::get("/", function () {
    return view("welcome");
});
