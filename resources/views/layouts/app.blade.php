<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    @include('partials.navbar')

    <div class="container-fluid mt-3">

        <div class="row">

            <div class="col-md-3">

                @include('partials.sidebar')

            </div>

            <div class="col-md-9">

                @yield('content')

            </div>

        </div>

    </div>

    @include('partials.footer')

</body>

</html>