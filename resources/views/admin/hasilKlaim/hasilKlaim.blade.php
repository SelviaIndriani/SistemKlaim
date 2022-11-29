@extends('layouts.main')

@section('container')
    <!-- judul halaman -->
    <div class="pagetitle">
        <h5>Hasil Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Hasil Klaim</li>
            </ol>
        </nav>
    </div><!-- batas judul halaman -->


    <div class="card">
        <div class="card-body">
            <!-- Judul Table -->
            <h5 class="card-title">Data Hasil Klaim</h5>

            @if ($message = session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <span id="alert-hasilKlaim"></span>

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary mb-2" name="tambah_data" id="tambah_data">
                <span class="icon text-white-50">
                    <i class="bi bi-plus-lg"></i>
                </span>
                <span class="text">Tambah Data Baru</span>
            </button><!-- Batas Tombol tambah -->

            <!-- Data Table -->
            <div class="table-responsive-sm">
                <table class="table table-bordless w-100 table-striped my-datatable-hasilKlaim" id="hasilKlaimTable">
                    <thead class="table-success w-100">
                        <tr>
                            <th width="1%"></th>
                            <th width="1%" class="text-center">ID</th>
                            <th width="5%" class="text-center">Nama Hasil Klaim</th>
                            <th width="5%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div><!-- Batas Data Table -->


            <!-- Modal Hasil Klaim-->
            <div class="modal fade" id="hasilKlaimModal" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="hasilKlaimModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="#" method="POST" id="hasilKlaimForm" class="row g-3">
                            <div class="modal-body mx-3">
                                <span id="form_result"></span>
                                <div class="col-md-12 mb-3">
                                    <label for="nama_hasil">Nama Hasil Klaim </label>
                                    <input type="text" class="form-control" id="nama_hasil" name="nama_hasil" required>
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
                        <form action="#" method="POST" id="hasilKlaimHapusForm">
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
                $('#hasilKlaimForm')[0].reset();
                $('.modal-title').text('Tambah Data Hasil Klaim');
                $('#action_button').val('Tambah');
                $('#action').val('Add');
                $('#form_result').html('');

                $('#hasilKlaimModal').modal('show');
            });

            //aksi tambah data
            $('#hasilKlaimForm').on('submit', function(event) {
                event.preventDefault();
                var action_url = '';
                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('hasilKlaim.tambah') }}"
                }
                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('hasilKlaim.update') }}"
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
                            $('#hasilKlaimForm')[0].reset();
                            $('#hasilKlaimModal').modal('hide');
                            $('#hasilKlaimTable').DataTable().ajax.reload();
                        }
                        $('#alert-hasilKlaim').html(html);
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
                    url: "/hasil-klaim/edit/" + id + "/",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#nama_hasil ').val(data.result.nama_hasil);
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Data Hasil Klaim');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#hasilKlaimModal').modal('show');
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

            var hasilKlaim_id;

            $(document).on('click', '.delete', function() {
                hasilKlaim_id = $(this).attr('id');
                $('#hapusDataModal').modal('show');
            })

            $('#hapusButton').click(function() {
                $.ajax({
                    url: '/hasil-klaim/hapus/' + hasilKlaim_id,
                    success: function(data) {
                        $('#hapusDataModal').modal('hide');
                        $('#hapusButton').text('Ya');
                        $('#hasilKlaimTable').DataTable().ajax.reload();
                        var html =
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Dihapus';
                        html +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $('#alert-hasilKlaim').html(html);

                    }
                });
            });


        });
    </script>
@endsection
