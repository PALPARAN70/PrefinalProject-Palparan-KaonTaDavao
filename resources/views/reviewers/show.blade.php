@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-extrabold tracking-tight">{{ $user->name }}</h2>
    <p class="mb-6 text-gray-600">{{ $user->reviews->count() }} {{ Str::plural('review', $user->reviews->count()) }} written</p>

    @foreach ($user->reviews as $review)
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-4 mb-3">
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('eateries.show', $review->eatery) }}" class="font-semibold underline">{{ $review->eatery->name }}</a>
                <x-rating :value="$review->rating" />
            </div>
            <p class="mt-2">{{ $review->body }}</p>
        </div>
    @endforeach
@endsection