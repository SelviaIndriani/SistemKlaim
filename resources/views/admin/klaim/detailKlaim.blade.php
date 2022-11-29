@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Detail Klaim</h5>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="/listklaim">List Klaim</a></li>
      <li class="breadcrumb-item active">{{ $klaim->id }}</a></li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->


<form action="{{ route('klaim.update') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{-- @method('PUT') --}}
<!-- Button Edit -->
<button type="submit"class="save btn btn-success mb-3">
  <i class="bi bi-pencil-square"></i>
  Simpan Perubahan
</button>
                   
  <!-- End Button Edit -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-9">

        <div class="card info-card sales-card">

          <div class="filter">
            <a class="icon" href="/cetakPdf/{{ $klaim->id }}">Cetak PDF <i class="bi bi-file-pdf"></i></a>
          </div>
        <div class="card-body">
          <h5 class="card-title">Detail Data Klaim</h5>

          <div class="row d-flex justify-content-between ">
            <div class="col-lg-4">
              <div class="row">
                <div class="col">
                  <b>Pelanggan</b>
                </div>
                <div class="col">
                  : {{ $klaim->customer_nama }}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <b>Alamat</b>
                </div>
                <div class="col">
                  <label>
                  :  {{ $klaim->customer_alamat }}
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col">
                  <b>Tanggal Klaim</b>
                </div>
                <div class="col">:  {{ Carbon\Carbon::parse($klaim->created_at )->format('d/m/Y') }}</div>
              </div>
              <div class="row">
                <div class="col">
                  <b>Dicek Oleh</b>  
                </div>
                <div class="col">: {{ $klaim->checking_by }}</div>
              </div>
            </div>
          </div>
          
          <br>
          
          <!-- Table -->
          <div class="table-responsive-xxl">
            <table class="table table-bordered mt-6">
              <thead>
                <tr>
                  <th scope="col">ID Produk</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Nomor Seri</th>
                  <th scope="col">Tahun</th>
                  <th scope="col">MM Awal</th>
                  <th scope="col">MM Akhir</th>
                  <th scope="col">Sisa TD (%)</th>
                  <th scope="col">ID Kerusakan</th>
                  <th scope="col">Hasil</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $klaim->product_id }}</td>
                  <td>{{ $klaim->product_nama }}</td>
                  <td>{{ $klaim->no_seri }}</td>
                  <td>{{ $klaim->tahun_produksi }}</td>
                  <td>{{ $klaim->mm_awal }}</td>
                  <td>{{ $klaim->mm_akhir }}</td>
                  <td>{{ ceil($klaim->mm_akhir / $klaim->mm_awal * 100) }}%</td>
                  <td>{{ $klaim->damage_id }}</td>
                  <td>{{ $klaim->hasil_klaim }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Batas Table -->

          <div class="row mb-3">
            <div class="col-lg-6 ">
              <div class="col-12">
                <label for="penjelasan" class="form-label">Penjelasan</label>
                <textarea id="penjelasan" name="penjelasan" class="form-control" id="penjelasan" style="height: 110px" disabled>{{ $klaim->keterangan_klaim }}</textarea>
              </div>
              
            </div>
            
            <div class="col-lg-6 ">
             
                <div class="row">
                  <div class="col-12">
                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                <input type="text" class="form-control" value="{{ $klaim->kompensasi }}" id="jumlah" name="jumlah" 
                 data-inputmask="'alias':'currency','digits': '0', 'prefix':'Rp.', 'removeMaskOnSubmit': true" />
                </div>
                </div>
              <div class="row mb-3">
                <div class="col-12">
                <label for="hasilPabrik" class="form-label">Hasil Pabrik</label>
                <input type="number" class="form-control" value="{{ $klaim->hasil_pabrik }}"  id="hasilPabrik" name="hasilPabrik">
              </div>
              <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $klaim->id }}" />

              </div>
              
              </form>
            </div>

          </div>   

        </div>
      </div>

    </div>

    <div class="col-lg-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Dokumentasi</h5>
          <div class="row d-flex">
            @foreach ($img as $image)
            <div class="col-md-6 mb-3 flex-fill">
              <div class="thumbnail">
                <div class="img-container">
                  <img src="{{ asset('imgKlaim/'.$image->image) }}" class="img-fluid" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
              </div>
            </div>
            @endforeach 
          </div>      
        </div>
      </div>
    </div>

  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Dokumentasi pengajuan Klaim</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('imgKlaim/'.$img[0]->image) }}" class="d-block w-80 img-fluid" alt="$img[0]->nama">
          </div>
          @foreach ($img->skip(1) as $image)
            <div class="carousel-item">
              <img src="{{ asset('imgKlaim/'.$image->image) }}" class="d-block w-80 img-fluid" alt="$image->nama">
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#jumlah').inputmask('decimal', { rightAlign: false });
  });
</script>
@endsection