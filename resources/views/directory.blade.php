<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Browser</title>
</head>

<body>
    <h1>Directory Browser</h1>

    <form method="GET" action="{{ route('directory.content', ['path' => $currentPath]) }}">
        <input type="text" name="query" placeholder="Search for files or directories" value="{{ request('query') }}">
        <button type="submit">Search</button>
    </form>

    <nav>
        @if ($currentPath)
            <a href="{{ route('directory.content', ['path' => dirname($currentPath)]) }}">Up One Level</a>
        @else
            <a href="{{ route('directory.content', ['path' => '']) }}">Root Directory</a>
        @endif
    </nav>

    <h2>Directories</h2>
    <ul>
        @foreach ($directories as $directory)
            <li>
                <a href="{{ route('directory.content', ['path' => $currentPath . '\\' . basename($directory)]) }}">
                    {{ basename($directory) }}
                </a>
            </li>
        @endforeach
    </ul>

    <h2>Files</h2>
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ route('file.serve', ['filePath' => urlencode($currentPath . '\\' . basename($file))]) }}"
                    target="_blank">
                    {{ basename($file) }}
                </a>
            </li>
        @endforeach
    </ul>
</body>

</html>
