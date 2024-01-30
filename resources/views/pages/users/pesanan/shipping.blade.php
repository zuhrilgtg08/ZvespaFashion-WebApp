@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <a href="{{ route('cart.list') }}" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i>
            Kembali
        </a>
        <div class="row justify-content-center mb-5">
            <h1 class="section-title px-5 text-center mb-4"><span class="px-2">Add Shipping Tax</span></h1>
            
            <div class="col-10 mt-5">
                <div class="row justify-content-between mt-4">
                    <div class="col-md-7 col-lg-8 order-md-last">
                        <form class="d-inline" action="{{ route('shipping.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_amount" value="{{ $total_amount }}" id="total_amount" />
                
                            <div class="row col-12 ">
                                <div class="col-sm-6 mb-3">
                                    <label for="name">Nama Pemesan : </label>
                                    <input type="text" class="form-control" id="name" value="{{ (auth()->user()->roles_type == 0) ? Auth::user()->name : '-'}}" disabled readonly />
                                </div>
                
                                <div class="col-sm-6 mb-3">
                                    <label for="phone">Nomor Hp :</label>
                                    <input type="text" class="form-control" id="phone" value="{{ (auth()->user()->roles_type == 0) ? Auth::user()->phone_number : '-' }}" min="0" disabled readonly />
                                </div>
                
                                <div class="col-sm-6 mb-3">
                                    <label for="email">Email :</label>
                                    <input type="email" class="form-control" id="email" value="{{ (auth()->user()->roles_type == 0) ? Auth::user()->email : '-' }}" disabled readonly />
                                </div>
                
                                <div class="col-sm-6 mb-3">
                                    <label for="weight">Total Berat :</label>
                                    <input type="hidden" name="total_berat" id="weight" class="form-control" value="{{ $weight }}" />
                                    <input type="text" id="weight" class="form-control text-danger fw-bold" value="{{ $weight / 1000 }} Gram" disabled />
                                </div>
                
                                <div class="col-md-6 mb-3">
                                    <label for="province">Provinsi Tujuan :</label>
                                    <select class="custom-select" name="province_id" id="province" required>
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}" {{ (Auth::user()->u_prov_id == $item->id) ? 'selected' : '' }}>{{ old('province_id', $item['name_province']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-md-6 mb-3">
                                    <label for="city">Kota/Kabupaten :</label>
                                    <select class="custom-select" name="destination_id" id="destination" required>
                                        @if (Auth::user()->u_kota_id != 0)
                                            @foreach ($kota as $item)
                                                <option value="{{ $item->id }}" {{ Auth::user()->u_kota_id == $item->id ? 'selected' : '' }}>{{ $item->nama_kab_kota }}</option>
                                            @endforeach
                                        @else
                                            <option>Pilih Kota/Kabupaten</option>
                                        @endif
                                    </select>
                                </div>
                
                                <div class="col-md-4 mb-3">
                                    <label for="courier">Pilih Kurir :</label>
                                    <select class="custom-select" name="courier" id="courier" required>
                                        <option disabled selected>Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS INDONESIA</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                
                                <div class="col-md-4 mb-3">
                                    <label for="layanan-ongkir">Layanan :</label>
                                    <select class="custom-select" name="layanan_ongkir" id="layanan-ongkir" required>
                                        <option selected value="">Pilih Paket</option>
                                    </select>
                                </div>
                
                                <div class="col-md-4 mb-3">
                                    <label for="services">Harga :</label>
                                    <select class="custom-select" name="harga_ongkir" id="services" required>
                                        <option selected value="">Pilih Harga</option>
                                    </select>
                                </div>
                
                                <div class="col-md mt-3">
                                    <label for="alamat" class="form-label">Alamat :</label>
                                    <textarea class="form-control" placeholder="Tulis Alamat" rows="3" id="alamat" style="height: 100px"
                                        name="alamat" required>{{ old('alamat', auth()->user()->alamat ?? '-') }}</textarea>
                                </div>
                            </div>
                
                            <hr class="my-4">
                
                            <div class="text-center" style="margin-left: 25rem;">
                                <button class="btn btn-success rounded" type="submit">
                                    <i class="fas fa-fw fa-check"></i>
                                    Konfirmasi Pesanan
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-danger">Pesanan Anda</span>
                        </h4>
                        <ul class="list-group mb-3">
                            @foreach ($items as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $item->product->name_product }}</h6>
                                    <small class="text-danger d-block">Nomor Seri : {{ $item->product->nomor_seri }}</small>
                                    <small class="text-success fw-bold">Harga : @currency($item->product->harga_product)</small>
                                </div>
                                <span class="text-danger">{{$item->quantity }} Unit </span>
                            </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Pesanan (Rp) : </span>
                                <strong>@currency($total_amount)</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Ongkos Kirim : </span>
                                <strong class="cost-ongkir">Rp. 0</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Paket : </span>
                                <strong class="paket-ongkir">-</strong>
                            </li>
                        </ul>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="d-flex justify-content-between align-items-center">
                                    <span>Total Harga (Rp) : </span>
                                    <strong class="total-harga text-success">Rp. 0</strong>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
                    $('select[name="province_id"]').on('change', function() {
                        let provinces = $(this).val();
                        if(provinces) {
                            $.ajax({
                                type: "GET",
                                url: "/data/city/" + provinces,
                                dataType: "json",
                                success: function (response) {
                                    $('select[name="destination_id"]').empty();
                                    $.each(response, function(key, value) {
                                        $('select[name="destination_id"]').append(
                                            '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                        );
                                    });
                                }
                            });
                        } else {
                            $('select[name="destination_id"]').empty();
                        }
                    });
    
                    $('select[name="courier"]').on('change', function() {
                        let destination = $("select[name=destination_id]").val();
                        let courier = $("select[name=courier]").val();
                        let weight = $("input[name=total_berat]").val();
    
                        if(courier) {
                            jQuery.ajax ({
                                url:"/destination="+destination+"&weight="+weight+"&courier="+courier,
                                type:'GET',
                                dataType:'json',
                                success:function(response) {
                                    $('select[name="harga_ongkir"]').empty();
                                    $('select[name="layanan_ongkir"]').empty();
                                    $('.total-harga').empty();
                                    response = response[0];
                                        $.each(response.costs, function(key, value) {
                                            let cost = value.cost[0];
                                            $('select[name="harga_ongkir"]').append('<option value="'+ cost.value + '">' + ' Rp. ' + cost.value + '</option>');
                                            $('select[name="layanan_ongkir"]').append('<option value="'+ value.service + ' : ' + cost.etd + ' (days) '+'">' + value.service + ' - ' + value.description + ' : ' + cost.etd + ' (days) ' + '</option>');
                                        });
                                    const total_belanja = $('#total_amount').val();
                                    let costKurir = response.costs[0].cost[0].value;
                                    let paketOngkir = `${response.costs[0].service} : ${response.costs[0].cost[0].etd} (days)`;
                                    $('.cost-ongkir').html(`Rp. ${costKurir}`);
                                    $('.paket-ongkir').html(paketOngkir);
                                    $('.total-harga').html(`Rp. ${parseInt(costKurir) + parseInt(total_belanja)}`);
                                }
                            });
                        }else {
                            $('select[name="harga_ongkir"]').empty();
                            $('select[name="layanan_ongkir"]').empty();
                        }
                    });
    
                    $('#services').on('change', function(){
                        let services = $(this).val();
                        const total_belanja = $('#total_amount').val();
                        const price = `${parseInt(services) + parseInt(total_belanja)}`;
                        const fixedPrice = new Intl.NumberFormat().format(price)
                        $('.total-harga').html(`Rp. ${fixedPrice}`);
                        $('.cost-ongkir').html(`Rp. ${new Intl.NumberFormat().format(services)}`);
                    });
    
                    $('#layanan-ongkir').on('change', function(){
                        let paketOngkir = $(this).val();
                        $('.paket-ongkir').html(paketOngkir);
                    });
                });
    </script>
@endpush