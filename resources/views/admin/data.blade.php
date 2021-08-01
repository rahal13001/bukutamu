@extends('layouts.layout')

@section('judul', 'Buku Tamu LPSPL Sorong')

@section('isi')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Tamu LPSPL Sorong</h6>
    </div>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session ('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    @endif
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ route('admin_create') }}" class="btn btn-primary mt-2">
                        Tambah Data
                    </a>
                </div>
        
                <div class="col-sm-10">     
                    <!-- MULAI DATE RANGE PICKER -->
                
                <form action="{{ route('export') }}" method="GET">
                    @csrf
                    <div class="row input-daterange mb-3">
                        <div class="col-md-2 mt-2">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Dari Tanggal"
                                readonly />
                        </div>
                        <div class="col-md-2 mt-2">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Ke Tanggal"
                                readonly />
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="button" name="filter" id="filter" class="btn btn-primary mt-2">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-secondary mt-2">Refresh</button>
                            <button type="submit" class="btn btn-success mt-2">Export Excel</button>
                        </div>
                    </div>
                    
                </form>
                </div>  
     </div>
            <!-- AKHIR DATE RANGE PICKER -->
            <div class="table-responsive">
                    <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable" width="100%" cellspacing="0" id="crudtable">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">+</th>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Asal Instansi</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Menemui</th>
                        <th scope="col">Jam Datang</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            <tbody class="text-center">
                {{-- @foreach ($employe as $pgw)
                <tr>
                    <th scope="row">{{ $loop -> iteration }}</th>
                    <td>{{ $pgw -> nama }}</td>
                    <td>{{ $pgw -> nip }}</td>
                    <td>{{ $pgw -> pangkat }}</td>
                    <td>{{ $pgw -> jabatan }}</td>
                    <td>
                        <a href="/pegawai/{{$pgw->id_pegawai}}" class="badge badge-info">Detail</a>

                    </td>
                </tr>
                @endforeach --}}
            </tbody>
            </table>
            </div>
    </div>
</div>

@endsection

@push('addon-script')

<style>

    td.details-control {
        background: url('../img/chevron-double-down.svg') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('../img/chevron-double-up.svg') no-repeat center center;
    }
    </style>

    <script>

function template ( d ) {


    return '<table class="table table-bordered table-hover scroll-horizontal-vertical table-responsive">'+
        '<tr>'+
            '<td>Keperluan</td>'+
            '<td>'+d.keperluan+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Jenis Kelamin</td>'+
            '<td>'+d.jk+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Lokasi</td>'+
            '<td>'+d.lokasi+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Email</td>'+
            '<td>'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Suhu</td>'+
            '<td>'+d.suhu+'</td>'+
        '</tr>'+
        '</table>'

}



//Ajax Data Table Mulai
       $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    load_data();

        //Iniliasi datepicker pada class input
        $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });


            $('#filter').click(function () {
                var from_date = $('#from_date').val(); 
                var to_date = $('#to_date').val(); 
                if (from_date != '' && to_date != '') {
                    $('#crudTable').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Rentang Tanggal Harus Diisi');
                }
            });
            $('#refresh').click(function () {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#crudTable').DataTable().destroy();
                load_data();
            });


        // AJAX DataTable
        function load_data(from_date = '', to_date = '') {
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',
                data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                    // {data: 'null', sortable : false,
                    // render : function (data, type, row, meta){
                    // return meta.row + meta.setting._iDisplayStart + 1;}},
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "searchable":     false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { data:'id',
                      sortable: false, 
                       render: function (data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                      } },
                    // {data: 'id', name : 'id'},
                    {data: 'tanggal', name : 'tanggal'},
                    {data: 'nama', name : 'nama'},
                    {data: 'instansi', name : 'instansi'},
                    {data: 'no_hp', name : 'no_hp'},
                    {data: 'employe.name', name : 'employe.name'},
                    {data: 'datang', name : 'datang'},
                    {data: 'pulang', name : 'pulang'},
                    {
                        data: 'aksi',
                        name : 'aksi',
                        orderable : false,
                        searchable : false,
                        width : '15%'
                    },
            ]
        });
        $('#crudTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = datatable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( template(row.data()) ).show();
            tr.addClass('shown');
        }
    });




        }
    });

   


    </script>
@endpush