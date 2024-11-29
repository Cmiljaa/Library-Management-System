<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Management System</title>
    <link rel="icon" href="{{asset('img/books-stack-of-three.svg')}}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-100 min-h-screen flex flex-col">
    <div class="flex-grow">
        @yield('content')
    </div>
    @include('partials.footer')
    @include('partials.nofitications')
</body>
    <script src="https://kit.fontawesome.com/6684d31a4d.js" crossorigin="anonymous"></script>
</html>