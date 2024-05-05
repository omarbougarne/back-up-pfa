@extends('base')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-white">{{ $user->name }}'s Anime List</h1>
        <div class="row">
            @foreach ($animes as $anime)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $anime->image) }}" class="card-img-top" alt="{{ $anime->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $anime->title }}</h5>
                            <p class="card-text">{{ $anime->synopsis }}</p>
                            <a href="{{ route('animes.show', $anime->id) }}" class="btn btn-primary">Details</a>
                            <form action="{{ route('animes.removeFromUserList', $anime->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove from List</button>
                            </form>
                            {{-- <a href="{{ route('animes.editInUserList', $anime->id) }}" class="btn btn-secondary">Edit in List</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
