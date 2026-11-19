@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-extrabold tracking-tight mb-6">Edit {{ $eatery->name }}</h2>

    <form method="POST" action="{{ route('eateries.update', $eatery) }}" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-6">
        @csrf
        @method('PUT')
        @include('eateries._form')
        <button type="submit" class="mt-6 rounded bg-teal-600 px-4 py-2 text-white hover:bg-teal-700">Update</button>
    </form>
@endsection