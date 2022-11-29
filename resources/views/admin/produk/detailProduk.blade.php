@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Detail Data product</h5>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
      <li class="breadcrumb-item active">[{{ $product->id }}]-{{ $product->nama }}</a></li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->
<a href="edit/{{ $product->id }}" name="edit" id="{{ $product->id }}" class="edit btn btn-success mb-2">
  <i class="bi-pencil-square"></i>
  Edit
</a>
                   
  <!-- End Button Edit -->
  
  <!-- Button Hapus -->
  <button type="button" name="delete" id="{{ $product->id }}"  class="btn delete btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#hapusModal">
    <span class="icon text-white-50">
      <i class="bi bi-trash"></i>
    </span>
    <span class="text">Hapus</span>
  </button>
  <!-- End Button Hapus -->

<section class="section">
  <br>
  <div class="row">
    <div class="card">
      <div class="card-body">
        <div class="row mt-4">
          <div class="col-lg-8">
            <div class="row mb-2">
              <div class="col">
                <h2>[{{ $product->id }}]-{{ $product->nama }}</h2>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Kode</b>
              </div>
              <div class="col-lg-10">
                <label>
                    : {{ $product->id }}
                </label>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Ukuran</b>
              </div>
              <div class="col-lg-10">
                <label>
                    : {{ $product->ukuran }}
                </label>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>MM awal</b>
              </div>
              <div class="col-lg-10">
                <label>
                  : {{ $product->mm_awal }}
                </label>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row mb-2">
              <div class="col">
                @if ($product->image != null)
                <img src="{{ asset('imgProduk/'.$product->image) }}"  class="img-fluid rounded mx-auto d-block" alt="Foto Produk" width="250px">
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Modal Tambah Data Baru-->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="custModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" id="custForm" method="POST" class="row g-3">
            <div class="modal-body mx-3" >
              <span id="form_result"></span>
                <div class="col-md-12 mb-3">
                  <label for="nama">Nama Produk</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ $product->nama }}" required>
                </div>
      
                <div class="col-md-12 mb-3">
                  <label for="ukuran">Ukuran</label>
                  <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ $product->ukuran }}" required>
                 </div>

                <div class="col-md-12 mb-3">
                  <label for="mm_awal">MM awal</label>
                  <input type="number" class="form-control" id="mm_awal" name="mm_awal" value="{{ $product->mm_awal }}" required>
                </div>

                <div class="row mb-3">
                  <div class="col-md-12">
                    <label for="image" class="form-label">Foto Produk</label>
                    <input type="file" name="image" id="image"  class="form-control">
                  </div>
                </div>

                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" value="{{ $product->id }}" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-primary" />
           </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->

 <!-- Modal Hapus data -->
 <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="hapusModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="hapus/{{ $product->id}}" method="get" id="dmgHapusForm">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3">
        <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data <b>{{ $product->nama }}</b> ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="hapusButton" id="hapusButton" class="btn btn-danger">Ya</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection

