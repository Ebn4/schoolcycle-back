<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/announcements/filter',[AnnouncementController::class,'filterAnnouncement']);
Route::get('/announcements/heigt',[AnnouncementController::class,'getHeight']);
Route::apiResource('/announcements',AnnouncementController::class);
