@extends('base')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}'s Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                    <span>{{ substr($user->name, 0, 1) }}</span>
                </div>
            @endif
            <h1 class="fw-bold text-white">{{ $user->name }}'s Anime List</h1>
        </div>

        <!-- Buttons for Update and Delete Profile -->
        <div class="mb-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Update Profile</a>
            <form action="{{ route('profile.destroy') }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Profile</button>
            </form>
        </div>

        <!-- Filter by Status -->
        <div class="mb-3">
            <form action="{{ route('animes.user_list') }}" method="GET">
                <select class="form-select" name="status">
                    <option value="">Select Status</option>
                    <option value="plan to watch" {{ request()->query('status') == 'plan to watch' ? 'selected' : '' }}>Plan to Watch</option>
                    <option value="completed" {{ request()->query('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="dropped" {{ request()->query('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
        </div>

        <div class="row">
            @foreach ($animes as $anime)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $anime->image) }}" class="card-img-top" alt="{{ $anime->title }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anime->title }}</h5>
                        <p class="card-text">{{ $anime->synopsis }}</p>
                        <a href="{{ route('animes.show', $anime->id) }}" class="btn btn-primary">Details</a>
                        <form action="{{ route('animes.removeFromUserList', $anime->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove from List</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>
@endsection
