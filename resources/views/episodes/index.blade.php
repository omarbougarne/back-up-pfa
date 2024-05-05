@extends('base')

@section('content')
    <h1 class="fw-bold text-white">Episodes List</h1>
    <a href="{{ route('episodes.create', ['anime_id' => $anime->id]) }}" class="btn btn-success">Add New Episode</a>

    <ul class="list-unstyled mt-3">
        @foreach ($episodes as $episode)
            <li class="mb-3">
                <span class="fw-bold text-white">Episode {{ $episode->number }}</span>
                <br>
                <span class="fw-bold text-white">Episode Title:  {{ $episode->title }}</span>
                <br>

                <a href="{{ route('episodes.edit', $episode->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('episodes.destroy', $episode->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Destroy</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
