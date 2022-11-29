@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle mb-4">
  <h5>Dashboard Data Klaim</h5>
</div>
<!--End Pagetitle -->

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Title Table -->
        <h5 class="card-title">List Data Klaim</h5>
        <!-- End Title Table -->

        @if ($message = session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> 
        @endif

        <!-- Button Create -->
        <a href="/teknisi/klaim-baru" class="btn btn-primary mb-2" id="tambah_data" name="tambah_data">
          <span class="icon text-white-50">
            <i class="bi bi-plus-lg"></i>
          </span>
          <span class="text">Tambah Data Klaim</span>
        </a>
        <!-- End Button Create -->

        <!-- nav list -->
        
        <div class="mt-2">
          <ul class="nav nav-tabs nav-fill mb-3" id="tab1" role="tablist">
            <li class="nav-item">
              <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-current="page">Data Klaim Pending</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-current="page">Data Klaim Approved</a>
            </li>
          </ul>
        </div>


        <!-- Batas nav list -->

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="pending">
            <!-- DataTable -->
            <div class="table-responsive-xxl">
              <table class="table table-bordless w-100 table-striped" id="klaimTable-pending" enctype="multipart/form-data">
                <thead class="table-success w-100">
                  <tr>
                    <th></th>
                    <th class="text-center">ID Klaim</th>
                    <th class="text-center">Tanggal Klaim</th>
                    <th class="text-center">ID Pelanggan</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">ID Kerusakan</th>
                    <th class="text-center">Nomor Seri</th>
                    <th class="text-center">Tahun Produksi</th>
                    <th class="text-center">Sisa TD</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- DataTable -->
  
          </div>

          <div role="tabpanel" class="tab-pane" id="approved">
            <!-- DataTable -->
            <div class="table-responsive-xxl">
              <table class="table table-bordless w-100 table-striped" id="klaimTable-approved" enctype="multipart/form-data">
                <thead class="table-success w-100">
                  <tr>
                    <th></th>
                    <th class="text-center">ID Klaim</th>
                    <th class="text-center">Tanggal Klaim</th>
                    <th class="text-center">ID Pelanggan</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">ID Kerusakan</th>
                    <th class="text-center">Nomor Seri</th>
                    <th class="text-center">Tahun Produksi</th>
                    <th class="text-center">Sisa TD</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- DataTable -->
          </div>

        </div>


        

        
      </div>
    </div>

  </div>

</div>

@endsection