<?php

use App\Jobs\CreateUserJob;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/total', function () {
    return response()->json(["users" => ["total" => User::all()->count()]]);
});

Route::get('/users/job', function () {
    CreateUserJob::dispatch();
    return response()->json(["msg" => "Job despachado com sucesso!"]);
});

Route::get('/users/job-multiple', function () {
    for($i=0;$i<100;$i++) {
        CreateUserJob::dispatch()->onQueue('default');
    }
    return response()->json(["msg" => "Job's despachado com sucesso!"]);
});

Route::get('/users/job-delay', function () {
    CreateUserJob::dispatch()->delay(now()->addMinute());
    return response()->json(["msg" => "Job despachado com sucesso!"]);
});