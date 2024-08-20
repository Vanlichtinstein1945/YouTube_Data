<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\YouTubeChannelsModel;
use App\Models\YouTubeVideoModel;
use App\Models\YouTubeUserVideoModel;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    $channels = YouTubeChannelsModel::all();

    return view('index', ['channels' => $channels]);
});

Route::get('/channel/{id}', function($id) {
    $channel = YouTubeChannelsModel::with('videos')->findOrFail($id);

    return view('channel', ['channel' => $channel]);
});

Route::get('/video/{id}', function($id) {
    $video = YouTubeVideoModel::with('channel')->findOrFail($id);
    $user_rating = null;
    $averageRating = 0;

    if (Auth::check()) {
        $user_rating = YouTubeUserVideoModel::where('user_id', Auth::id())
            ->where('video_id', $id)
            ->value('user_rating');
    }

    $averageRating = YouTubeUserVideoModel::where('video_id', $id)
        ->avg('user_rating');

    return view('video', ['video' => $video, 'userRating' => $user_rating, 'averageRating' => $averageRating]);
});

Route::post('/video/{id}/rate', [VideoController::class, 'rate'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
