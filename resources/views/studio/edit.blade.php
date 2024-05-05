@extends('base')

@section('content')
    <div class="container">
        <h2 class="text-center">Edit studio</h2>
        <hr>
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('studios.update', $studio->id) }}" class="col-md-6">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold text-info">➤ Name</label>
                    <input type="text" class="form-control   fw-bold" name="name" id="name" value="{{ old('name') ? old('name') : $studio->name }}">
                    @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label text-info  fw-bold">➤ Desc</label>
                    <textarea type="text" class="form-control   fw-bold" name="description" id="description">{{ old('description') ? old('description') : $studio->description }}</textarea>
                    @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="established" class="form-label text-info fw-bold">➤ Created</label>
                    <input type="input" class="form-control   fw-bold" name="established" id="established" value="{{ old('established') ? old('established') : $studio->established }}">
                    @error('established')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="text-center my-4">
                    <input type="submit" class="btn btn-primary col-6 my-1" value="Add">
                </div>
            </form>
        </div>
    </div>
@endsection
