@extends('layouts.app')

@section('content')
    <h2 class="text-3xl font-extrabold tracking-tight mb-6">Add Eatery</h2>

    <form method="POST" action="{{ route('eateries.store') }}" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-6">
        @csrf
        @include('eateries._form')
        <button type="submit" class="mt-6 rounded bg-teal-600 px-4 py-2 text-white hover:bg-teal-700">Save</button>
    </form>
@endsection