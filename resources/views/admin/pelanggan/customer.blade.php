@extends('layouts.main')

@section('container')

<!-- Pagetitle -->
<div class="pagetitle">
  <h5>Pelanggan</h5>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
  </nav>
</div>
<!-- End Pagetitle -->

<div class="card">
  <div class="card-body">
    <!-- Title Table -->
    <h5 class="card-title">Data Pelanggan</h5>
    <!-- End Title Table -->

    @if ($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <span id="alertCust"></span>

    <!-- Button Create -->
    <button type="button" class="btn btn-primary mb-2" name="tambah_data" id="tambah_data">
      <span class="icon text-white-50">
        <i class="bi bi-plus-lg"></i>
      </span>
      <span class="text">Tambah Data</span>
    </button>
    <!-- End Button Create -->

    <!-- Data Table -->
    <div class="table-responsive-xxl">
      <table class="table table-bordless w-100 table-striped " id="my-datatable-customer">
        <thead class="table-success w-100 text-centered">
          <tr>
            <th width="1%" ></th>
            <th width="1%" class="text-centered">Kode</th>
            <th width="5%" class="text-centered">Nama Pelanggan</th>
            <th width="5%" class="text-centered">Alamat</th>
            <th width="5%" class="text-centered">Telp</th>
            <th width="5%" class="text-centered">Email</th>
            <th width="10%" class="text-centered">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Data Table -->

    <!-- Modal Tambah Data Baru-->
    <div class="modal fade" id="custModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="custModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" id="custForm" method="POST" class="row g-3">
            <div class="modal-body mx-3" >
              <span id="form_result"></span>

              <div class="col-md-12 mb-3">
                <label for="distributor_id">Distributor</label>
                <select class="form-select search-select" data-width="100%" id="distributor_id" name="distributor_id" aria-label="State" required>
                  <option  disabled selected >Pilih Distributor</option>
                  @foreach ($distributor as $dist)
                  <option value="{{ $dist->id }}">{{ $dist->nama }}</option>
                  @endforeach
                  </select>
              </div>

                <div class="col-md-12 mb-3">
                  <label for="nama">Nama Pelanggan</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" id="alamat" name="alamat" style="height: 100px;" required></textarea>
                 </div>

                <div class="col-md-12 mb-3">
                  <label for="telp">Telp</label>
                  <input type="number" class="form-control" id="telp" name="telp" required>
                  </div>

                <div class="col-md-12 mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                  </div>

                  <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
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
<script type="text/javascript">
$(document).ready(function() {

  $(".search-select").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#custModal")
  });

  //show modal tambah data
  $('#tambah_data').click(function(){
    $('#custForm')[0].reset();
    $('.modal-title').text('Tambah Data Pelanggan');
    $('#action_button').val('Tambah');
    $('#action').val('Add');
    $('#form_result').html('');
    $('#custModal').modal('show');
  });


  //aksi tambah data
  $('#custForm').on('submit', function(event){
    event.preventDefault();
    var action_url = '';
    if ($('#action').val() == 'Add') {
      action_url = "{{ route('customer.tambah') }}"
    }
    if ($('#action').val() == 'Edit') {
      action_url = "{{ route('customer.update') }}"
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
          $('#custForm')[0].reset();
          $('#custModal').modal('hide');
          $('#custTable').DataTable().ajax.reload();
        }
        $('#alertCust').html(html);
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

  //edit data
  $(document).on('click', '.edit', function (event) {
      event.preventDefault();
      var id = $(this).attr('id');
      // $('#custModal').modal('show');
      $('#form_result').html('');

      $.ajax({
        url : "/customer/edit/"+id+"/",
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType : "json",
        success : function(data){
          console.log('success'+data);
          $('#nama').val(data.result.nama);
          $('#alamat').val(data.result.alamat);
          $('#email').val(data.result.email);
          $('#telp').val(data.result.telp);
          $('#distributor_id').val(data.result.distributor_id);
          $('#distributor_id').prop( "disabled", true );
          $('#id').val(id);
          $('#id').prop( "disabled", true );
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Data Kerusakan');
          $('#action_button').val('Update');
          $('#action').val('Edit');
          $('#custModal').modal('show');

        },
        error : function(data){
          var errors = data.responseJSON;
          console.log(errors);
        }
      });
    });

    var cust_id;

    $(document).on('click', '.delete', function(){
      cust_id = $(this).attr('id');
      $('#hapusDataModal').modal('show');
    })

    $('#hapusButton').click(function(){
      $.ajax({
        url : '/customer/hapus/'+cust_id,

            success:function(data)
            {
                $('#hapusDataModal').modal('hide');
                $('#hapusButton').text('Ya');
                $('#custTable').DataTable().ajax.reload();
                var html = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Dihapus' ;
              html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
              html += '</div>';
              $('#alertCust').html(html);
            }
      });
    });

});
</script>
@endsection
