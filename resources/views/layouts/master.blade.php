<!DOCTYPE html>
<html lang="en">
    <head>
      @include('layouts.head')
    </head>
    <body>
        <!-- Navigation-->
        @include('layouts.navbar')
        
        @yield('content')
        <!-- Section-->

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('website_assets/js/scripts.js')}}"></script>
    </body>
</html>
