@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Detail Data Kerusakan</h5>
  <nav>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="/kerusakan">Kerusakan</a></li>
      <li class="breadcrumb-item active">[{{ $damage->id }}]-{{ $damage->nama }}</a></li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->

<!-- Button Edit -->
<button type="button" name="edit" id="{{ $damage->id }}" class="edit btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#dmgModal">
  <i class="bi bi-pencil-square"></i>
  <span class="text">Edit</span>
</button>
                   
  <!-- End Button Edit -->
  
  <!-- Button Hapus -->
  <button type="button" name="delete" id="{{ $damage->id }}"  class="btn delete btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#hapusDataModal">
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
          <div class="col-lg-12">
            <div class="row mb-2">
              <div class="col">
                <h2>[{{ $damage->id }}]-{{ $damage->nama }}</h2>
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Jenis Kerusakan</b>
              </div>
              <div class="col-lg-10">
                <label>
                  : {{ $damage->jenis }}
                </label>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-2">
                <b>Kondisi</b>
              </div>
              <div class="col-lg-10">
                <label>
                    : {{ $damage->kondisi }}
                  </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Modal Tambah Data Baru-->
    <div class="modal fade" id="dmgModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="kerusakanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Kerusakan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ route('kerusakan.detailupdate') }}" id="dmgForm" class="row g-3">
            @csrf
            <div class="modal-body mx-3" >
              <span id="form_result"></span>

                <div class="col-md-12 mb-3">
                  <label for="nama">Nama kerusakan</label>
                  <input type="text" class="form-control" value={{ $damage->nama }} id="nama" name="nama" required>
                </div>
      
                <div class="col-md-12 mb-3">
                  <label for="jenis">Jenis Kerusakan</label>
                  <select class="form-select" id="jenis" name="jenis" disabled aria-label="jenis">
                    <option>Pilih..</option>
                    <option value="Kesalahan Pabrik" {{ ($damage->jenis == 'Kesalahan Pabrik') ? 'selected' : '' }}>Kesalahan Pabrik</option>
                    <option value="Kesalahan Konsumen" {{ ($damage->jenis == 'Kesalahan Konsumen') ? 'selected' : '' }}>Kesalahan Konsumen</option>
                  </select>
                </div>

                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" value="{{ $damage->id }}" id="hidden_id" />
                <div class="col-md-12 mb-3">
                  <label for="kondisi">Kondisi</label>
                  <textarea class="form-control" id="kondisi" name="kondisi" style="height: 100px;" required>{{ $damage->kondisi }}</textarea>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
              <form action="/kerusakan/detail/hapus/{{ $damage->id}}" method="get" id="dmgHapusForm">
                @csrf
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body mx-3">
                <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data <b>{{ $damage->nama }}</b>?</h4>
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