@extends('layouts.main')

@section('container')
<!-- Judul Halaman-->
<h4 class="mb-3">
  Dashboard Klaim
</h4><!-- Batas Judul Halaman-->

<section class="section dashboard">

  <!-- Row -->
  <div class="row">

    <div class="col-xxl-12 col-xl-12">

      <div class="card info-card customers-card">
        
        <div class="card-body">
          <div class="row">
            <!-- Judul Chart -->
            <div class="col-md-8">
              <h5 class="card-title">Chart Klaim <span id="text">| Berdasarkan Hasil Klaim</span></h5>
            </div><!-- Batas Judul Chart -->

            <!-- Filter Pengelompokan -->
            <div class="col-md-4 mt-3">
              <div class="row">
                <label class="col-md-4 col-form-label" >Group by :</label>
                <div class="col-md-8">
                  <select class="form-select form-select-sm " id="filter-chart" name="filter-chart">
                    <option value="Hasil Klaim">Hasil Klaim</option>
                    <option value="Distributor">Distributor</option>
                    <option value="Kerusakan Konsumen">Kerusakan Konsumen</option>
                    <option value="Kerusakan Pabrik">Kerusakan Pabrik</option>
                    <option value="Produk">Produk</option>
                  </select>
                </div>
              </div>
            </div><!-- Batas Filter Pengelompokan -->

          </div>

          <!-- Chart -->
          <div class="row">
            <div class="d-flex justify-content-center" >
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title" id="title-chart">Hasil Klaim Chart</h5><!-- Judul Chart -->
                  <div id="chart1"></div><!-- Chart 1 -->
                </div>
              </div>
            </div>      
          </div><!-- Batas Chart -->

        </div>
      </div>
    </div>
  </div>
</section>

<script>

  document.addEventListener("DOMContentLoaded", () => {

    //chart berdasarkan data Hasil
    var myChart = new ApexCharts(document.querySelector("#chart1"), {
      //mengambil jumlah data berdasarkan Hasil dari controller
      series: {{ Js::from($byHasil->values()) }},
      chart: {
        id : 'mychart',
        height: 400,
        type: 'pie',
      },
      //mengambil label/nama data berdasarkan Hasil dari controller
      labels: {{ Js::from($byHasil->keys()) }}
    }).render();

    //fungsi filter atau group by
    document.getElementById("filter-chart").addEventListener("change", function(e){
      //inisialisai value
      var value = e.target.value

      //merubah value text
      document.getElementById("text").textContent = ' | Berdasarkan '+ value
      //merubah value title-chart
      document.getElementById("title-chart").textContent = value +' Chart ' 

      //jika value adalah kerusakan konsumen
      if (value == 'Kerusakan Konsumen') {
        //meng-update data pada series dan lable chart
        ApexCharts.exec('mychart', 'updateOptions', {
          series: {{ Js::from($byKKonsumen->values()) }},
          labels: {{ Js::from($byKKonsumen->keys()) }}
        });
      }

      //jika value adalah Produk
      else if (value == 'Produk') {
        //meng-update data pada series dan lable chart
        ApexCharts.exec('mychart', 'updateOptions', {
          series: {{ Js::from($byProduk->values()) }},
          labels: {{ Js::from($byProduk->keys()) }}
        });
      }

      //jika value adalah kerusakan Pabrik
      else if (value == 'Kerusakan Pabrik') {  
        //meng-update data pada series dan lable chart
        ApexCharts.exec('mychart', 'updateOptions', {
          series: {{ Js::from($byKPabrik->values()) }},
          labels: {{ Js::from($byKPabrik->keys()) }}
        });
      }
      
      //jika value adalah distributor 
      else if(value == 'Distributor'){
        //meng-update data pada series dan lable chart
        ApexCharts.exec('mychart', 'updateOptions', {
          series: {{ Js::from($byDistributor->values()) }},
          labels: {{ Js::from($byDistributor->keys()) }}
        });
      }

      //jika value bukan kerusakan Pabrik, kerusakan konsumen, produk dan distributor
      else{
        //meng-update data pada series dan lable chart
        ApexCharts.exec('mychart', 'updateOptions', {
          series: {{ Js::from($byHasil->values()) }},
          labels: {{ Js::from($byHasil->keys()) }}
        });
      }

    });

  });

</script>

@endsection