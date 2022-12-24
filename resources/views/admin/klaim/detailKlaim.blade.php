@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Detail Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/listklaim">List Klaim</a></li>
                <li class="breadcrumb-item active">{{ $klaim->id }}</a></li>
            </ol>
        </nav>
    </div>
    <!-- End Pagetitle -->


    <!-- Form -->
    <form action="{{ route('klaim.update') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- Button Kembali -->
        <a href="/listklaim" name="back" id="back" class=" btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
        <!-- Batas Button Kembali -->

        <!-- Button Simpan -->
        <button type="submit"class="save btn btn-success mb-3">
            <i class="bi bi-pencil-square"></i>
            Simpan Perubahan
        </button>
        <!-- Batas Button Simpan -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-9">

                    <!-- Alert -->
                    @if ($message = session('success'))
                        <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Batas Alert -->

                    <div class="card info-card sales-card">

                        <!-- Cetak PDF -->
                        <div class="filter">
                            <a class="icon" href="/cetakPdf/{{ $klaim->id }}">Cetak PDF
                                <i class="bi bi-file-pdf"></i>
                            </a>
                        </div>
                        <!-- Batas Cetak PDF -->


                        <div class="card-body">
                            <h5 class="card-title">Detail Data Klaim</h5>

                            <div class="row d-flex justify-content-between ">
                                <div class="col-lg-4">

                                    <!-- Data ID -->
                                    <div class="row">
                                        <div class="col">
                                            <b>ID Pelanggan</b>
                                        </div>
                                        <div class="col">
                                            : {{ $klaim->customer_id }}
                                        </div>
                                    </div>
                                    <!-- Batas Data ID -->

                                    <!-- Data Nama -->
                                    <div class="row">
                                        <div class="col">
                                            <b>Nama</b>
                                        </div>
                                        <div class="col">
                                            : {{ $klaim->customer_nama }}
                                        </div>
                                    </div>
                                    <!-- Batas Data Nama -->

                                    <!-- Data Alamat -->
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
                                    <!--Batas Data Alamat -->

                                </div>

                                <div class="col-lg-4">
                                    <!-- Data ID Klaim -->
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
                                    <!-- Batas Data ID Klaim -->

                                    <!-- Data Tanggal -->
                                    <div class="row">
                                        <div class="col">
                                            <b>Tanggal Klaim</b>
                                        </div>
                                        <div class="col">:
                                            {{ Carbon\Carbon::parse($klaim->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                    <!-- Batas Data Tanggal -->

                                    <!-- Data Pengecek -->
                                    <div class="row">
                                        <div class="col">
                                            <b>Dicek Oleh</b>
                                        </div>
                                        <div class="col">: {{ $klaim->checking_by }}</div>
                                    </div>
                                    <!-- Batas Data Pengecek -->
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
                                            <th scope="col">ID Kerusakan</th>
                                            <th scope="col">Hasil Klaim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $klaim->product_id }}</td>
                                            <td>{{ $klaim->product_nama }}</td>
                                            <td width="15%">
                                                <input type="text" class="form-control" id="no_seri"
                                                    value="{{ $klaim->no_seri }}" name="no_seri" required>
                                            </td>
                                            <td width="12%">
                                                <select class="form-select" id="tahun_produksi" name="tahun_produksi"
                                                    aria-label="State" required>
                                                    <option value="{{ $klaim->tahun_produksi }}">
                                                        {{ $klaim->tahun_produksi }}</option>
                                                    @foreach (array_combine(range(date('Y'), 2017), range(date('Y'), 2017)) as $year)
                                                        <option value="{{ $year }} "
                                                            {{ $klaim->tahun_produksi == $year ? 'hidden' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $klaim->mm_awal }}</td>
                                            <td width="10%">
                                                <input type="text" class="form-control" id="mm_akhir"
                                                    value="{{ $klaim->mm_akhir }}" name="mm_akhir" required step="0.01">
                                            </td>
                                            <td>{{ round(($klaim->mm_akhir / $klaim->mm_awal) * 100) }}%</td>
                                            <td>{{ $klaim->damage_id }}</td>
                                            <td width="20%" class="fw-bold">{{ $klaim->hasil_klaim }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Batas Table -->

                            <div class="row mb-3">
                                <div class="col-lg-6 ">
                                    <div class="col-12">
                                        <label for="keterangan_klaim" class="form-label">Keterangan Klaim</label>
                                        <textarea id="keterangan_klaim" name="keterangan_klaim" class="form-control" style="height: 110px">{{ $klaim->keterangan_klaim }}</textarea>
                                    </div>

                                </div>

                                <div class="col-lg-6 ">

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                                            <input type="text" class="form-control" value="{{ $klaim->kompensasi }}"
                                                id="jumlah" name="jumlah"
                                                data-inputmask="'alias':'currency','digits': '0', 'prefix':'Rp.', 'removeMaskOnSubmit': true, 'rightAlign': false" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="hasilPabrik" class="form-label">Hasil Pabrik</label>
                                            <input type="text" class="form-control"
                                                value="{{ $klaim->hasil_pabrik }}" id="hasilPabrik" name="hasilPabrik"
                                                data-inputmask="'alias':'percentage', 'suffix': '%', 'removeMaskOnSubmit': true, 'rightAlign': false">
                                        </div>
                                        <input type="hidden" name="hidden_id" id="hidden_id"
                                            value="{{ $klaim->id }}" />

                                    </div>

    </form>
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
                                    <img src="{{ asset('imgKlaim/' . $image->image) }}" class="editImg img-fluid"
                                        name="editImg" id="{{ $image->id }}">
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
    <div class="modal fade" id="imageModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Dokumentasi pengajuan Klaim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" id="imgForm" method="POST" class="row g-3">
                    <div class="modal-body mx-3 d-flex justify-content-center">
                        <img src="" class="mb-4" name="edtImg " id="edtImg" height="400px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <a href="" class=" btn btn-success" id="updateImg" name="updateImg">
                            <i class="bi bi-pencil-square"></i>
                            Update Dokumen
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#jumlah').inputmask();
            $('#hasilPabrik').inputmask();
        });

        var imgId;

        $(document).on('click', '.editImg', function() {
            // event.preventDefault();
            imgId = $(this).attr('id');
            console.log(imgId)

            $.ajax({
                url: "/listklaim/editImage/" + imgId + '/',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $('#edtImg').attr("src", '/imgKlaim/' + data.result.image);
                    $('#updateImg').attr("href", '/listklaim/editImage/' + data.result.id);
                    $('#imageModal').modal('show');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
    </script>
@endsection
