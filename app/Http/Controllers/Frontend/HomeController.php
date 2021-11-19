<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Cycle;
use App\Models\Trainer;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\Brand;

class HomeController
{
    public function index()
    {

        $cycles = Cycle::limit(5)->get();
        $trainers = Trainer::limit(5)->get();
        $brands = Brand::get();
        $testimonials = Testimonial::where('is_visible', '1')->get();

        return view('frontend.home',compact('cycles','trainers','brands', 'testimonials'));
    }
}
