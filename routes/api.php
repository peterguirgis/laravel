<?php

use App\Http\Controllers\AuthAPIcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::post("register" , [AuthAPIcontroller::class,'register']);
Route::post("login" , [AuthAPIcontroller::class,'login']);


Route::middleware("auth:sanctum")->group(function(){
    Route::get("logout", [AuthAPIcontroller::class,'logout']);
    Route::prefix("student")->group(function(){
        Route::get("/", [StudentController::class , 'index']);
        Route::post("/", [StudentController::class , 'store'])->name("student.store");
        Route::put("/{id}", [StudentController::class , 'update'])->name("student.update");
        Route::get("/{id}", [StudentController::class , 'show'])->name("student.show");
        Route::delete("/{id}", [StudentController::class , 'destroy'])->name("student.destroy");

    });
});


