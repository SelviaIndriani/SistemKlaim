@extends('layouts.main')

@section('container')
    <!-- Judul Halaman-->
    <h4 class="mb-3">
        Dashboard Klaim
    </h4><!-- Batas Judul Halaman-->

    <section class="section dashboard">

        <!-- Row -->
        <div class="row">

            <!-- Total pelanggan -->
            <div class="col-md-3 col-sm-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <!-- Link menuju halaman customer -->
                        <a href="/listklaim">
                            <h5 class="card-title">Total Klaim <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalKlaim }}</h6><!-- Mengambil data customer dari controller -->
                                    <span class="text-primary small pt-2 ps-1 fw-bold">Lihat selengkapnya</span>
                                </div>
                            </div>
                        </a><!-- Batas Link menuju halaman customer -->
                    </div>
                </div>
            </div><!-- Batas Total Distributor -->
            <!-- Total Distributor -->
            <div class="col-md-3 col-sm-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <!-- Link menuju halaman distributor -->
                        <a href="/distributor">
                            <h5 class="card-title">Total Distributor <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $distributor }}</h6><!-- Mengambil data distributor dari controller -->
                                    <span class="text-success small pt-2 ps-1 fw-bold">Lihat selengkapnya</span>
                                </div>
                            </div>
                        </a><!-- Batas Link menuju halaman distributor -->
                    </div>
                </div>
            </div><!-- Batas Total Distributor -->

            <!-- Total Produk -->
            <div class="col-md-3 col-sm-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <!-- Link menuju halaman produk -->
                        <a href="/produk">
                            <h5 class="card-title">Total Produk </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $produk }}</h6><!-- Mengambil data produk dari controller -->
                                    <span class="text-primary small pt-2 ps-1 fw-bold">Lihat selengkapnya</span>
                                </div>
                            </div>
                        </a><!-- Batas Link menuju halaman produk -->
                    </div>
                </div>
            </div><!-- Batas Total Produk -->

            <!-- Total Kerusakan -->
            <div class="col-md-3 col-sm-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <!-- Link menuju halaman kerusakan -->
                        <a href="/kerusakan">
                            <h5 class="card-title">Total Kerusakan</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $kerusakan }}</h6><!-- Mengambil data kerusakan dari controller -->
                                    <span class="text-success small pt-2 ps-1 fw-bold">Lihat selengkapnya</span>
                                </div>
                            </div>
                        </a><!-- Batas Link menuju halaman kerusakan -->
                    </div>
                </div>
            </div><!-- Batas Total Kerusakan -->

        </div><!-- Batas Row -->

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
                                    <div class="col-md-8">
                                        <select class="form-select form-select-sm mt-1" id="filter-chart"
                                            name="filter-chart">
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
                                <h5 class="card-title text-center" id="title-chart">Klaim Berdasarkan Tahun Produksi Produk
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
                                <table class="table table-bordless w-100 my-datatable-listklaim">
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
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            //fungsi filter atau group by
            document.getElementById("filter-chart").addEventListener("change", function(e) {
                //inisialisai value
                var value = e.target.value

                //merubah value text
                document.getElementById("text").textContent = ' | Berdasarkan ' + value
                //merubah value title-chart
                document.getElementById("title-chart").textContent = value + ' Chart '

                //jika value adalah kerusakan konsumen
                if (value == 'Kerusakan Konsumen') {

                }

                //jika value adalah Produk
                else if (value == 'Distributor') {

                }

                //jika value adalah kerusakan Pabrik
                else if (value == 'Kerusakan Pabrik') {
                    //meng-update data pada series dan lable chart
                    // ApexCharts.exec('mychart', 'updateOptions', {
                    //     data: {{ Js::from($byKPabrik->values()) }},
                    //     name: {{ Js::from($byKPabrik->keys()) }}
                    // });
                }

                //jika value bukan kerusakan Pabrik, kerusakan konsumen dan produk
                else {


                }

            });


        });
    </script>
@endsection
