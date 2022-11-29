@extends('layouts.main')

@section('container')
    <!-- Pagetitle -->
    <div class="pagetitle">
        <h5>Edit Data product</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
                <li class="breadcrumb-item active">[ {{ $product->id }} ]</a></li>
            </ol>
        </nav>
    </div>
    <!-- End Pagetitle -->

    <form action="{{ route('produk.update') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{-- @method('PUT') --}}
        <!-- Button Edit -->
        <button type="submit"class="save btn btn-success mb-2">
            <i class="bi bi-pencil-square"></i>
            Simpan
        </button>

        <!-- End Button Edit -->

        <!-- Button Hapus -->
        <a name="discard" href="/produk" class="btn discard btn-danger mb-2">
            <span class="icon text-white-50">
                <i class="bi bi-trash"></i>
            </span>
            <span class="text">Batal</span>
        </a>
        <!-- End Button Hapus -->

        <section class="section">
            <br>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-md-8">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="nama" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required
                                            value="{{ $product->nama }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="ukuran" class="form-label">Ukuran</label>
                                        <input type="text" class="form-control" id="ukuran" name="ukuran" required
                                            value="{{ $product->ukuran }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="mm_awal" class="form-label">MM Awal</label>
                                        <input type="text" class="form-control" id="mm_awal" name="mm_awal"
                                            value="{{ $product->mm_awal }}">
                                    </div>
                                </div>
                                <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $product->id }}" />

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Foto Product</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            placeholder="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    @if ($product->image != null)
                                        <img src="{{ asset('imgProduk/' . $product->image) }}"
                                            class="img-fluid rounded mx-auto d-block" alt="Foto Produk" width="200px">
                                    @endif
                                </div>
                            </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </section>
@endsection
