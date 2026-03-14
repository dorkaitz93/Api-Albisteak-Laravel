<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\QueriesController;
use Illuminate\Support\Facades\Route;

Route::get("/albistea", function(){
    return "el BackEnd funciona Correctamente";
});

Route::get("/backend", [BackendController::class, "getAll"]);


Route::get("/backend/{id?}", [BackendController::class, "get"]);
Route::post("/backend", [BackendController::class,"create"]);
Route::put("/backend/{id}", [BackendController::class,"update"]);
Route::delete("/backend/{id}", [BackendController::class,"delete"]);

//Base Datuko Queryxak
Route::get("/query", [QueriesController::class, "get"]);
Route::get("/albisteak/{id}", [QueriesController::class, "getById"]);
Route::get("/query/method/names", [QueriesController::class, "getNames"]);
Route::get("/query/method/search/{izenburua}/{laburpena}", [QueriesController::class, "searchName"]);

Route::apiResource("/albisteak", AlbisteakController::class);


?>