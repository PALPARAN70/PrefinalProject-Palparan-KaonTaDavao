@extends('layouts.app')

@section('content')
    <h2 class="mb-6 text-3xl font-extrabold tracking-tight">Eateries</h2>

    <form method="GET" action="{{ route('eateries.index') }}"
          class="mb-8 grid grid-cols-1 gap-3 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200 md:grid-cols-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or specialty"
               class="rounded-lg border border-slate-300 bg-white px-3 py-2 focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-600/20">

        <select name="district"
                class="rounded-lg border border-slate-300 bg-white px-3 py-2 focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-600/20">
            <option value="">All districts</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>

        <select name="feature"
                class="rounded-lg border border-slate-300 bg-white px-3 py-2 focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-600/20">
            <option value="">All features</option>
            @foreach ($features as $feature)
                <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="rounded-lg bg-teal-600 px-4 py-2 font-bold text-white transition hover:bg-teal-700">Filter</button>
    </form>

    @if ($eateries->isNotEmpty())
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-10">
            {{ $eateries->links() }}
        </div>
    @else
        <p class="rounded-2xl bg-white p-6 text-slate-600 shadow-sm ring-1 ring-slate-200">No eateries match your filters.</p>
    @endif
@endsection