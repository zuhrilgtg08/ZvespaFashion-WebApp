@extends('layouts.client.master')

@push('styles')
    <link href="{{ asset('assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@section('master-content')
    <div class="container-fluid">
        <a href="/home" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali </a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">History Pesanan</span></h1>
            <div class="col-lg-10 col-md-10">
                <div class="card shadow my-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover data-table" id="view-table" width="100%" cellspacing="0">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Vespa</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/dashboard/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var datatable = $('#view-table').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: "{{ route('history.index') }}",
                columns: [{
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama_vespa',
                        name: 'nama_vespa',
                    },
                    {
                        data: 'kuantitas',
                        name: 'kuantitas',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'ship_status',
                        name: 'ship_status',
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