@extends('nasabah.layout')

@section('content')

<div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-5">Pesanan Saya</h1>
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
    top: 40%; /* Tengah container */
    left: calc(15% + 20px);
    right: calc(15% + 20px);
    transform: translateY(-50%);
    height: 2px;
    background-color: rgba(0, 0, 0, 0.1); /* Garis samar */
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
    max-width: 100%; /* biar full width di dalam card */
}

.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover; /* agar gambar terisi penuh tanpa distorsi */
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}


</style>

@endsection