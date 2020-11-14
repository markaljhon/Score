<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ScoreCollection;
use App\Models\Score;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/score', function () {
    $scores = Score::whereBetween('created_at', [Carbon::today()->sub('2 days'), Carbon::tomorrow()])->get();
    return new ScoreCollection($scores);
});
