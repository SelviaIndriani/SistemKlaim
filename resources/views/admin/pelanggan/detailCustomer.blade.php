@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Detail Data Pelanggan</h5>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="/customer">Pelanggan</a></li>
      <li class="breadcrumb-item active">[{{ $customer->id }}]-{{ $customer->nama }}</a></li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->

<!-- Button Edit -->
<button type="button" name="edit" id="{{ $customer->id }}" class="edit btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#custModal">
  <i class="bi bi-pencil-square"></i>
  <span class="text">Edit</span>
</button>
                   
  <!-- End Button Edit -->
  
  <!-- Button Hapus -->
  <button type="button" name="delete" id="{{ $customer->id }}"  class="btn delete btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#hapusDataModal">
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
          <div class="col-lg-10">
            <div class="row mb-2">
              <div class="col">
                <h2>[{{ $customer->id }}]-{{ $customer->nama }}</h2>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Alamat</b>
              </div>
              <div class="col-lg-10">
                <label>
                    : {{ $customer->alamat }}
                </label>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Telp</b>
              </div>
              <div class="col-lg-10">
                <label>
                  : {{ $customer->telp }}
                </label>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Email</b>
              </div>
              <div class="col-lg-10">
                <label>
                  : {{ $customer->email }}
                </label>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="row mb-2">
              <div class="col">
                <h3>{{ $customer->distributor->nama }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Modal -->
    <div class="modal fade" id="custModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="custModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('customer.detailupdate') }}" id="custForm" method="POST" class="row g-3">
            @csrf
            <div class="modal-body mx-3" >
              <span id="form_result"></span>
              <div class="col-md-12 mb-3">
                <label for="distributor_id">Distributor</label>
                <select class="form-select" id="distributor_id" disabled name="distributor_id" aria-label="State">
                  <option selected >Pilih...</option>
                  @foreach ($distributor as $dist)
                  <option value="{{ $dist->id }}" {{ ($customer->distributor_id == $dist->id) ? 'selected' : '' }} >{{ $dist->nama }}</option>
                  @endforeach
                  </select>
              </div>
                <div class="col-md-12 mb-3">
                  <label for="nama">Nama Pelanggan</label>
                  <input type="text" class="form-control" id="nama" value="{{ $customer->nama }}" name="nama" required>
                </div>
      
                <div class="col-md-12 mb-3">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" id="alamat" name="alamat" style="height: 100px;" required>{{ $customer->alamat }}</textarea>
                 </div>

                <div class="col-md-12 mb-3">
                  <label for="telp">Telp</label>
                  <input type="number" class="form-control" id="telp" value="{{ $customer->telp }}" name="telp" required>
                  </div>

                <div class="col-md-12 mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" value="{{ $customer->email }}" id="email" name="email" required>
                  </div>

                  <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" value="{{ $customer->id }}" id="hidden_id" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <input type="submit" name="action_button" id="action_button" value="Update" class="btn btn-primary" />
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
      <form action="/customer/detail/hapus/{{ $customer->id }}" method="get" id="dmgHapusForm">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3">
        <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data <b>{{ $customer->nama }}</b> ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="hapusButton" class="btn btn-danger">Ya</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- End Modal Hapus data -->

@endsection

