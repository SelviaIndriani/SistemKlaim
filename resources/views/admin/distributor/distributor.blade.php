@extends('layouts.main')

@section('container')
    <!-- judul halaman -->
    <div class="pagetitle">
        <h5>Distributor</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Distributor</li>
            </ol>
        </nav>
    </div><!-- batas judul halaman -->


    <div class="card">
        <div class="card-body">
            <!-- Judul Table -->
            <h5 class="card-title">Data Distributor</h5>
            <!-- Batas judul Table -->

            @if ($message = session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <span id="alert-dist"></span>

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary mb-2" name="tambah_data" id="tambah_data">
                <span class="icon text-white-50">
                    <i class="bi bi-plus-lg"></i>
                </span>
                <span class="text">Tambah Data Baru</span>
            </button><!-- Batas Tombol tambah -->

            <!-- Data Table -->
            <div class="table-responsive-xxl">
                <table class="table table-bordless w-100 table-striped " id="my-datatable-distributor">
                    <thead class="table-success w-100">
                        <tr>
                            <th width="1%"></th>
                            {{-- <th width="1%" class="text-center">ID</th> --}}
                            <th width="5%" class="text-center">Nama Distributor</th>
                            <th width="5%" class="text-center">Alamat</th>
                            <th width="5%" class="text-center">Telp</th>
                            <th width="5%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div><!-- Batas Data Table -->

            <!-- Modal Distributor-->
            <div class="modal fade" id="distModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="distModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="#" method="POST" id="distForm" class="row g-3">
                            <div class="modal-body mx-3">
                                <span id="form_result"></span>
                                <div class="col-md-12 mb-3">
                                    <label for="nama">Nama Distributor </label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" style="height: 100px;" required></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="telp">Telp</label>
                                    <input type="number" class="form-control" id="telp" name="telp" required>
                                </div>
                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="action_button" id="action_button" value="Add"
                                    class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- Batas Modal -->

            <!-- Modal Hapus data -->
            <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="hapusDataModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="#" method="POST" id="distHapusForm">
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

    <script type="text/javascript">
        $(document).ready(function() {

            //show modal tambah data
            $('#tambah_data').click(function() {
                $('#distForm')[0].reset();
                $('.modal-title').text('Tambah Data Distributor');
                $('#action_button').val('Tambah');
                $('#action').val('Add');
                $('#form_result').html('');

                $('#distModal').modal('show');
            });

            //aksi tambah data
            $('#distForm').on('submit', function(event) {
                event.preventDefault();
                var action_url = '';
                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('distributor.tambah') }}"
                }
                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('distributor.update') }}"
                }

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: action_url,
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            var html =
                                '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                data.success;
                            html +=
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            html += '</div>';
                            $('#distForm')[0].reset();
                            $('#distModal').modal('hide');
                            $('#my-datatable-distributor').DataTable().ajax.reload();
                        }
                        $('#alert-dist').html(html);
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        var html =
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            errors.message;
                        html +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                var id = $(this).attr('id');

                $('#form_result').html('');

                $.ajax({
                    url: "/distributor/edit/" + id + "/",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#nama').val(data.result.nama);
                        $('#alamat').val(data.result.alamat);
                        $('#telp').val(data.result.telp);
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Data Distributor');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#distModal').modal('show');
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        var html =
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            errors.message;
                        html +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $('#form_result').html(html);
                    }
                });
            });

            var dist_id;

            $(document).on('click', '.delete', function() {
                dist_id = $(this).attr('id');
                $('#hapusDataModal').modal('show');
            })

            $('#hapusButton').click(function() {
                $.ajax({
                    url: '/distributor/hapus/' + dist_id,
                    success: function(data) {
                        $('#hapusDataModal').modal('hide');
                        $('#hapusButton').text('Ya');
                        $('#my-datatable-distributor').DataTable().ajax.reload();
                        var html =
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Dihapus';
                        html +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $('#alert-dist').html(html);

                    }
                });
            });
        });
    </script>
@endsection
