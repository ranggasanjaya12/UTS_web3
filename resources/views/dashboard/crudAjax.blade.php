@extends('dashboard/master')
@section('title', 'CRUD Simple')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            

            <div class="card">
              <div class="card-header">

          <!-- Button Tambah -->
          <button type="button" class="tambah btn btn-primary" data-toggle="modal" id="tambah" data-target="#modalTambah">
              + Tambah Data 
          </button>
          <!-- End Button Tambah -->
              <!-- Modal Tambah -->
            <form enctype="multipart/form-data">                                   
              <div class="modal fade" id="modalTambah">
                <input type="hidden" id="id" name="id">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="judul_modal">Tambah Data Baru</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="nim">nim</label>
                            <input type="text" class="form-control rounded-0 @error('nim') is-invalid @enderror" id="nim" name="nim" value="" placeholder="nim....">
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="text" class="form-control rounded-0 @error('nama') is-invalid @enderror" id="nama" name="nama" value="" placeholder="nama....">
                        </div>
                        <div class="form-group">
                            <label for="nama">dosen</label>
                            <select class="form-control rounded-0 @error('dosen') is-invalid @enderror" id="dosen" name="dosen">
                                <option value="">Pilih nama...</option>
                                @foreach($dummies as $dummy)
                                    <option value="{{ $dummy->nama }}">{{ $dummy->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="dosen">dosen</label>
                            <select class="form-control rounded-0 @error('dosen') is-invalid @enderror" id="dosen" name="dosen">
                                <option value="">Pilih dosen...</option>
                                <option value="Rentan">Rentan</option>
                                <option value="Terancam">Terancam</option>
                                <option value="Terancam Punah">Terancam Punah</option>
                                <option value="Sangat Terancam Punah">Sangat Terancam Punah</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
            </form>
            <!-- Modal Tambah End -->


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>nim</th>
                    <th>nama</th>
                    <th>dosen</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                                  
                  </tbody>
                  <tfoot>
                  <tr class="text-center"> 
                    <th>No</th>
                    <th>nim</th>
                    <th>nama</th>
                    <th>dosen</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')
<!-- DataTables  & Plugins -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


@endsection
@section('ajax')
 <script>

  // Tampilkan data
  $(document).ready(function(){
    isi_table()
  })

  
  function isi_table(){  
        $('#table1').DataTable({
          serverside : true,
          responsive : true,
          ajax : {
              url : "{{ route('crudAjax') }}"
          },
          columns : [
            {
              "data" : null, "sortable" : false,
              render : function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1
              }
            },
            {data: 'nim', name: 'nim'},
            {data: 'nama', name: 'nama'},
            {data: 'dosen', name:'dosen'},
            {data: 'Aksi', name: 'Aksi'}
          ]
        })
    }
    
    //Reset Form
    $('#tambah').on('click', function(){
        $("#simpan").removeClass("btn btn-warning")
        $("#simpan").addClass("btn btn-primary")
        $('#simpan').text('Simpan')  
        $('#judul_modal').text('Tambah Data Baru');           
        $("#modalTambah [name='nim']").val('')
        $("#modalTambah [name='nama']").val('')
        $("#modalTambah [name='dosen']").val('')
    })

    // Tambah Data
    $('#simpan').on('click', function(){
      if($(this).text() === 'Simpan'){
          event.preventDefault()  
          tambah()      
        } else {           
          event.preventDefault()
          update()
        }
    })

    function tambah(){
        $('#simpan').text('Simpan')          
            $.ajax({
              url : "{{ route('crudAjax_tambah') }}",
              type : "POST",
              data : {
                nim : $('#nim').val(),
                nama : $('#nama').val(),
                dosen: $('#dosen').val(),
                "_token" : "{{ csrf_token() }}"
              },
              success : function (res){
                console.log(res);
                $("#table1").DataTable().ajax.reload();
                    // alert
                  Swal.fire(
                    'Sukses',
                    'Data berhasil ditambahkan',
                    'success'           
                  );
                  $("#modalTambah .close").click();
                  $("#modalTambah [name='nim']").val('');
                  $("#modalTambah [name='nama']").val('');
                  $("#modalTambah [name='dosen']").val('');
              },
              error:function(err) {
                    console.log(err)
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Terjadi Kesalahan',                
                    })
                    $("#modalTambah [name='nim']").addClass("is-invalid")
                    $("#modalTambah [name='nama']").addClass("is-invalid")       
                    $("#modalTambah [name='dosen']").addClass("is-invalid")       
                }
           })
     }

      function tambah(){
        $('#simpan').text('Simpan')          
            $.ajax({
              url : "{{ route('crudAjax_tambah') }}",
              type : "POST",
              data : {
                nim : $('#nim').val(),
                nama : $('#nama').val(),
                dosen : $('#dosen').val(),
                "_token" : "{{ csrf_token() }}"
              },
              success : function (res){
                console.log(res);
                $("#table1").DataTable().ajax.reload();
                    // alert
                  Swal.fire(
                    'Sukses',
                    'Data berhasil ditambahkan',
                    'success'           
                  );
                  $("#modalTambah .close").click();
                  $("#modalTambah [name='nim']").val('');
                  $("#modalTambah [name='nama']").val('');
                  $("#modalTambah [name='dosen']").val('');
              },
              error:function(err) {
                    console.log(err)
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Terjadi Kesalahan',                
                    })
                    $("#modalTambah [name='nim']").addClass("is-invalid")
                    $("#modalTambah [name='nama']").addClass("is-invalid")       
                    $("#modalTambah [name='dosen']").addClass("is-invalid")       
                }
           })
     }

      // Show Update Data     
      $(document).on('click', '.update', function(){  
            let id = $(this).attr('id')      
              $('#tambah').click()  
              $('#simpan').text('Perbaharui Data')
              $('#judul_modal').text('Ubah Data')
              $("#simpan").removeClass("btn btn-primary")
              $("#simpan").addClass("btn btn-warning")
            $.ajax({
              url : "{{ route('crudAjax_show') }}",
              type : 'POST',
              data : {
                id : id,
                "_token" : "{{ csrf_token() }}"
              },
              success: function (res){
                  $("#modalTambah [name='id']").val(res.data.id)
                  $("#modalTambah [name='nim']").val(res.data.nim)
                  $("#modalTambah [name='nama']").val(res.data.nama)
                  $("#modalTambah [name='dosen']").val(res.data.dosen)
                  $("#modalTambah [name='dosen']").removeClass("is-invalid")   
                  $("#modalTambah [name='dosen']").removeClass("is-invalid")   
                  $("#modalTambah [name='nama']").removeClass("is-invalid")   
                  $("#modalTambah [name='nama']").removeClass("is-invalid")                    
              }
            })                     
          }) 
    
          function update(){        
            $.ajax({
              url : "{{ route('crudAjax_update') }}",
              type : "POST",
              data : {
                id : $('#id').val(),
                nim : $('#nim').val(),
                nama : $('#nama').val(),
                dosen : $('#dosen').val(),
                "_token" : "{{ csrf_token() }}"
              },
              success : function (res){
                console.log(res);
                $("#table1").DataTable().ajax.reload();
                    // alert
                  Swal.fire(
                    'Sukses',
                    'Data berhasil ditambahkan',
                    'success'           
                  );
                  $("#modalTambah .close").click();
                  $("#modalTambah [name='nim']").val('');
                  $("#modalTambah [name='nama']").val('');
                  $("#modalTambah [name='dosen']").val('');
                  $('#simpan').text('Simpan');
              },
              error:function(err) {
                    console.log(err)
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Terjadi Kesalahan',                
                    })
                    $("#modalTambah [name='nim']").addClass("is-invalid")
                    $("#modalTambah [name='nama']").addClass("is-invalid")       
                    $("#modalTambah [name='dosen']").addClass("is-invalid")       
                }
           })
          }

          $(document).on('click', '.destroy', function(){
            Swal.fire({
                      title: 'Apakah anda yakin ?',
                      text: "Data akan dihapus secara permanen",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#d33',
                      cancelButtonColor: '#3085d6',
                      confirmButtonText: 'Hapus data',
                      cancelButtonText: 'Batalkan'
                      }).then((result) => {
                      if (result.isConfirmed) {
                        Swal.fire(
                          'Data berhasil dihapus!',
                          'Data telah terhapus secara permanen.',
                          'success'
                        )

                        let id = $(this).attr('id')                 
                        $.ajax({
                          url : "{{ route('crudAjax_destroy') }}",
                          type : 'POST',
                          data : {
                            id : id,
                            "_token" : "{{ csrf_token() }}"
                          },
                          success: function(){                                             
                            $("#table1").DataTable().ajax.reload();
                            }
                          })
                      }
                })
          })
 </script>
    
@endsection
