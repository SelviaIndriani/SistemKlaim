@extends('layouts.main')

@section('container')

    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Produk</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>
    <!-- End Pagetitle -->

    <div class="card">
        <div class="card-body">
            <!-- Title Table -->
            <h5 class="card-title">Data Produk</h5>
            <!-- End Title Table -->

            @if ($message = session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <span id="alertProduk"></span>

            <!-- Button Create -->
            <button type="button" class="btn btn-primary mb-2" id="tambah_data" name="tambah_data" data-bs-toggle="modal"
                data-bs-target="#produkModal">
                <span class="icon text-white-50">
                    <i class="bi bi-plus-lg"></i>
                </span>
                <span class="text">Tambah Data</span>
            </button>
            <!-- End Button Create -->

            <!-- Data Table -->
            <div class="table-responsive-xxl">
                <table class="table table-bordless w-100 table-striped" id="my-datatable-produk">
                    <thead class="table-success w-100">
                        <tr>
                            <th width="1%" class="text-center"></th>
                            <th width="2%" class="text-center">Kode</th>
                            <th width="5%" class="text-center">Nama</th>
                            <th width="5%" class="text-center">Ukuran</th>
                            <th width="5%" class="text-center">MM Awal</th>
                            <th width="2%" class="text-center">Gambar</th>
                            <th width="7%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Data Table -->

            <!-- Modal Tambah Data Baru-->
            <div class="modal fade" id="produkModal" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="produkModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('produk.tambah') }}" id="produkForm" class="row g-3" method="POST"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="modal-body mx-3">

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="id" class="form-label">Kode Produk</label>
                                        <input type="text" class="form-control" id="id" name="id" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="nama" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="ukuran" class="form-label">Ukuran</label>
                                        <input type="text" class="form-control" id="ukuran" name="ukuran" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="mm_awal" class="form-label">MM Awal</label>
                                        <input type="number" class="form-control" id="mm_awal" name="mm_awal"
                                            step="0.01" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Foto Product</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            placeholder="image" accept="image/*">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            <!-- Modal Hapus data -->
            <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="hapusDataModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="/produk/hapus/" method="POST" id="produkHapusForm">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mx-3">
                                <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" name="hapusButton" id="hapusButton"
                                    class="btn btn-danger">Ya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus data -->


        </div>
    </div>

    <script>
        $(document).ready(function() {
            var prd_id;

            $(document).on('click', '.delete', function() {
                prd_id = $(this).attr('id');
                $('#hapusDataModal').modal('show');
            })

            $('#hapusButton').click(function() {
                $.ajax({
                    url: '/produk/hapus/' + prd_id,
                    success: function(data) {
                        $('#alert-success').remove();
                        $('#hapusDataModal').modal('hide');
                        $('#hapusButton').text('Ya');
                        $('#produkTable').DataTable().ajax.reload();
                        var html =
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">Produk berhasil dihapus.';
                        html +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $('#alertProduk').html(html);

                    }
                });
            });

        });
    </script>

@endsection
