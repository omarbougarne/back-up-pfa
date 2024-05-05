@extends('base')

@section('content')
    <div class="container-fluid" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center text-light display-4 fw-bold mb-5 text-primary">Best <strong class="text-info">animes</strong> DataBase you can create 🌟</h4>
            </div>
            <div class="col-12 py-2">
                <form action="{{ route('animes.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for an anime..." value="{{ request()->query('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> &nbsp; Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 py-2">
            <form action="{{ route('animes.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for an anime..." value="{{ request()->query('search') }}">
                    <div class="input-group-append">
                        <select class="form-select" name="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request()->query('category') == $category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group-append">
                        <select class="form-select" name="studio">
                            <option value="">Select Studio</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->name }}" {{ request()->query('studio') == $studio->name ? 'selected' : '' }}>{{ $studio->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> &nbsp; Search</button>
                </div>
            </form>
        </div>

        @foreach ($animes->groupBy('category') as $category => $animeGroup)
            <div class="row">
                <div class="col-12">
                    <h5 class="fw-bold text-center text-info mb-3" style="border-bottom: 2px solid white; padding-bottom: 5px;">{{ ucfirst($category) }}</h5>

                </div>

                @foreach ($animeGroup as $anime)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <div class="card h-100">

                        <img src="{{ url("storage/{$anime->image}") }}" class="card-img card-img-top" alt="Cover of the anime {{ $anime->title }}">
                        <div class="card-img-overlay d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-end">
                                    <a href="{{ route('animes.show', $anime->id) }}" class="btn btn-primary btn-round" style="width: 49%">
                                        <i class="fa fa-eye"></i>

                                    </a>

                                    @if(Auth::check())
                                        <a href="{{ url('/animes/add/' . $anime->id) }}" class="btn btn-success btn-round" style="width: 49%">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif

                                </div>
                                <div class="card-title text-white fw-bold" style="font-weight: bold;">{{ $anime->title }}</div>

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @endforeach

 <!-- Latest news section -->
<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center text-white mb-4">Latest News</h2>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-12">
                    <img src="https://i.pinimg.com/564x/08/1c/e1/081ce1377cd954a2a7ba98b4117e82a3.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">News Title 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="https://myanimelist.net/news/70995636" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-12">
                    <img src="https://i.pinimg.com/564x/6f/52/61/6f52619c06ddccb7a68aed60b0cedbd5.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">News Title 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="https://myanimelist.net/news/70991670" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-12">
                    <img src="https://i.pinimg.com/564x/19/cf/b8/19cfb8d80d63764c5591068439ea59d6.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">News Title 3</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="https://myanimelist.net/news/70984928" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
