@extends('layouts.main')

@section('container')

    <!-- Judul Halaman -->
    <div class="pagetitle">
        <h5>Form Pengajuan Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/teknisi">Data Klaim</a></li>
                <li class="breadcrumb-item active">Tambah Klaim Baru</a></li>
            </ol>
        </nav>
    </div> <!-- Batas judul halaman -->

    <!-- Form Pengajuan Klaim -->
    <form action="{{ route('teknisi.tambah') }}" id="produkForm" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tombol Simpan -->
        <button type="submit"class="save btn btn-success mb-2">
            <i class="bi bi-pencil-square"></i>
            Simpan
        </button><!-- Batas Tombol Simpan -->

        <!-- Tombol Batal -->
        <a name="batal" href="/teknisi" class="btn discard btn-danger mb-2">
            <i class="bi bi-trash"></i>
            Batal
        </a><!-- Batas Tombol Batal -->

        <div class="card mt-3">
            <div class="card-body">

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Batas Pesan error -->

                <div class="row mt-3 justify-content-between mb-3">

                    <div class="col-md-4">

                        <!-- Select Nama Pelanggan -->
                        <label for="customer_id" class="form-label">Nama Pelanggan</label>
                        <select class="form-select search-select" id="customer_id" data-width="100%" name="customer_id"
                            aria-label="State" required>
                            <option disabled selected>Pilih Nama Pelanggan</option>
                            {{-- mengambil data pelanggan dari db --}}
                            @foreach ($customer as $cust)
                                <option value="{{ $cust->id }}" data-alamat="{{ $cust->alamat }}">
                                    [{{ $cust->id }}]-{{ $cust->nama }}</option>
                            @endforeach
                        </select>
                        <!-- Batas Select Nama Pelanggan -->

                        <!-- Alamat -->
                        <label for="alamat" class="form-label mt-3">Alamat Pelanggan</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" disabled></textarea>
                        <!-- Batas Alamat -->

                        <!-- Nama Pengecek -->
                        <label for="checking_by" class="form-label mt-3">Dicek oleh</label>
                        <input type="text" class="form-control" id="checking_by" name="checking_by" required>
                        <!-- Batas Nama Pengecek -->

                        <!-- Tanggal -->
                        <div class="row mt-3 mb-2">
                            <label class="form-label">Tanggal : {{ \Carbon\Carbon::now()->format('m/d/Y') }}</label>
                        </div>
                        <!-- Batas Tanggal -->

                    </div>

                    <div class="col-md-4">

                        <!-- Nama Produk -->
                        <label for="product_id" class="form-label ">Nama Produk </label>
                        <select class="form-select search-select" data-width="100%" id="product_id" name="product_id"
                            aria-label="State">
                            <option disabled selected>Pilih Produk</option>
                            @foreach ($product as $prd)
                                <option value="{{ $prd->id }}" data-mm_awal="{{ $prd->mm_awal }}">{{ $prd->nama }} -
                                    [{{ $prd->ukuran }}]</option>
                            @endforeach
                        </select>
                        <!-- Batas Nama Produk -->

                        <div class="row">
                            <div class="col">
                                <!-- No Seri -->
                                <label for="no_seri" class="form-label mt-3">No. Seri</label>
                                <input type="number" class="form-control" id="no_seri" name="no_seri" required>
                                <!-- Batas No Seri -->
                            </div>

                            <div class="col">
                                <!-- Tahun produksi -->
                                <label for="tahun_produksi" class="form-label mt-3">Tahun</label>
                                <select class="form-select" id="tahun_produksi" name="tahun_produksi" aria-label="State"
                                    required>
                                    <option disabled selected>Pilih Tahun</option>
                                    @foreach (array_combine(range(date('Y'), 2017), range(date('Y'), 2017)) as $year)
                                        <option value="{{ $year }} ">{{ $year }} </option>
                                    @endforeach
                                </select>
                                <!-- Batas Tahun produksi -->
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <!-- MM awal -->
                            <div class="col">
                                <label for="mm_awal" class="form-label">MM awal</label>
                                <input type="number" class="form-control" id="mm_awal" name="mm_awal" step="0.01"
                                    required disabled>
                            </div><!-- Batas MM awal -->

                            <!-- MM akhir -->
                            <div class="col">
                                <label for="mm_akhir" class="form-label">MM akhir</label>
                                <input type="number" class="form-control" id="mm_akhir" name="mm_akhir" step="0.01"
                                     required>
                            </div><!-- Batas MM akhir -->
                        </div>

                    </div>

                    <div class="col-md-4">

                        <!-- kode kerusakan -->
                        <label for="damage_id" class="form-label">Nama Kerusakan</label>
                        <select class="form-select search-select" data-width="100%" id="damage_id" name="damage_id"
                            aria-label="State">
                            <option disabled selected>Pilih Kerusakan</option>
                            @foreach ($damage as $dmg)
                                <option value="{{ $dmg->id }}">[{{ $dmg->id }}] - {{ $dmg->nama }}</option>
                            @endforeach
                        </select>
                        <!-- Batas Kode Kerusakan -->

                        <!-- keterangan_klaim -->
                        <label for="keterangan_klaim" class="form-label mt-3">Keterangan</label>
                        <textarea type="text" class="form-control" id="keterangan_klaim" name="keterangan_klaim"></textarea>
                        <!-- Batas keterangan_klaim -->

                        <!-- Gambar -->
                        <label for="images" class="form-label mt-3">Gambar</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <!-- Batas Gambar -->

                    </div>

                </div>

            </div>
        </div>
        <script>
            $(document).ready(function() {

                $(".search-select").select2({
                    theme: "bootstrap-5",
                });

                $('#customer_id').on('change', function() {
                    var selected = $(this).find('option:selected');
                    var dAlamat = selected.data('alamat');

                    $("#alamat").val(dAlamat);
                });

                $('#product_id').on('change', function() {
                    var selected = $(this).find('option:selected');
                    var mm = selected.data('mm_awal');

                    $("#mm_awal").val(mm);
                });

            });
        </script>
    </form>

@endsection
