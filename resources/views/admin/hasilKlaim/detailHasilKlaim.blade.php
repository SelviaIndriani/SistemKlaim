@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Detail Data Hasil Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/hasil-klaim">Hasil Klaim</a></li>
                <li class="breadcrumb-item active">[{{ $ClaimResult->id }}]-{{ $ClaimResult->nama_hasil }}</a></li>
            </ol>
        </nav>
    </div><!-- End Pagetitle -->

    <!-- Button Edit -->
    <button type="button" name="edit" class="edit btn btn-success mb-2" data-bs-toggle="modal"
        data-bs-target="#hasilKlaimModal">
        <i class="bi bi-pencil-square"></i>
        <span class="text">Edit</span>
    </button><!-- End Button Edit -->

    <!-- Button Hapus -->
    <button type="button" name="delete" class="btn delete btn-danger mb-2" data-bs-toggle="modal"
        data-bs-target="#hapusDataModal">
        <span class="icon text-white-50">
            <i class="bi bi-trash"></i>
        </span>
        <span class="text">Hapus</span>
    </button><!-- End Button Hapus -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <h4>[{{ $ClaimResult->id }}]-{{ $ClaimResult->nama_hasil }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal Edit data-->
    <div class="modal fade" id="hasilKlaimModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit data Hasil Klaim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hasilKlaim.detailupdate') }}" method="POST" id="hasilKlaimForm" class="row g-3">
                    @csrf
                    <div class="modal-body mx-3">
                        <span id="form_result"></span>
                        <div class="col-md-12 mb-3">
                            <label for="nama_hasil">Nama Hasil Klaim </label>
                            <input type="text" class="form-control" id="nama_hasil" name="nama_hasil"
                                value="{{ $ClaimResult->nama_hasil }}" required>
                        </div>
                        <input type="hidden" name="hidden_id" value="{{ $ClaimResult->id }}" id="hidden_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="action_button" id="action_button" value="Update"
                            class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal edit data -->

    <!-- Modal Hapus data -->
    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="hapusDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/hasil-klaim/detail/hapus/{{ $ClaimResult->id }}" method="get" id="hasilKlaimHapusForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-3">
                        <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data
                            <b>{{ $ClaimResult->nama_hasil }}</b>?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapusButton" id="hapusButton" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Hapus data -->
@endsection
