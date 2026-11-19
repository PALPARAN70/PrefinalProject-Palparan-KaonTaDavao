@extends('layouts.app')

@section('content')
    <section class="mb-10 rounded-3xl bg-teal-700 px-6 py-12 text-white sm:px-12 sm:py-16">
        <p class="text-sm font-bold uppercase tracking-widest text-teal-200">Davao food guide</p>
        <h2 class="mt-3 max-w-2xl text-4xl font-extrabold tracking-tight sm:text-5xl">Find your next favorite carinderia.</h2>
        <p class="mt-4 max-w-xl text-lg text-teal-100">Tinola in Poblacion, kinilaw near Agdao, durian shakes after class. Browse, filter, and review the eateries that keep Davao fed.</p>
        <a href="{{ route('eateries.index') }}"
           class="mt-8 inline-block rounded-lg bg-white px-6 py-3 font-bold text-teal-800 transition hover:bg-teal-50">Browse eateries</a>
    </section>

    <div class="mb-12 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl bg-white p-6 text-center shadow-sm ring-1 ring-slate-200">
            <p class="text-5xl font-extrabold text-teal-600">{{ $eateryCount }}</p>
            <p class="mt-1 font-semibold text-slate-600">Eateries</p>
        </div>
        <div class="rounded-2xl bg-white p-6 text-center shadow-sm ring-1 ring-slate-200">
            <p class="text-5xl font-extrabold text-teal-600">{{ $districtCount }}</p>
            <p class="mt-1 font-semibold text-slate-600">Districts</p>
        </div>
        <div class="rounded-2xl bg-white p-6 text-center shadow-sm ring-1 ring-slate-200">
            <p class="text-5xl font-extrabold text-teal-600">{{ $reviewCount }}</p>
            <p class="mt-1 font-semibold text-slate-600">Reviews</p>
        </div>
    </div>

    <h2 class="mb-6 text-3xl font-extrabold tracking-tight">Top Rated</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($topRated as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection