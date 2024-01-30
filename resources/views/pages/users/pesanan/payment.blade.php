@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-5">
            <h1 class="section-title px-5 text-center mb-4"><span class="px-2">Payment Ordered Now</span></h1>
            <div class="col-lg-7 mt-3">
                <div class="card shadow border-0 my-5">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-5 mb-3">
                                <p>Nama : <span>{{ auth()->user()->name }}</span></p>
                                <p>Email : <span>{{ auth()->user()->email }}</span></p>
                                <p>Phone : <span>{{ auth()->user()->phone_number }}</span></p>
                                <h6>
                                    <span>Total Harga (Rp) : </span>
                                    <strong class="text-primary">@currency($totalHarga)</strong>
                                </h6>
                            </div>
                            <div class="col-md-7 mb-3">
                                <ul class="list-group mb-3">
                                    @foreach ($cartData as $item)
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">{{ $item->product->name_product }}</h6>
                                                <small class="text-dark d-block my-1">Tahun Rilis :
                                                    {{ $item->product->launch_year }}
                                                </small>
                                                <small class="text-danger d-block my-1">Nomor Seri :
                                                    {{ $item->product->nomor_seri }}</small>
                                                <small class="text-success fw-bold my-1">Harga : @currency($item->product->harga_product)</small>
                                            </div>
                                            <span class="text-danger">{{ $item->quantity }} Unit</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-warning" type="button" id="pay-button">
                                <i class="fas fa-fw fa-wallet"></i>
                                Bayar Sekarang
                            </button>
                            <form action="{{ route('checkout.confirm') }}" id="payment-submit" method="POST">
                                @csrf
                                <input type="hidden" name="json" id="json-callback">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const payButton = document.querySelector('#pay-button');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();
    
                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                        sendResponseForm(result);
                        // window.location.href = '/success/payment';
                    },
                    // Optionalx
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                        sendResponseForm(result);
                        window.location.href = '/pending/payment'
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                        sendResponseForm(result);
                        window.location.href = '/error/payment'
                    },
                    onClose: function() {
                        console.log(result);
                        sendResponseForm(result);
                        return;
                    }
                });
            });

            function sendResponseForm(result){
                document.getElementById('json-callback').value = JSON.stringify(result);
                $('#payment-submit').submit();
            }
    </script>
@endpush