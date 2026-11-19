<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        return view('eateries.create', [
            'eatery' => new Eatery(),
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();

        $eatery = Eatery::create(
            Arr::except($data, ['features', 'permit_no', 'expires_on'])
            + ['slug' => Str::slug($data['name'])]
        );

        $eatery->permit()->create([
            'permit_no' => $data['permit_no'],
            'expires_on' => $data['expires_on'],
        ]);

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery added.');
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
        $eatery->load(['permit', 'features']);

        return view('eateries.edit', [
            'eatery' => $eatery,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $data = $request->validated();

        $eatery->update(
            Arr::except($data, ['features', 'permit_no', 'expires_on'])
            + ['slug' => Str::slug($data['name'])]
        );

        $eatery->permit()->updateOrCreate(
            ['eatery_id' => $eatery->id],
            ['permit_no' => $data['permit_no'], 'expires_on' => $data['expires_on']]
        );

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery)
    {
        // children first, so the foreign keys never block the delete
        $eatery->features()->detach();
        $eatery->reviews()->delete();
        $eatery->dishes()->delete();
        $eatery->permit()->delete();
        $eatery->delete();

        return redirect()->route('eateries.index')->with('success', 'Eatery deleted.');
    }
}