<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\updateUserInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/announcements/heigt',[AnnouncementController::class,'getHeight']);
    Route::apiResource('/announcements',AnnouncementController::class)->except(['index','show']);
    Route::post('/users/edit',[updateUserInfoController::class,'update']);
    Route::post('/users/password',[updateUserInfoController::class,'updatePassword']);
});

Route::get('/announcements/filter',[AnnouncementController::class,'filterAnnouncement']);
require __DIR__.'/auth.php';

