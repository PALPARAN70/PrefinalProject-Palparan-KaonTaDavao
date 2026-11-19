<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;

class EateryController extends Controller
{
    public function index(Request $request)
    {
        $eateries = Eatery::with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%' . $request->query('q') . '%';
                $query->where(function ($sub) use ($term) {
                    $sub->where('name', 'like', $term)
                        ->orWhere('specialty', 'like', $term);
                });
            })
            ->when($request->filled('district'), function ($query) use ($request) {
                $query->where('district_id', $request->query('district'));
            })
            ->when($request->filled('feature'), function ($query) use ($request) {
                $query->whereHas('features', function ($sub) use ($request) {
                    $sub->where('name', $request->query('feature'));
                });
            })
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        return view('eateries.index', [
            'eateries' => $eateries,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        // Phase 4
    }

    public function store(Request $request)
    {
        // Phase 4
    }

    public function show(Eatery $eatery)
    {
        $eatery->load([
            'district',
            'features',
            'permit',
            'dishes',
            'reviews' => function ($query) {
                $query->orderByDesc('created_at')->orderByDesc('id')->with('user');
            },
        ]);

        return view('eateries.show', [
            'eatery' => $eatery,
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function edit(Eatery $eatery)
    {
        // Phase 4
    }

    public function update(Request $request, Eatery $eatery)
    {
        // Phase 4
    }

    public function destroy(Eatery $eatery)
    {
        // Phase 4
    }
}