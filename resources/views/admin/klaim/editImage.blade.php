@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Detail Klaim</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/listklaim">List Klaim</a></li>
                <li class="breadcrumb-item"><a href="/listklaim/detail/{{ $data->klaim_id }}">{{ $data->klaim_id }}</a></li>
                <li class="breadcrumb-item active">Dokumen Klaim</a></li>
            </ol>
        </nav>
    </div>
    <!-- End Pagetitle -->



    <!-- Form -->
    <form action="/listklaim/update-img" id="imgForm" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- Button Kembali -->
        <a href="/listklaim/detail/{{ $data->klaim_id }}" name="edit" id="" class="edit btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
        <!-- Batas Button Kembali -->

        <!-- Button simpan -->
        <button type="submit" name="update" id="update" class="btn btn-success mb-3">
            <i class="bi bi-pencil-square"></i>
            <span class="text">Simpan</span>
        </button>
        <!-- End Button simpan -->

        <section class="section dashboard">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Dokumentasi Klaim</h5>

                            <!-- Alert -->
                            @if ($message = session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="alert-success"
                                    role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- Batas Alert -->

                            <!-- Input Gambar Baru -->
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file" name="image" id="image" class="form-control"
                                        placeholder="image" accept="image/*">
                                </div>
                            </div>
                            <!-- Batas Input Gambar Baru -->

                            <!-- Menampilkan Gambar -->
                            <img src="{{ asset('imgKlaim/' . $data->image) }}" class="editImg img-fluid mt-3" name="editImg"
                                id="{{ $data->id }}">
                            <!-- Batas Menampilkan Gambar -->

                            <!-- Hidden ID -->
                            <input type="text" name="edtId" id="edtId" value="{{ $data->id }}" hidden />
                            <!-- Batas Hidden ID -->

    </form>
    <!-- Batas Form -->
    </div>
    </div>
    </div>
    </div>
    </section>
@endsection
