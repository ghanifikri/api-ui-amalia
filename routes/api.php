<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Application;
use App\Models\Notification;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', function () {
    $users = User::all();
    return response()->json(['status' => 200, 'data' => $users]);
});

Route::get('/users/id/{id}', function ($id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['status' => 404, 'message' => 'User ID not found'], 404);
    }

    return response()->json(['status' => 200, 'data' => $user]);
});

Route::get('/users/email/{email}', function ($email) {
    $user = User::where('email', $email)->first();

    if (!$user) {
        return response()->json(['status' => 404, 'message' => 'User not found'], 404);
    }

    return response()->json(['status' => 200, 'data' => $user]);
});

Route::post('/users', [UserController::class, 'store']);

// Route::get('/announcements', function () {
//     $announcements = Announcement::all();
//     return response()->json(['status' => 200, 'data' => $announcements]);
// });

// Route::get('/applications', function () {
//     $applications = Application::all();
//     return response()->json(['status' => 200, 'data' => $applications]);
// });

// Route::get('/notifications', function () {
//     $notifications = Notification::all();
//     return response()->json(['status' => 200, 'data' => $notifications]);
// });