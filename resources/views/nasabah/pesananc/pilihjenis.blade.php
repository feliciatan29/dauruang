@extends('nasabah.layout')
@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('nasabah/img/home-1.jpeg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Mulai dari Sampah Wujudkan Perubahan</h1>
                                    <a href="#" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('nasabah/img/home-1.jpeg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Mulai dari Sampah Wujudkan Perubahan</h1>
                                    <a href="#" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a>
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

    <!-- Pesanan Section Start -->
<!-- Pesanan Section Start -->
<div class="container py-5">
    <div class="text-center mx-auto wow fadeInUp mb-4" data-wow-delay="0.1s" style="max-width: 500px;">
        <p class="fs-5 fw-bold text-primary">Kenali DaurUang</p>
        <h1 class="display-6 fw-semibold">Pilih Jenis Sampah</h1>
    </div>

   <div class="row g-4">
    {{-- 1. Plastik --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="1" data-harga="1000" data-nama="Plastik">
            <img src="{{ asset('nasabah/img/icon/plastic (2).png') }}" alt="Plastik" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Plastik</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;1.000&nbsp;/&nbsp;kg</p>

                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>

                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Kertas Campur --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="2" data-harga="700" data-nama="Kertas Campur">
            <img src="{{ asset('nasabah/img/icon/paper.png') }}" alt="Kertas" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Kertas Campur</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;700&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Kaca --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="3" data-harga="300" data-nama="Kaca">
            <img src="{{ asset('nasabah/img/icon/bottle (2).png') }}" alt="Kaca" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Kaca</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;300&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Minyak Jelantah --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="4" data-harga="2500" data-nama="Minyak Jelantah">
            <img src="{{ asset('nasabah/img/icon/oil (1).png') }}" alt="Minyak Jelantah" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Minyak Jelantah</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;2.500&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 5. Kaleng Alumunium --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="5" data-harga="3500" data-nama="Kaleng Alumunium">
            <img src="{{ asset('nasabah/img/icon/beer-can (1).png') }}" alt="Kaleng Alumunium" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Kaleng Alumunium</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;3.500&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 6. Kaleng (Steel) --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="6" data-harga="800" data-nama="Kaleng">
            <img src="{{ asset('nasabah/img/icon/box (3).png') }}" alt="Kaleng" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Kaleng</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;800&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 7. Kardus --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="7" data-harga="1000" data-nama="Kardus">
            <img src="{{ asset('nasabah/img/icon/box (2).png') }}" alt="Kardus" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Kardus</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;1.000&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 8. Plastik PET --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="8" data-harga="1500" data-nama="Plastik PET">
            <img src="{{ asset('nasabah/img/icon/plastic (2).png') }}" alt="Plastik PET" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Plastik PET</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;1.500&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 9. Besi --}}
    <div class="col-md-4">
        <div class="d-flex p-3 border rounded shadow-sm align-items-center h-100 bg-white"
             data-id="9" data-harga="4000" data-nama="Besi">
            <img src="{{ asset('nasabah/img/icon/roll (1).png') }}" alt="Besi" width="80" class="me-3 rounded">
            <div class="flex-grow-1">
                <h5 class="mb-1">Besi</h5>
                <p class="text-muted mb-2 small">Rp&nbsp;4.000&nbsp;/&nbsp;kg</p>
                <button class="btn btn-outline-success btn-sm rounded-pill btn-tambah" onclick="tambahItem(this)">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
                <div class="counter-wrapper d-none mt-2">
                    <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="kurangi(this)">-</button>
                    <span class="jumlah px-2">1&nbsp;kg</span>
                    <button class="btn btn-outline-primary btn-sm rounded-circle" onclick="tambah(this)">+</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Ringkasan total jenis & harga -->
    <div id="summaryBox" class="row mt-5 d-none">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center border rounded-pill px-4 py-3 shadow-sm bg-white">
                <div>
                    <small><span id="totalJenis">0</span> jenis | <span id="totalBerat">0</span> kg</small>
                    <div class="fw-bold text-success">Est. Rp <span id="totalHarga">0</span></div>
                </div>
                <button onclick="kirimKeFormulir()" class="btn btn-primary px-4">Lanjut</button>
            </div>
        </div>
    </div>
</div>
<!-- Pesanan Section End -->

<!-- Gaya tambahan -->
<style>
    .counter-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .counter-wrapper .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        font-size: 16px;
    }

    .jumlah {
        font-size: 15px;
        font-weight: 600;
    }

    .btn-tambah:hover {
        background-color: #198754 !important;
        color: white;
    }

    .btn-outline-danger:hover,
    .btn-outline-primary:hover {
        opacity: 0.9;
    }
</style>

<!-- Script Fungsi Tombol & Ringkasan -->
<script>
    let keranjang = {};

    function tambahItem(button) {
        const card = button.closest('[data-id]');
        const id = card.dataset.id;
        const harga = parseInt(card.dataset.harga);

        keranjang[id] = { jumlah: 1, harga: harga };

        button.classList.add('d-none');
        card.querySelector('.counter-wrapper').classList.remove('d-none');

        updateRingkasan();
    }

    function tambah(button) {
        const wrapper = button.parentElement;
        const card = wrapper.closest('[data-id]');
        const id = card.dataset.id;
        const jumlahSpan = wrapper.querySelector('.jumlah');

        let jumlah = parseInt(jumlahSpan.innerText);
        jumlah++;
        jumlahSpan.innerText = jumlah + ' kg';

        keranjang[id].jumlah = jumlah;

        updateRingkasan();
    }

    function kurangi(button) {
        const wrapper = button.parentElement;
        const card = wrapper.closest('[data-id]');
        const id = card.dataset.id;
        const jumlahSpan = wrapper.querySelector('.jumlah');

        let jumlah = parseInt(jumlahSpan.innerText);

        if (jumlah > 1) {
            jumlah--;
            jumlahSpan.innerText = jumlah + ' kg';
            keranjang[id].jumlah = jumlah;
        } else {
            delete keranjang[id];
            wrapper.classList.add('d-none');
            card.querySelector('.btn-tambah').classList.remove('d-none');
        }

        updateRingkasan();
    }

    function updateRingkasan() {
        const totalJenis = Object.keys(keranjang).length;
        let totalKg = 0;
        let totalHarga = 0;

        Object.values(keranjang).forEach(item => {
            totalKg += item.jumlah;
            totalHarga += item.jumlah * item.harga;
        });

        const summaryBox = document.getElementById('summaryBox');
        if (totalJenis > 0) {
            summaryBox.classList.remove('d-none');
            document.getElementById('totalJenis').innerText = totalJenis;
            document.getElementById('totalBerat').innerText = totalKg;
            document.getElementById('totalHarga').innerText = totalHarga.toLocaleString();
        } else {
            summaryBox.classList.add('d-none');
        }
    }

    function kirimKeFormulir() {
    fetch("{{ route('nasabah.pesananc.session') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(keranjang)
    }).then(res => {
        if (res.ok) {
            window.location.href = "{{ route('nasabah.pesananc.form') }}";
        }
    });
}

</script>
@endsection
