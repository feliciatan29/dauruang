@extends('nasabah.layout')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="nasabah/img/home-1.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Mulai dari Sampah Wujudkan
                                        Perubahan</h1>
                                    <a href="" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="nasabah/img/home-1.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Mulai dari Sampah Wujudkan
                                        Perubahan</h1>
                                    <a href="" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Top Feature Start -->
    <div class="container-fluid top-feature py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0 ">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-star fa-3x text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h4 class="mb-0">0</h4>
                                <small>Coin</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-wallet fa-3x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4 class="mb-0">0</h4>
                                <small>Poin</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-history fa-3x text-warning"></i>
                            </div>
                            <div class="ps-3">
                                <a href="#" class="btn btn-sm btn-outline-warning mt-2">Lihat Riwayat</a>
                                <p class="text-muted mt-2 mb-0">Riwayat Transaksi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Feature End -->


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Pesanan Saya</p>
                <h1 class="display-5 mb-5">Yuk, Lihat Status Pesananmu!</h1>
            </div>
            <div class="container py-5">
                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                    <div class="tracking-box text-center rounded py-5 px-4">
                        <div class="tracking-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"></h4>
                            <a href="#">Lihat Riwayat Pesanan &rarr;</a>
                        </div>

                        <div class="tracking-step">
                            <div class="step active">
                                <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                                <a href="{{ route('pesananc.diproses') }}"> Sedang Diproses</a>
                            </div>
                            <div class="step active">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <a href="{{ route('pesananc.diterima') }}"> Telah Diterima</a>
                            </div>
                            <div class="step active">
                                <div class="icon"><i class="bi bi-check-circle"></i></div>
                                <a href="{{ route('pesananc.transaksi_berhasil') }}">Transaksi Berhasil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-end">
                    <div class="col-lg-3 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid rounded" data-wow-delay="0.1s" src="nasabah/img/about-1.jpg">
                    </div>
                    <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                        <h1 class="display-1 text-primary mb-0">#1</h1>
                        <p class="text-primary mb-4">Solusi Sampah Digital</p>
                        <h1 class="display-5 mb-4">Ubah Sampah Jadi Tabungan</h1>
                        <p class="mb-4">Kami membantu Anda menukar sampah menjadi tabungan dan lingkungan yang lebih
                            sehat. Solusi digital pengelolaan sampah yang efisien, praktis, dan ramah lingkungan.</p>
                        <a class="btn btn-primary py-3 px-4" href="">Explore More</a>
                    </div>
                    <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row g-5">
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="border-start ps-4">
                                    <i class="fa fa-award fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">Drop Off</h4>
                                    <span>Layanan penjemputan sampah dari rumah Anda</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="border-start ps-4">
                                    <i class="fa fa-users fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">Company</h4>
                                    <span>Pemesanan penjemputan sampah khusus dari perusahaan atau instansi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Facts Start -->
        <div class="container-fluid facts my-5 py-5" data-parallax="scroll" data-image-src="nasabah/img/home-1.jpeg">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                        <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                        <span class="fs-5 fw-semi-bold text-light">Happy Clients</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                        <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                        <span class="fs-5 fw-semi-bold text-light">Garden Complated</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                        <span class="fs-5 fw-semi-bold text-light">Dedicated Staff</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                        <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                        <span class="fs-5 fw-semi-bold text-light">Awards Achieved</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facts End -->


        <!-- Features Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="fs-5 fw-bold text-primary">Why Choosing Us!</p>
                        <h1 class="display-5 mb-4">Kami Hadir Untuk Anda, Para Pejuang Linkungan</h1>
                        <p class="mb-4">Bank sampah digital adalah solusi pintar untuk menjadikan sampah bernilai. Dengan
                            sistem ini, Anda tak hanya menabung, tapi juga berkontribusi untuk bumi yang lebih bersih</p>
                        <a class="btn btn-primary py-3 px-4" href="">Explore More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="row g-4">
                                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                        <div class="text-center rounded py-5 px-4"
                                            style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                                style="width: 90px; height: 90px;">
                                                <i class="fa fa-check fa-3x text-primary"></i>
                                            </div>
                                            <h4 class="mb-0">Transaksi Otomatis</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                        <div class="text-center rounded py-5 px-4"
                                            style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                                style="width: 90px; height: 90px;">
                                                <i class="fa fa-users fa-3x text-primary"></i>
                                            </div>
                                            <h4 class="mb-0">Penjemputan Terjadwal</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                        style="width: 90px; height: 90px;">
                                        <i class="fa fa-tools fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="mb-0">Pantauan Saldo Mudah</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features End -->


        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <p class="fs-5 fw-bold text-primary">Informasi Terbaru</p>
                    <h1 class="display-5 mb-5">Kabar dan Pengumuman dari DaurUang</h1>
                </div>
                <div class="row g-4">
                    @forelse ($informasis as $info)
                        @php
                            $gambarPath = public_path('Foto_Informasi/' . $info->gambar);
                            $gambarAda = $info->gambar && file_exists($gambarPath);
                            $gambarUrl = $gambarAda
                                ? asset('Foto_Informasi/' . $info->gambar)
                                : asset('img/default.jpg');
                        @endphp
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item rounded d-flex h-100">
                                <div class="service-img rounded">
                                    <img class="img-fluid" src="{{ $gambarUrl }}" alt="{{ $info->judul_informasi }}">
                                </div>
                                <div class="service-text rounded p-4">
                                    <div class="btn-square rounded-circle mx-auto mb-3">
                                        <img class="img-fluid" src="{{ asset('nasabah/img/icon/icon-3.png') }}"
                                            alt="Icon">
                                    </div>
                                    <h5 class="mb-2">{{ $info->judul_informasi }}</h5>
                                    <p class="text-muted small mb-2">
                                        {{ \Carbon\Carbon::parse($info->tgl_informasi)->format('d M Y') }} |
                                        {{ $info->kategori }}
                                    </p>
                                    <p class="mb-3 artikel-content">{{ Str::limit(strip_tags($info->isi_informasi), 100) }}
                                    </p>
                                    <a class="btn btn-sm" href="{{ route('informasi.show', $info->id) }}">
                                        <i class="fa fa-plus text-primary me-2"></i>Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Belum ada informasi yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Recent Posts Section -->
        <section class="container my-5">
            <h2 class="mb-4 text-center fw-bold">Artikel Terbaru</h2>
            <div class="row g-4">
                @foreach ($artikels as $artikel)
                    <div class="col-md-4">
                        <a href="{{ route('artikel.detail', $artikel->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                <img src="{{ asset('Foto_Artikel/' . $artikel->gambar) }}" class="card-img-top"
                                    alt="{{ $artikel->judul_artikel }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold">{{ Str::limit($artikel->judul_artikel, 50) }}</h5>
                                    <p class="card-text text-muted small mb-2">
                                        {{ Str::limit(strip_tags($artikel->isi_artikel), 80) }}
                                    </p>
                                    <small class="text-secondary d-block">
                                        {{ \Carbon\Carbon::parse($artikel->tgl_terbit)->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </section>
        <!-- /Recent Posts Section -->

        <!-- Google Maps Location Start -->
        <div class="container my-5">
            <h4 class="mb-4 text-center">Lokasi Bank Sampah Kota Cirebon</h4>
            <div class="ratio ratio-16x9">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.421940604577!2d108.55412987356212!3d-6.718254965682779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee2703dc70f97%3A0x397473e80ad31ada!2sDinas%20Lingkungan%20Hidup%20Kota%20Cirebon!5e0!3m2!1sid!2sid!4v1749864810267!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- Google Maps Location End -->


        <style>
            .tracking-box {
                box-shadow: 0 0 45px rgba(0, 0, 0, 0.08);
                background-color: #fff;
                border-radius: 16px;
                padding: 30px;
                max-width: 100%;
            }

            .tracking-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
            }

            .tracking-header h4 {
                margin: 0;
                font-size: 20px;
                font-weight: 600;
            }

            .tracking-header a {
                text-decoration: none;
                color: #333;
                font-weight: 500;
            }

            .tracking-step {
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: relative;
                padding: 20px 0;
            }

            .tracking-step::before {
                content: "";
                position: absolute;
                top: 40%;
                /* Tengah container */
                left: calc(15% + 20px);
                right: calc(15% + 20px);
                transform: translateY(-50%);
                height: 2px;
                background-color: rgba(0, 0, 0, 0.1);
                /* Garis samar */
                z-index: 0;
            }

            .step {
                position: relative;
                z-index: 1;
                text-align: center;
                flex: 1;
            }

            .step .icon {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background-color: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 10px;
                font-size: 26px;
                color: #555;
            }

            .step.active .icon {
                background-color: #28a745;
                color: #fff;
            }

            .step p {
                font-size: 14px;
                margin: 0;
                color: #444;
            }

            .artikel-content,
            .judul-artikel {
                display: -webkit-box;
                -webkit-line-clamp: 5;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: normal;
                word-wrap: break-word;
                max-width: 100%;
                /* biar full width di dalam card */
            }

            .card-img-top {
                width: 100%;
                height: 100%;
                object-fit: cover;
                /* agar gambar terisi penuh tanpa distorsi */
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }
        </style>
    @endsection
