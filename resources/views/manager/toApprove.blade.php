@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>List Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/manager"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">To Approve</li>
            </ol>
        </nav>
    </div>
    <!--End Pagetitle -->


    <div class="card">
        <div class="card-body">

            <!-- Title Table -->
            <h5 class="card-title">List Data Klaim</h5>
            <!-- End Title Table -->

            @if ($message = session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- DataTable -->
            <div class="table-responsive-xxl">
                <table class="table table-bordless w-100 " id="my-datatable-toApprove">
                    <thead class="table-success">

                        <tr>
                            <th width="1%"></th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Nama Kerusakan</th>
                            <th class="text-center">Nomor Seri</th>
                            <th class="text-center">Tahun Produksi</th>
                            <th class="text-center">Sisa TD</th>
                            {{-- <th class="text-center">Jumlah (Rp)</th>
            <th class="text-center">Hasil Pabrik</th> --}}
                            <th class="text-center">Hasil Klaim</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- DataTable -->
        </div>
    </div>
@endsection
