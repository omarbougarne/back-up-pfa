@extends('base')

@section('content')
@can('isAdmin')
    <div class="container">
        <h1>Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.softDelete', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Soft Delete</button>
                            </form>

                            @if ($user->deleted_at !== null)
                                <form action="{{ route('admin.users.restore', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endcan
@endsection
