@extends('layouts.main')

@section('container')
    <!-- Judul Halaman -->
    <div class="pagetitle">
        <h5>Detail Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/teknisi"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/teknisi">List Klaim</a></li>
                <li class="breadcrumb-item active">{{ $klaim->id }}</a></li>
            </ol>
        </nav>
    </div><!-- Batas Judul Halaman -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-9">
                <div class="card info-card sales-card">

                    <!-- Cetak PDF -->
                    <div class="filter">
                        <a class="icon" href="/teknisi/cetakPdf/{{ $klaim->id }}">Cetak PDF <i
                                class="bi bi-file-pdf"></i></a>
                    </div><!-- Batas Cetak PDF -->

                    <div class="card-body">

                        <!-- Judul -->
                        <h5 class="card-title">Detail Data Klaim</h5>
                        <!-- Batas Judul -->

                        <div class="row d-flex justify-content-between ">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col">
                                        <b>ID Pelanggan</b>
                                    </div>
                                    <div class="col">
                                        : {{ $klaim->customer_id }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Nama</b>
                                    </div>
                                    <div class="col">
                                        : {{ $klaim->customer_nama }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Alamat</b>
                                    </div>
                                    <div class="col">
                                        <label>
                                            : {{ $klaim->customer_alamat }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col">
                                        <b>ID Klaim</b>
                                    </div>
                                    <div class="col">
                                        <label>
                                            : {{ $klaim->id }}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Tanggal Klaim</b>
                                    </div>
                                    <div class="col">:
                                        {{ Carbon\Carbon::parse($klaim->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <b>Dicek Oleh</b>
                                    </div>
                                    <div class="col">: {{ $klaim->checking_by }}</div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- Table -->
                        <div class="table-responsive-xxl">
                            <table class="table table-bordered mt-6">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Nomor Seri</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">MM Awal</th>
                                        <th scope="col">MM Akhir</th>
                                        <th scope="col">Sisa TD (%)</th>
                                        <th scope="col">Kode Kerusakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $klaim->product_id }}</td>
                                        <td>{{ $klaim->product_nama }}</td>
                                        <td>{{ $klaim->no_seri }}</td>
                                        <td>{{ $klaim->tahun_produksi }}</td>
                                        <td>{{ $klaim->mm_awal }}</td>
                                        <td>{{ $klaim->mm_akhir }}</td>
                                        <td>{{ round(($klaim->mm_akhir / $klaim->mm_awal) * 100) }}%</td>
                                        <td>{{ $klaim->damage_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Bordered Table -->

                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <div class="col-12">
                                    <label for="penjelasan" class="form-label fw-bold">Penjelasan</label>
                                    <textarea id="penjelasan" name="penjelasan" class="form-control" id="penjelasan" style="height: 110px" disabled>{{ $klaim->keterangan_klaim }}</textarea>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dokumentasi</h5>
                        <div class="row d-flex">
                            @foreach ($img as $image)
                                <div class="col-md-6 mb-3 flex-fill">
                                    <div class="thumbnail">
                                        <div class="img-container">
                                            <img src="{{ asset('imgKlaim/' . $image->image) }}" class="img-fluid"
                                                data-bs-toggle="modal" data-bs-target="#imageModal">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Dokumentasi pengajuan Klaim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">

                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('imgKlaim/' . $img[0]->image) }}" height="500px"
                                    class="d-block w-80 img-fluid" alt="$img[0]->nama">
                            </div>
                            @foreach ($img->skip(1) as $image)
                                <div class="carousel-item ">
                                    <img src="{{ asset('imgKlaim/' . $image->image) }}" height="500px"
                                        class="d-block w-80 img-fluid" alt="$image->nama">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <div class="rounded-circle p-2 text-bg-secondary">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </div>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <div class="rounded-circle p-2 text-bg-secondary">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </div>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
