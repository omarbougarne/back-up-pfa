<form action="{{ isset($manga) ? route('mangas.update', $manga) : route('mangas.store') }}" method="POST">
    @csrf
    @isset($manga)
        @method('PUT')
    @endisset

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $manga->name ?? '' }}">

    <button type="submit">{{ isset($manga) ? 'Update' : 'Create' }}</button>
</form>
