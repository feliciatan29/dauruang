@extends('admin.layout')
@section('content')

<!-- CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    body {
        background: linear-gradient(to bottom, #e8f5e9, #ffffff);
        font-family: 'Poppins', sans-serif;
    }
    .card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 6px 18px rgba(76, 175, 80, 0.08);
        transition: transform 0.3s ease;
        margin-bottom: 1.5rem;
    }
    .card:hover {
        transform: translateY(-4px);
    }
    .card-title {
        font-weight: 600;
        color: #2e7d32;
    }
    .icon-box {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background-color: #e8f5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .icon-box i, .icon-box svg {
        width: 28px;
        height: 28px;
        color: #2e7d32;
    }
    .section-header {
        font-size: 1.2rem;
        font-weight: bold;
        border-left: 6px solid #66bb6a;
        padding-left: 12px;
        margin-bottom: 1rem;
    }
    .badge {
        padding: 6px 12px;
        font-size: 0.85rem;
        border-radius: 12px;
        font-weight: 500;
    }
    .btn-success,
    .btn-outline-success {
        font-weight: 500;
    }
</style>

<div class="content-wrapper pb-0">
    <!-- Header -->
    <div class="page-header flex-wrap mb-4" data-aos="fade-down">
        <div class="header-left">
            <a href="{{ route('artikel.index') }}" class="btn btn-success mr-2 mb-2">Artikel</a>
            <a href="{{ route('informasi.index') }}" class="btn btn-outline-success mb-2">Informasi</a>
        </div>
        <div class="header-right mt-2 mt-sm-0">
            <p class="m-0 pr-3 text-muted">Dashboard Bank Sampah</p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row">
        <!-- Total Nasabah -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Nasabah</h5>
                        <p class="text-muted">Update terakhir</p>
                        <h3 class="font-weight-bold counter" data-target="2409">0</h3>
                        <p class="text-success"><i data-lucide="trending-up"></i> 4.5% dibanding bulan lalu</p>
                    </div>
                    <div class="icon-box"><i data-lucide="users"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Penjemputan -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Penjemputan</h5>
                        <p class="text-muted">Dalam sebulan terakhir</p>
                        <h3 class="font-weight-bold counter" data-target="1236">0</h3>
                        <p class="text-warning"><i data-lucide="calendar-days"></i>
                        Jadwal aktif: 5</p>
                    </div>
                    <div class="icon-box"><i data-lucide="truck"></i></div>
                </div>
            </div>
        </div>

        <!-- Jenis Sampah Terbanyak -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Jenis Sampah Terbanyak</h5>
                        <p class="text-muted">Sampah Bulan ini</p>
                        <h3 class="font-weight-bold">Plastik</h3>
                        <p class="text-info"><i data-lucide="archive"></i> 1.240 kg</p>
                    </div>
                    <div class="icon-box"><i data-lucide="archive"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Sampah Terolah -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Sampah Terolah</h5>
                        <p class="text-muted">Sejak awal tahun</p>
                        <h3 class="font-weight-bold counter" data-target="3489">0</h3>
                        <p class="text-primary"><i data-lucide="recycle"></i> dalam kg</p>
                    </div>
                    <div class="icon-box"><i data-lucide="recycle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik & Rasio -->
    <div class="row">
        <!-- Grafik Uang Masuk -->
        <div class="col-md-6" data-aos="zoom-in">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Rekap Uang Masuk Nasabah
                        <i data-lucide="wallet" class="text-success"></i>
                    </h5>
                    <canvas id="chartUangMasuk" height="220"></canvas>
                </div>
            </div>
        </div>

        <!-- Rasio Pengembalian -->
        <div class="col-md-6" data-aos="zoom-in">
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Rasio Pengembalian Sampah
                        <i data-lucide="percent-circle" class="text-success"></i>
                    </h5>
                    <div class="d-flex flex-column align-items-start mt-2">
                        <div class="d-flex align-items-baseline">
                            <h2 class="font-weight-bold text-success mr-2 counter" data-target="{{ $rasioPengembalian ?? 33.5 }}">0</h2>
                            <span class="text-muted">%</span>
                        </div>
                        <p class="text-muted mb-2">Dari total volume sampah yang berhasil diolah kembali.</p>
                        <div class="progress progress-md w-100 mt-1">
                            <div class="progress-bar bg-success" style="width: {{ $rasioPengembalian ?? 33.5 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Artikel & Informasi -->
    <div class="row">
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
                <div class="card-body">
                    <div class="section-header">Artikel & Informasi Terbaru</div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cara Mengelola Sampah Rumah Tangga</td>
                                    <td><span class="badge bg-primary text-white">Artikel</span></td>
                                    <td>02 Juli 2025</td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>Pemberitahuan Jadwal Baru</td>
                                    <td><span class="badge bg-success text-white">Informasi</span></td>
                                    <td>01 Juli 2025</td>
                                    <td><a href="#" class="btn btn-sm btn-outline-success">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>Manfaat Bank Sampah Digital</td>
                                    <td><span class="badge bg-info text-white">Artikel</span></td>
                                    <td>28 Juni 2025</td>
                                    <td><a href="#" class="btn btn-sm btn-outline-info">Lihat</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
    lucide.createIcons();

    // Grafik Uang Masuk
    const ctxUang = document.getElementById('chartUangMasuk').getContext('2d');
    new Chart(ctxUang, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Uang Masuk (Rp)',
                data: [120000, 150000, 130000, 180000, 210000, 250000],
                backgroundColor: '#66bb6a',
                borderColor: '#388e3c',
                borderWidth: 1,
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Rekap Uang Masuk Nasabah per Bulan',
                    color: '#2e7d32',
                    font: { size: 16, weight: 'bold' }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: { ticks: { color: '#388e3c' }, grid: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#388e3c',
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    },
                    grid: { color: '#c8e6c9' }
                }
            }
        }
    });

    // Counter
    document.querySelectorAll('.counter').forEach(counter => {
        const update = () => {
            const target = +counter.getAttribute('data-target');
            const current = +counter.innerText.replace(',', '');
            const increment = target / 100;

            if (current < target) {
                counter.innerText = Math.ceil(current + increment).toLocaleString();
                setTimeout(update, 20);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        update();
    });
</script>

@endsection
