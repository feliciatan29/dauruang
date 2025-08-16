<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DaurUang - Sistem Informasi Bank Sampah Kota Cirebon</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('nasabah/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('nasabah/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('nasabah/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('nasabah/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('nasabah/css/style.css') }}" rel="stylesheet">

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>


</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light px-0 py-2">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <span class="fa fa-phone-alt me-2"></span>
                    <span>+012 345 6789</span>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <span class="far fa-envelope me-2"></span>
                    <span>info@example.com</span>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <span>Follow Us:</span>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0">DaurUang</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('nasabah.beranda') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('pesananc.pilihjenis') }}" class="nav-item nav-link">Mulai Pesanan</a>
                <a href="{{ route('pesananc.status') }}" class="nav-item nav-link">Pesanan Saya</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profil Saya</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="{{ route('profil') }}" class="dropdown-item">Profil</a>
                        <!-- Logout di Dropdown -->
                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); if(confirm('Apakah kamu yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
            <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Mulai Sekarang<i
                    class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>

    <!-- [ Main Content ] end -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Lokasi Kami</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Ampera xxxxxx</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 xxx xxx xxx</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>Dauruang@xxx</p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Beranda</h4>
                    <a class="btn btn-link" href="">Informasi Saldo</a>
                    <a class="btn btn-link" href="">Pesanan Saya</a>
                    <a class="btn btn-link" href="">Informasi Terbaru</a>
                    <a class="btn btn-link" href="">Artikel Terbaru</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Layanan</h4>
                    <a class="btn btn-link" href="">Beranda</a>
                    <a class="btn btn-link" href="">Mulai Pesan</a>
                    <a class="btn btn-link" href="">Pesanan Saya</a>
                    <a class="btn btn-link" href="">Profil</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">DaurUang</a>
                </div>


            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <!-- CDN Javascript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Library Javascript (gunakan asset karena ini file lokal di /public/lib/...) -->
    <script src="{{ asset('nasabah/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('nasabah/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('nasabah/js/main.js') }}"></script>



</body>

</html>
