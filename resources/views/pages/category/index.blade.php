@extends('layouts.app-main')
@section('css')
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }} ">
  <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }} ">
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @if(Session::has('flash_message'))
    <input type="hidden"  class="swalDefaultSuccess" value="{{ Session::get('flash_message') }}">
  @endif
  {{-- <button type="button" class="btn btn-success swalDefaultSuccess">
    Launch Success Toast
  </button> --}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="border-bottom: 0px;">
              <div class="box-header" style="float: right;">
                <a href="{{ route('add-category') }}" class="btn btn-success pull-right">Add </a>
              </div>
            </div>
            <div class="card-body">
              <table id="category_table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Sr no</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr no</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
  <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }} "></script>
  <script src="{{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- <script src="../../dist/js/adminlte.min.js"></script> -->

  <script>
    $(document).ready(function () {
      var table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("index-category") !!}',
        lengthMenu: [[10, 15, 30, 50],[10, 15, 30, 50]],
        responsive: {
          details: true
        },
        orderCellsTop: true,
        fixedHeader: true,

        "columns": [{
            data: 'DT_RowIndex',
            orderable: true,
            searchable: false
          },
          {data: 'category_name'},
          {data: 'status'},
          {data: 'edit',orderable: false},
        ],

      });
      // Setup - add a text input to each header cell
      $('#example thead tr:eq(1) th').each(function (i) {
        if (i != 0 && i != 6) {
          var title = $('#example thead tr:eq(0) th').eq($(this).index()).text();
          $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        }
      });

      // Apply the search
      table.columns().every(function (index) {
        $('#example thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
          table.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
        });
      });

      window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 4000);


      
    });
    // $(function (){
    //   $('#example1').DataTable({
    //     "paging"        : true,
    //     "lengthChange"  : false,
    //     "searching"     : false,
    //     "ordering"      : true,
    //     "info"          : true,
    //     "autoWidth"     : false,
    //     "responsive"    : true,
    //   });
    // });
  </script>

  <script>
    $(document).ready(function(){
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon  : 'success',
          title : $(this).val()
        })
      }).trigger('click');

    });
  </script>
@endsection