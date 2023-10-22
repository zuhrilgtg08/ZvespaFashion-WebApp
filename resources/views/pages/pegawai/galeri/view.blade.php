@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.galeri'])


@push('style')
    <link href="{{ asset('assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">List Galeri Foto Content</h1>
    <div class="card shadow my-4">
        <div class="card-header py-3">
            <a href="{{ route('karyawan.galeri.create') }}" class="m-0 font-weight-bold btn btn-success">
                <i class="fas fa-fw fa-plus-circle"></i> Gambar Baru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover data-table" id="view-table" width="100%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama File</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/dashboard/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var datatable = $('#view-table').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: "{{ route('karyawan.galeri.index') }}",
                columns: [{
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'uuid',
                        name: 'uuid',
                    },
                    {
                        data: 'name_file',
                        name: 'name_file',
                    },
                    {
                        name: "photos",
                        data: "photos",
                        render: function( data, type, full, meta ) {
                            return '<img src=\'' + data + '\' class=\'rounded-circle\' width=\'50px\' height=\'50px\' style=\'border-radius: 50%\' alt=\'img-photos\'/>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searcable: false,
                        targets: 0,
                    }],
                order: [[1, 'asc']],
            });
        })
    </script>
@endpush