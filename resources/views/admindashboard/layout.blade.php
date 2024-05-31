<!DOCTYPE html>
<html lang="en">
<head>
    @include('admindashboard.head')
</head>
<body class="g-sidenav-show  bg-gray-100">
    @include('admindashboard.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('admindashboard.navbar')
    @yield('content')
    </main>

    @include('admindashboard.fixedplugin')
    
    @include('admindashboard.footer')
</body>
</html>
