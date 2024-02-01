@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <a href="/history/list" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali </a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Detail History Pembayaran</span></h1>
            <div class="col-lg-10 col-md-10">
                <ul class="list-unstyled mt-5">
                    <li class="text-black">Nama : {{ (Auth::user()->roles_type == 0) ? Auth::user()->name : '-' }}</li>
                    <li class="text-danger mt-1"><span class="text-black">Invoice : </span>#{{ $noInvoice }}</li>
                    <li class="text-black mt-1">Provinsi : {{ $provinsi }}</li>
                    <li class="text-black mt-1">Kota/Kabupaten : {{ $kota }}</li>
                    <li class="text-black mt-1">Alamat : {{ $alamat }}</li>
                    <li class="text-black mt-1">Status Pembayaran : <span
                            class="badge bg-{{ ($status == 'pending') ? 'warning text-black':'success text-white' }}">{{ $status }}</span></li>
                    <li class="text-black mt-1">Email : <span class="text-primary">{{ (Auth::user()->roles_type == 0) ? Auth::user()->email : '-' }}</span></li>
                    <li class="text-black mt-1">No Telp : <span class="text-primary">{{ (Auth::user()->roles_type == 0) ? Auth::user()->phone_number : '-' }}</span></li>
                </ul>
                <table class="table table-striped table-bordered text-center mb-5">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Motor</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->product->name_product }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>@currency($item->product->harga_product)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-4 text-black">
        <div class="row d-flex justify-content-end mt-3">
            <div class="col-md-6 text-end">
                <ul class="list-unstyled">
                    <li class="text-black">Kurir : {{ $kurir }}</li>
                    <li class="text-black">Paket : {{ $paket }}</li>
                    <li class="text-black">Harga Ongkir : @currency($ongkir)</li>
                    <li class="text-black">Total Harga : @currency($total_harga)</li>
                    <li class="text-black mt-2">
                        <h3 class="text-success fw-bold">Total Pembayaran : @currency($payment)</h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection