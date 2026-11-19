@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Add Eatery</h2>

    <form method="POST" action="{{ route('eateries.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        @include('eateries._form')
        <button type="submit" class="mt-6 rounded bg-orange-600 px-4 py-2 text-white hover:bg-orange-700">Save</button>
    </form>
@endsection