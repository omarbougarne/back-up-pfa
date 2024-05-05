@extends('base')

@section('content')
    <h1 class="fw-bold text-white">Add New Episode</h1>
    <form action="{{ route('episodes.store', ['anime_id' => $anime->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="fw-bold text-white">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="number" class="fw-bold text-white">Episode Number:</label>
            <input type="number" id="number" name="number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="summary" class="fw-bold text-white">Episode Summary:</label>
            <input type="text" id="summary" name="summary" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="air_date" class="fw-bold text-white">Air Date:</label>
            <input type="date" id="air_date" name="air_date" class="form-control" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Create Episode</button>
    </form>
@endsection
