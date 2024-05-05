@extends('base')

<!-- resources/views/episodes/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Episode</h1>
    <form method="POST" action="{{ route('episodes.update', $episode->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $episode->title }}" required>
        </div>
        <div>
            <label for="number">Number:</label>
            <input type="number" name="number" value="{{ $episode->number }}" required>
        </div>
        <div>
            <label for="air_date">Air Date:</label>
            <input type="date" name="air_date" value="{{ $episode->air_date }}">
        </div>
        <div>
            <label for="summary">Summary:</label>
            <textarea name="summary">{{ $episode->summary }}</textarea>
        </div>
        <button type="submit">Update Episode</button>
    </form>
@endsection
