<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addCycleReview(Request $request, $id)
    {
        if($request->rating == null){
            $rating = 1;
        }else{
            $rating = $request->rating;
        }
        $cycle = Cycle::find($id);
        $user = auth()->user();

        $cycle->makeReview($user, $rating, $request->review);

        return back();
    }

    public function addTrainerReview(Request $request, $id)
    {
        if($request->rating == null){
            $rating = 1;
        }else{
            $rating = $request->rating;
        }
        $trainer = Trainer::find($id);
        $user = auth()->user();

        $trainer->makeReview($user, $rating, $request->review);

        return back();
    }
}
