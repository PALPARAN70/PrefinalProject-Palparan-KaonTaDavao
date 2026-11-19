@props(['eatery'])

<article class="flex flex-col gap-3 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="flex items-start justify-between gap-2">
        <h3 class="text-xl font-extrabold tracking-tight">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-teal-600">{{ $eatery->name }}</a>
        </h3>
        @unless ($eatery->is_open)
            <span class="rounded-full bg-slate-900 px-3 py-1 text-xs font-bold text-white">Closed</span>
        @endunless
    </div>

    <p class="text-sm text-slate-600">
        <a href="{{ route('districts.show', $eatery->district) }}" class="font-semibold underline decoration-teal-500 hover:text-teal-600">{{ $eatery->district->name }}</a>
        · <span class="font-bold text-teal-700">{{ $eatery->priceSign() }}</span>
    </p>

    @if ($eatery->specialty)
        <p class="text-sm font-medium">{{ $eatery->specialty }}</p>
    @endif

    <div class="flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
               class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-800 hover:bg-teal-100">{{ $feature->name }}</a>
        @endforeach
    </div>

    <div class="mt-auto border-t border-slate-100 pt-3 text-sm font-semibold">
        @if ($eatery->reviews_count > 0)
            <x-rating :value="$eatery->reviews_avg_rating" />
            {{ number_format($eatery->reviews_avg_rating, 1) }} ★ ({{ $eatery->reviews_count }} {{ Str::plural('review', $eatery->reviews_count) }})
        @else
            <span class="text-slate-500">No reviews yet</span>
        @endif
    </div>
</article>