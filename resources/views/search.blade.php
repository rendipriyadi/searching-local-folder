<!DOCTYPE html>
<html>

<head>
    <title>Hasil Pencarian</title>
</head>

<body>
    <h1>Hasil Pencarian</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('search') }}" method="GET">
        @csrf
        <label for="query">Masukkan kata kunci:</label>
        <input type="text" id="query" name="query" value="{{ old('query') }}">
        <button type="submit">Cari</button>
    </form>
</body>

</html>
