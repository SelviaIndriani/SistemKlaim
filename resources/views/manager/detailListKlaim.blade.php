@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Detail Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/manager"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/manager/listklaim">List Klaim</a></li>
                <li class="breadcrumb-item active">[ {{ $klaim->id }} ]</a></li>
            </ol>
        </nav>
    </div>
    <!-- End Pagetitle -->
    <form action="{{ route('toApprove.Update') }}" method="POST">
        {{ csrf_field() }}

        <!-- Button Simpan -->
        <button type="submit"class="save btn btn-success mb-3">
            <i class="bi bi-pencil-square"></i>
            Simpan Perubahan
        </button>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="/cetakPdf/{{ $klaim->id }}">Cetak PDF <i
                                    class="bi bi-file-pdf"></i></a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Detail Data To Approve</h5>

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
                                            <b>Nama Pelanggan</b>
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
                                            <th width="5%" class="text-center">ID Produk</th>
                                            <th width="5%" class="text-center">Nama Produk</th>
                                            <th width="5%" class="text-center">No. Seri</th>
                                            <th width="5%" class="text-center">Tahun</th>
                                            <th width="5%" class="text-center">MM Awal</th>
                                            <th width="5%" class="text-center">MM Akhir</th>
                                            <th width="5%" class="text-center">Sisa TD (%)</th>
                                            <th width="5%" class="text-center">ID Kerusakan</th>
                                            <th width="10%" class="text-center">Jumlah Kompensasi</th>
                                            <th width="10%" class="text-center">Hasil Pabrik</th>
                                            <th width="10%" class="text-center">Hasil Klaim</th>
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
                                            <td>Rp.{{ $kompensasi }}</td>
                                            <td>{{ $klaim->hasil_pabrik }}%</td>
                                            <td>
                                                <select class="form-select text-left search-select" id="hasil"
                                                    name="hasil" aria-label="State">
                                                    <option value="{{ $klaim->hasil_klaim }}" disabled selected>
                                                        {{ $klaim->hasil_klaim }}</option>
                                                    <option value="lainnya">Lainnya</option>
                                                    @foreach ($hasilKlaim as $hasil)
                                                        <option value="{{ $hasil->nama_hasil }}"
                                                            {{ $klaim->hasil_klaim == $hasil->nama_hasil ? 'hidden' : '' }}>
                                                            {{ $hasil->nama_hasil }}</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control mt-2" id="hasilBaru" type="text"
                                                    style="display:none;" name="hasilBaru" />
                                            </td>
                                            <input type="hidden" name="hidden_id" id="hidden_id"
                                                value="{{ $klaim->id }}" />
                                        </tr>
                                    </tbody>
                                    <script>
                                        $(document).ready(function() {
                                            $("#hasil")
                                                .select2({
                                                    theme: "bootstrap-5",
                                                })
                                                .on('select2:close', function() {
                                                    if ($(this).val() == 'lainnya') {
                                                        $('#hasilBaru').show();
                                                        $(this).val() = $('#hasilBaru')
                                                    } else {
                                                        $('#hasilBaru').hide();
                                                    }
                                                });
                                        });
                                    </script>
                                </table>
                            </div><!-- Batas Table -->
    </form>

    <div class="row mb-3">
        <div class="col-lg-6 ">
            <div class="col-12">
                <label for="penjelasan" class="form-label fw-bold">Penjelasan</label>
                <textarea id="penjelasan" name="penjelasan" class="form-control" id="penjelasan" style="height: 110px" disabled>{{ $klaim->keterangan_klaim }}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <label class="form-label fw-bold">Dokumentasi Klaim</label>
            <div class="col d-flex">
                @foreach ($img as $image)
                    <div class="p-2">
                        <div class="thumbnail">
                            <div class="img-container">
                                <img src="{{ asset('imgKlaim/' . $image->image) }}" class="img-fluid" height="150px"
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

    </div>



    </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
