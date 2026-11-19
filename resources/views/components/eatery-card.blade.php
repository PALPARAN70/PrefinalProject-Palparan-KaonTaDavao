@props(['eatery'])

<div class="bg-white rounded-lg shadow p-5 flex flex-col gap-2">
    <div class="flex items-start justify-between gap-2">
        <h3 class="text-lg font-semibold">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-orange-600">{{ $eatery->name }}</a>
        </h3>
        @unless ($eatery->is_open)
            <span class="rounded bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Closed</span>
        @endunless
    </div>

    <p class="text-sm text-gray-600">
        <a href="{{ route('districts.show', $eatery->district) }}" class="underline hover:text-orange-600">{{ $eatery->district->name }}</a>
        · {{ $eatery->priceSign() }}
    </p>

    @if ($eatery->specialty)
        <p class="text-sm">{{ $eatery->specialty }}</p>
    @endif

    <div class="flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
               class="rounded-full bg-orange-100 px-2 py-1 text-xs text-orange-800 hover:bg-orange-200">{{ $feature->name }}</a>
        @endforeach
    </div>

    <div class="text-sm">
        @if ($eatery->reviews_count > 0)
            <x-rating :value="$eatery->reviews_avg_rating" />
            {{ number_format($eatery->reviews_avg_rating, 1) }} ★ ({{ $eatery->reviews_count }} {{ Str::plural('review', $eatery->reviews_count) }})
        @else
            No reviews yet
        @endif
    </div>
</div>