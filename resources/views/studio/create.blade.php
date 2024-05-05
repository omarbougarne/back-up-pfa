@extends('base')

@section('content')
    <h2 class="text-center fw-bold text-white">New Studio</h2>
    <hr>
    <div class="row">
        <form method="POST" action="{{ route('studios.store') }}" enctype="multipart/form-data">
            {{-- protection against cross-site request forgering --}}
            @csrf
            <div class="mb-2 col-6 mx-auto">
                <label for="name" class="form-label fw-bold text-info">➤ Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder=" name">
                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="image" class="form-label fw-bold text-info">➤ Image</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}" placeholder="Select image">
                @error('image')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="description" class="form-label fw-bold text-info">➤ Description</label>
                <textarea type="text" class="form-control" name="description" id="description" placeholder=" description">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2 col-6 mx-auto">
                <label for="established" class="form-label fw-bold text-info">➤ Created at</label>
                <input type="input" class="form-control" name="established" id="established" value="{{ old('established') }}" placeholder=" creation date">
                @error('established')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="text-center my-4 col-12 mx-auto">
                <input type="submit" class="btn btn-primary col-6 my-1" value="Add">
            </div>
        </form>
    </div>
@endsection
