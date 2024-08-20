<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YouTubeVideoModel;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function rate(Request $request, $id)
    {
        $request->validate([
            'user_rating' => 'required|integer|min:1|max:5',
        ]);

        $video = YouTubeVideoModel::findOrFail($id);

        $existingRating = $video->ratings()->where('user_id', Auth::id())->first();

        if ($existingRating) {
            $existingRating->user_rating = $request->input('user_rating');
            $existingRating->save();
        } else {
            $video->ratings()->create([
                'user_id' => Auth::id(),
                'user_rating' => $request->input('user_rating'),
            ]);
        }

        $averageRating = $video->ratings()->avg('user_rating');

        return response()->json(['averageRating' => $averageRating]);
    }
}
