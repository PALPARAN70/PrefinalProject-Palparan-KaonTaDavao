<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        return view('districts.index', [
            'districts' => District::withCount('eateries')->orderBy('name')->get(),
        ]);
    }

    public function show(District $district)
    {
        $district->load([
            'eateries' => function ($query) {
                $query->with(['district', 'features'])
                    ->withAvg('reviews', 'rating')
                    ->withCount('reviews')
                    ->orderBy('name');
            },
        ]);
        $district->loadCount('reviews');

        return view('districts.show', ['district' => $district]);
    }
}