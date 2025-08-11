@extends('admin.layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">
        <h2 class="mb-3">Data Nasabah</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profiles as $index => $profile)
                        <tr>
                            <td>{{ $profiles->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ asset($profile->foto ?? 'nasabah/img/user-icon.png') }}"
                                     alt="Foto Profil"
                                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; border:1px solid #ccc;">
                            </td>
                            <td>{{ $profile->user->name ?? '-' }}</td>
                            <td>{{ $profile->user->email ?? '-' }}</td>
                            <td>{{ $profile->tanggal_lahir ?? '-' }}</td>
                            <td>{{ $profile->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $profile->nomor_hp ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data nasabah belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $profiles->links() }}
        </div>
    </div>
</div>

<style>
    .table thead th {
        background-color: #00b14f;
        color: white;
        vertical-align: middle;
    }
    .table tbody td {
        vertical-align: middle;
    }
</style>

@endsection
