@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
        <div>
            <h2 class="text-3xl font-bold">
                {{ $eatery->name }}
                @unless ($eatery->is_open)
                    <span class="ml-2 rounded bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Closed</span>
                @endunless
            </h2>
            <p class="text-gray-600">
                <a href="{{ route('districts.show', $eatery->district) }}" class="underline">{{ $eatery->district->name }}</a>
                · {{ $eatery->address }}
            </p>
            <p class="text-gray-600">
                {{ $eatery->priceSign() }}
                @if ($eatery->specialty)
                    · {{ $eatery->specialty }}
                @endif
            </p>
            <div class="mt-2 flex flex-wrap gap-2">
                @foreach ($eatery->features as $feature)
                    <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                       class="rounded-full bg-orange-100 px-2 py-1 text-xs text-orange-800">{{ $feature->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('eateries.edit', $eatery) }}" class="rounded bg-blue-600 px-4 py-2 text-white">Edit</a>
            <form method="POST" action="{{ route('eateries.destroy', $eatery) }}"
                  onsubmit="return confirm('Delete this eatery?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded bg-red-600 px-4 py-2 text-white">Delete</button>
            </form>
        </div>
    </div>

    @if ($eatery->permit)
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <h3 class="font-semibold mb-1">Business Permit</h3>
            <p>Permit no: {{ $eatery->permit->permit_no }}</p>
            <p>Expires: {{ $eatery->permit->expires_on->format('M d, Y') }}</p>
            @if ($eatery->permit->expires_on->lt(today()))
                <p class="font-semibold text-red-600">Permit expired</p>
            @endif
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h3 class="font-semibold mb-2">Dishes</h3>
        <ul class="divide-y">
            @foreach ($eatery->dishes as $dish)
                <li class="flex justify-between py-2">
                    <span>
                        {{ $dish->name }}
                        @if ($dish->is_bestseller)
                            <span class="ml-2 rounded bg-yellow-100 px-2 py-1 text-xs text-yellow-800">Bestseller</span>
                        @endif
                    </span>
                    <span>₱{{ number_format($dish->price, 2) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <h3 class="text-xl font-bold mb-3">Reviews</h3>

    @if ($eatery->is_open)
                <form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}"
              class="bg-white rounded-lg shadow p-4 mb-6">
            @csrf

            @if ($errors->any())
                <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="block font-medium">Reviewer</label>
                <select id="user_id" name="user_id" class="w-full border rounded px-3 py-2">
                    <option value="">Choose a reviewer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="block font-medium">Rating</label>
                <select id="rating" name="rating" class="w-full border rounded px-3 py-2">
                    <option value="">Choose a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} ★</option>
                    @endfor
                </select>
                @error('rating') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="block font-medium">Review</label>
                <textarea id="body" name="body" rows="3" class="w-full border rounded px-3 py-2">{{ old('body') }}</textarea>
                @error('body') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="rounded bg-orange-600 px-4 py-2 text-white hover:bg-orange-700">Post review</button>
        </form>
    @else
        <p class="mb-4 text-gray-600">This eatery is closed. Reviews are paused.</p>
    @endif

    @forelse ($eatery->reviews as $review)
        <div class="bg-white rounded-lg shadow p-4 mb-3">
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold underline">{{ $review->user->name }}</a>
                <x-rating :value="$review->rating" />
                <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
            </div>
            <p class="mt-2">{{ $review->body }}</p>
            <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 underline">Delete</button>
            </form>
        </div>
    @empty
        <p class="text-gray-600">No reviews yet.</p>
    @endforelse
@endsection