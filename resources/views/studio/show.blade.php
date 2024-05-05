@extends('base')

@section('content')
    <div class="row mb-2">
        <div class="col-md-4 mx-auto">
            <img src="{{ url("storage/{$studio->image}") }}" class="img-fluid rounded-start" alt="">
        </div>
        <div class="col">
            <h3 class="text-white fw-bold">{{ $studio->name }}</h3>
            <hr>
            <div class="" style="width: 100%;">
                <strong class="text-white">Description:</strong> <br>
                <span class="fs-5 text-white">{{ $studio->description }}</span>
            </div>
            <div class="mt-2 ">
                <strong class="text-white">Created:</strong> <br>
                <span class="fs-5 text-white">{{ $studio->established }}</span>
            </div>



            <ul class="nav justify-content-center mt-3">
                <li class="nav-item">
                    <a href="{{ route('studios.index') }}" class="button-18 color-default">Show</a>
                </li>

                    &nbsp;
                    <li class="nav-item">
                        <a class="button-18 color-default" href="{{ route('studios.edit', $studio->id) }}">Edit</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <form action="{{ route('studios.destroy', $studio->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="button-18 color-remove" type="submit" value="Delete">
                        </form>
                    </li>

            </ul>
        </div>
    </div>
@endsection
