@extends('layouts.main')

@section('container')
    <!-- Judul Halaman-->
    <h4 class="mb-3">
        Dashboard Klaim
    </h4><!-- Batas Judul Halaman-->

    <section class="section dashboard">

        <!-- Row -->
        @if ($totalKlaim != null)
            <div class="row">
                <div class="col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">

                            <div class="row">

                                <!-- Judul Chart -->
                                <div class="col-md-8">
                                    <h5 class="card-title">Chart Klaim <span id="text"> | Berdasarkan Produk</span></h5>
                                </div><!-- Batas Judul Chart -->

                                <!-- Filter Pengelompokan -->
                                <div class="col-md-4 mt-3">
                                    <div class="row">
                                        <label class="col-md-4 col-form-label">Group by :</label>
                                        <div class="col-md-8" id="filterChart">
                                            <select class="form-select form-select-sm mt-1" id="filterChart"
                                                name="filterChart">
                                                <option value="Produk">Produk</option>
                                                <option value="Kerusakan Konsumen">Kerusakan Konsumen</option>
                                                <option value="Kerusakan Pabrik">Kerusakan Pabrik</option>
                                                <option value="Distributor">Distributor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- Batas Filter Pengelompokan -->

                            </div>

                            <!-- Chart -->
                            <div class="row">
                                <div class="card-body">
                                    <h5 class="card-title text-center" id="titleChart">Chart Klaim Berdasarkan Produk pada
                                        setiap tahun Produksi Produk
                                    </h5>

                                    <!-- Column Chart -->
                                    <div id="columnChart"></div>
                                    <!-- Batas Column Chart -->

                                </div>
                            </div><!-- Batas Chart -->
                        </div>

                    </div>
                </div>
            </div>
        @else
            <p class="text-center p-5">
                Data Klaim Ban Belum tersedia dan belum dapat ditampilkan dalam Chart </p>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Judul Chart -->
                            <div class="col-md-8">
                                <h5 class="card-title">Tabel Data Klaim </h5>
                            </div><!-- Batas Judul Chart -->
                        </div>

                        <div class="row">
                            <!-- DataTable -->
                            <div class="table-responsive-xxl">
                                <table class="table table-bordless w-100 " id="my-datatable-listklaim-manager">
                                    <thead class="table-success w-100">

                                        <tr>
                                            <th></th>
                                            <th class="text-center">ID Klaim</th>
                                            <th class="text-center">Tanggal Klaim</th>
                                            <th class="text-center">Nama Pelanggan</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">ID Kerusakan</th>
                                            <th class="text-center">Nomor Seri</th>
                                            <th class="text-center">Tahun Produksi</th>
                                            <th class="text-center">Sisa TD</th>
                                            <th class="text-center">Jumlah (Rp)</th>
                                            <th class="text-center">Hasil Pabrik</th>
                                            <th class="text-center">Hasil Klaim</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- DataTable -->

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
