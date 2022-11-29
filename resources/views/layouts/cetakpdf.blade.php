<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
    
            <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Detail Data Klaim</h5>
    
              <div class="row ">
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-3">
                      <b>Pelanggan</b>
                    </div>
                    <div class="col-lg-9">
                      : {{ $klaim->customer->nama }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <b>Alamat</b>
                    </div>
                    <div class="col-lg-9">
                      <label>
                      :  {{ $klaim->customer->alamat }}
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col">
                      <b>Tanggal Klaim</b>
                    </div>
                    <div class="col">: {{ Carbon\Carbon::parse($klaim->created_at )->format('d/m/Y') }}</div>
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
              
              <!-- Bordered Table -->
              <table class="table table-bordered mt-6">
                <thead>
                  <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Nomor Seri</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">MM Awal</th>
                    <th scope="col">MM Akhir</th>
                    <th scope="col">Sisa TD (%)</th>
                    <th scope="col">Nama Kerusakan</th>
                    <th scope="col">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $klaim->product->nama }}</td>
                    <td>{{ $klaim->no_seri }}</td>
                    <td>{{ $klaim->tahun_produksi }}</td>
                    <td>{{ $klaim->product->mm_awal }}</td>
                    <td>{{ $klaim->mm_akhir }}</td>
                    <td>{{ $klaim->mm_akhir / $klaim->product->mm_awal * 100 }}%</td>
                    <td>{{ $klaim->damage->id }} - {{ $klaim->damage->nama }}</td>
                    <td>{{ $klaim->hasil_klaim }}</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Bordered Table -->
    
              <div class="row mb-3">
                <div class="col-lg-6 ">
                  <div class="col-12">
                    <label for="penjelasan" class="form-label">Penjelasan</label>
                    <textarea id="penjelasan" name="penjelasan" class="form-control" id="penjelasan" style="height: 110px" disabled>{{ $klaim->keterangan_klaim }}</textarea>
                  </div>
                  
                </div>
                
                <div class="col-lg-6 ">
                  
    
                  <div class="row mb-3 mt-5">
                    <div class="col">
                      <b>Jumlah yang disetujui (Rp)</b>
                    </div>
                    <div class="col">: Rp{{ $klaim->kompensasi }}</div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <b>Hasil Keputusan Pabrik</b>  
                    </div>
                    <div class="col">: {{ $klaim->hasil_pabrik }}</div>
                  </div>
                </div>
    
              </div>   
    
            </div>
          </div>
    
        </div>
    
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Dokumentasi</h5>
              <div class="row d-flex">
                @foreach ($img as $image)
                <div class="col-md-1 mb-3 flex-fill">
                  <div class="thumbnail">
                    <div class="img-container">
                      <img src="{{ asset('imgKlaim/'.$image->image) }}"  class="img-fluid" data-bs-toggle="modal" data-bs-target="#imageModal">
                    </div>
                  </div>
                </div>
                @endforeach 
              </div>      
            </div>
          </div>
        </div>
    
      </div>
</body>
</html>