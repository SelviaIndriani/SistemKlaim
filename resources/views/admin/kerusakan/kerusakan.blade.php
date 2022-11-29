@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Kerusakan</h5>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Kerusakan</li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->

<div class="card">
  <div class="card-body">
    <!-- Title Table -->
    <h5 class="card-title">Data Kerusakan</h5>
    <!-- End Title Table -->

    @if ($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <span id="alertDmg"></span> 

    <!-- Button Create -->
    <button type="button" class="btn btn-primary mb-2" name="tambah_data" id="tambah_data">
      <span class="icon text-white-50">
        <i class="bi bi-plus-lg"></i>
      </span>
      <span class="text">Tambah Data Baru</span>
    </button>
    <!-- End Button Create -->
        
    <!-- Data Table -->
    <div class="table-responsive-sm">
      <table class="table table-bordless w-100 table-striped my-datatable-kerusakan" id="dmgTable">
        <thead class="table-success w-100">
          <tr>
            <th width="1%"></th>
            <th width="1%" class="text-center">Kode Kerusakan</th>
            <th width="5%" class="text-center">Nama Kerusakan</th>
            <th width="10%" class="text-center">Kondisi</th>
            <th width="5%" class="text-center">Jenis Kerusakan</th>
            <th width="7%" class="text-center">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Data Table -->

    <!-- Modal Tambah Data Baru-->
    <div class="modal fade" id="dmgModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="kerusakanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Kerusakan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" id="dmgForm" class="row g-3">
            <div class="modal-body mx-3" >
              <span id="form_result"></span>

                <div class="col-md-12 mb-3">
                  <label for="nama">Nama kerusakan</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
      
                <div class="col-md-12 mb-3">
                  <label for="jenis">Jenis Kerusakan</label>
                  <select class="form-select" id="jenis" name="jenis" aria-label="State" required>
                    <option  disabled selected>Pilih..</option>
                    <option value="Kesalahan Pabrik">Kesalahan Pabrik</option>
                    <option value="Kesalahan Konsumen">Kesalahan Konsumen</option>
                  </select>
                </div>

                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <div class="col-md-12 mb-3">
                  <label for="kondisi">Kondisi</label>
                  <textarea class="form-control" id="kondisi" name="kondisi" style="height: 100px;" required></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-primary" />
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
              <form action="#" method="POST" id="dmgHapusForm">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body mx-3">
                <h4 class="my-2 text-center">Apakah Anda yakin ingin menghapus data?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" name="hapusButton" id="hapusButton" class="btn btn-danger">Ya</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <!-- End Modal Hapus data -->
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

  

    //show modal tambah data
    $('#tambah_data').click(function(){
      $('#dmgForm')[0].reset();
      $('#id').prop( "disabled", false );
      $('.modal-title').text('Tambah Data Kerusakan');
      $('#action_button').val('Tambah');
      $('#action').val('Add');
      $('#form_result').html('');
      
      $('#dmgModal').modal('show');
    });

    //aksi tambah data
    $('#dmgForm').on('submit', function(event){
      event.preventDefault();
      var action_url = '';
      if ($('#action').val() == 'Add') {
        action_url = "{{ route('kerusakan.tambah') }}"
      }
      if ($('#action').val() == 'Edit') {
        action_url = "{{ route('kerusakan.update') }}"
      }
      
      $.ajax({
        type : 'post',
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url : action_url,
        data : $(this).serialize(),
        dataType : 'json',
        success : function (data) {
          if(data.success){
            var html = '<div class="alert alert-success alert-dismissible fade show" role="alert">'+ data.success ;
              html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
              html += '</div>';
            $('#dmgForm')[0].reset();
            $('#dmgModal').modal('hide');
            $('#dmgTable').DataTable().ajax.reload();
          }
          $('#alertDmg').html(html);
        },
        error : function(data){
          var errors = data.responseJSON;
          console.log(errors);
          var html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + errors.message;
                html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
              html += '</div>';
          $('#form_result').html(html);
        }
      });
    });

    //edit data
    $(document).on('click', '.edit', function (event) {
      event.preventDefault();
      var id = $(this).attr('id');
      // $('#dmgModal').modal('show');
      $('#form_result').html('');

      $.ajax({
        url : "/kerusakan/edit/"+id+"/",
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType : "json",
        success : function(data){
          console.log('success'+data);
          $('#nama').val(data.result.nama);
          $('#kondisi').val(data.result.kondisi);
          $('#jenis').val(data.result.jenis);
          $('#jenis').prop( "disabled", true );
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Data Kerusakan');
          $('#action_button').val('Update');
          $('#action').val('Edit');
          $('#dmgModal').modal('show');

        },
        error : function(data){
          var errors = data.responseJSON;
          var html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + errors.message;
                html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
              html += '</div>';
          $('#form_result').html(html);
        }
      });
    });

    var dmg_id;

    $(document).on('click', '.delete', function(){
      dmg_id = $(this).attr('id');
      $('#hapusDataModal').modal('show');
    })

    $('#hapusButton').click(function(){
      $.ajax({
        url : '/kerusakan/hapus/'+dmg_id,
            success:function(data)
            {
                $('#hapusDataModal').modal('hide');
                $('#hapusButton').text('Ya');
                $('#dmgTable').DataTable().ajax.reload();
                var html = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Dihapus' ;
              html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
              html += '</div>';
              $('#alertDmg').html(html);

            }
      });
    });

});
</script>

@endsection