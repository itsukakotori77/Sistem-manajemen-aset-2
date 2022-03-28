<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf_token">
    <title>Sistem Manajemen Aset | SMAN 1 Darangdan</title>
    @include('layouts.linkcss')

    <!-- script -->
    @stack('custom-css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
        <div class="navbar-bg"></div>
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Sidebar -->
            @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Content -->
            @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.footer')
        </div>
    </div>

    <!-- Logout -->
    <form action="{{ url('/logout') }}" method="POST" id="form-logout">{{ csrf_field() }}</form>

  @include('layouts.linkjs')

  @stack('custom-script')

  <!-- Page Specific JS File -->
</body>
</html>
