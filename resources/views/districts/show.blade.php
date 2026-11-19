@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold">{{ $district->name }}</h2>
    <p class="mb-6 text-gray-600">{{ $district->reviews_count }} {{ Str::plural('review', $district->reviews_count) }} in {{ $district->name }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($district->eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection