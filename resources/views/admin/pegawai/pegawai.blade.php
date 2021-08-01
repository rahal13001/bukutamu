@extends('layouts.layout')

@section('judul', 'Buku Tamu LPSPL Sorong')

@section('isi')


<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session ('status') }}
    </div>
    @endif
        <div class="card-body">
            <a href="{{  route('pegawai_create') }}" class="btn btn-primary mb-3 float-right">
                + Tambah Data Pegawai
            </a>
            <div class="table-responsive">
            <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable" width="100%" cellspacing="0" id="crudtable">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        <tbody class="text-center">
        </tbody>
        </table>
    </div>
    </div>
</div>
    
@endsection

@push('addon-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data:'id',
                      sortable: false, 
                       render: function (data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                      } },
                    {data: 'name', name : 'name'},
                    {data: 'nip', name : 'nip'},
                    {data: 'jabatan', name : 'jabatan'},
                    {
                        data: 'aksi',
                        name : 'aksi',
                        orderable : false,
                        searchable : false,
                        width : '15%'
                    },
            ]
        });

    </script>
@endpush