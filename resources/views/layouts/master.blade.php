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
        <footer class="bg-dark text-light py-4">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 text-center" style="margin-left: 20px;"> <!-- Added margin-left -->
                        <p class="m-0">Copyright &copy; Your Website 2025. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-center" style="margin-left: 20px;"> <!-- Added margin-left -->
                        <a href="#!" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#!" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#!" class="text-light"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('website_assets/js/scripts.js')}}"></script>
    </body>
</html>
