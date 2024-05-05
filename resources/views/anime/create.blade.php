@extends('base')

@section('content')
    <h2 class="text-center fw-bold text-white">New Anime</h2>
    <hr>
    <form class="row g-3" method="POST" action="{{ route('animes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6 mx-auto">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold text-info">➤ Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-bold text-info">➤ Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label fw-bold text-info">➤ Synopsis</label>
                <textarea class="form-control" name="synopsis" id="synopsis" rows="5" placeholder="And here our story begins..."></textarea>
                @error('synopsis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="studio" class="form-label fw-bold text-info">➤ Studio</label>
                <select class="form-select" name="studio" id="studio">
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="manga_id" class="form-label fw-bold text-info">➤ Manga</label>
                <select class="form-select" name="manga_id" id="manga_id">
                    @foreach ($mangas as $manga)
                        <option value="{{ $manga->id }}">{{ $manga->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label fw-bold text-info">➤ Category</label>
                <select class="form-select" name="category" id="category">
                    <option value="" selected disabled>Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center mt-4">
                <input type="submit" class="btn btn-primary col-6 my-1" value="Add">
            </div>
        </div>
    </form>
@endsection
