<?php

use App\Http\Controllers\CategoryApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/login', function () {
    $email = request()->email;
    $password = request()->password;

    if (!$email || !$password) {
        return response(['msg' => 'email or password required'], 403);
    }

    $user = User::where('email', $email)->first();

    if (password_verify($password, $user->password)) {
        return $user->createToken('api')->plainTextToken;
    }

    return response(['msg' => 'incorrect email or password'], 403);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/categories', CategoryApiController::class);
