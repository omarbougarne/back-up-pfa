@extends('base_login_register')

@section('content')
    <div class="container mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="background-image: linear-gradient(to right, #4b4e51, #3498db);">
                    <div class="card-header fw-bold text-white">Register</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-white fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-white fw-bold">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-white fw-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label text-white fw-bold">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
