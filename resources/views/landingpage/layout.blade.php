<!DOCTYPE html>
<html lang="en">
<head>
    @include('landingpage.head')
</head>
<body>
    @include('landingpage.header')
    @include('landingpage.navbar')
    
    @if($header)
        @include('landingpage.carousel')
    @endif
    
    @yield('content')
    @include('landingpage.footer')
</body>
</html>
