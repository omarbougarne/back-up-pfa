{{-- inherit from view base --}}
@extends('base')

{{-- create a section for specific code --}}
@section('content')
    @if (!is_null($studios))
        <table id="tabelaStudios" class="table table-striped" style="padding-top: 10px;">
            <thead>
                <tr class="table-dark" style="background: linear-gradient(to right, #494f55, #3355b0);">
                    <th colspan="4" style="padding-left: 90px;">Studio</th>
                    <th colspan="3" class=" text-white pl-5">Options</th>
                </tr>



                <tr>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Dropped</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studios as $studio)
                    <tr>
                        <td class="align-middle text-center">
                            <img src="{{ url("storage/{$studio->image}") }}" class="img-fluid rounded-circle border border-1" style="width: 6rem; height: auto;">
                        </td>
                        <td class="align-middle text-center fw-bold text-white">{{ $studio->name }}</td>
                        <td class="align-middle text-center fw-bold text-white">{{ $studio->established }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-link text-info" style="text-decoration: none;"><i class="fa-solid fa-circle-info"></i> Show</a>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-link" style="text-decoration: none; color: white; text-shadow: 0 0 3px rgba(0,0,0,0.5);">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        </td>

                        <td class="align-middle text-center">
                            <form action="{{ route('studios.destroy', $studio->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-danger" style="text-decoration: none;" type="submit">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-center">No studio was found!</h3>
    @endif
@endsection
