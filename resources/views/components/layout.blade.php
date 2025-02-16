@props(['webTitle' => 'Book Review'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $webTitle }}
    </title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
@if(session()->has('success'))
    <div class="bg-green-500 text-white font-bold text-lg p-4 rounded-2xl mb-10" >
        {{ session()->get('success') }}
    </div>
@endif
<body class="container mx-auto mt-10 mb-10 max-w-3xl" >
    <main>
        {{ $slot }}
    </main>
</body>
</html>
