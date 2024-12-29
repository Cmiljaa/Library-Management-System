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
<body class="bg-blue-100 min-h-screen">
    @auth
        @switch(Auth::user()->role)
            @case('librarian')
            <x-nav-bar :links="['Home' => route('books.index'), 'Members' => route('users.index'), 'Book Loans' => route('book_loans.index')]" />
                @break
            @case('admin')
                <x-nav-bar :links="['ADMIN' => 'home']" />
                @break
            @default
                <x-nav-bar :links="['Home' => route('books.index'), 'My Books' => route('user.book_loans', Auth::user()), 'Notifications' => 'notifications']" />
        @endswitch
    @else
        <x-nav-bar :links="['Login' => route('auth.login'), 'Sign up'=> route('auth.register')]" />
    @endauth
    <div class="min-h-screen">
        @yield('content')
    </div>
    @include('partials.footer')
    @include('partials.nofitications')
    @include('partials.spinner')
</body>
    <script src="https://kit.fontawesome.com/6684d31a4d.js" crossorigin="anonymous"></script>
</html>