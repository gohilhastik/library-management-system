<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand">

            Library Management System

        </a>

        <div class="text-white">

            @auth

                Welcome,

                {{ Auth::user()->name }}

            @endauth

        </div>

    </div>

</nav>