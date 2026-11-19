@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Districts</h2>

    <ul class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($districts as $district)
            <li class="bg-white rounded-lg shadow p-4">
                <a href="{{ route('districts.show', $district) }}" class="text-lg font-semibold hover:text-orange-600">{{ $district->name }}</a>
                <p class="text-sm text-gray-600">{{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}</p>
            </li>
        @endforeach
    </ul>
@endsection