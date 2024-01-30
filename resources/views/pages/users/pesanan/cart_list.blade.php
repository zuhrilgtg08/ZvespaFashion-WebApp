@extends('layouts.client.master')

@push('styles')
   <style>
        .btn:focus {
            box-shadow: none !important;
        }
    
        .box {
            margin-top: 2.5rem;
        }
    
        input {
            height: 30px;
            width: 100px;
            text-align: center;
            font-size: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
            vertical-align: middle;
        }
    </style> 
@endpush

@section('master-content')
    <div class="container-fluid">
        <a href="/popular" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> More Shopping </a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">List Products - {{ auth()->user()->name }}</span></h1>
            <div class="col-lg-8 col-md-8 my-5">
                <div class="table-responsive">
                    <table class="table table-lg text-center table-striped">
                        <thead class="text-white" style="background-color: #c71a3a;">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td class="col-3">
                                        @if ($item->product->thumbnail)
                                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}" width="100" height="100" alt="img-product" />
                                        @else
                                            <img src="{{ asset('assets/dashboard/img/404.png') }}" alt="img-product" width="100" height="100" class="img-thumbnail" />
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline" id="cart-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="box">
                                                <button type="button" class="btn btn-sm minus bg-transparent {{ ($item->quantity >= $item->product->stock_product) ? 'd-none' : ''}}">
                                                    <i class="fas fa-fw fa-minus"></i>
                                                </button>
                                                <input type="number" style="text-align:center;" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_product }}" {{ ($item->quantity >= $item->product->stock_product) ? 'disabled' : ''}} />
                                                <button type="button" class="btn btn-sm plus bg-transparent {{ ($item->quantity >= $item->product->stock_product) ? 'd-none' : ''}}">
                                                    <i class="fas fa-fw fa-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="box">
                                            <h6 class="text-success">@currency($item->product->harga_product)</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" style="margin-top: 2rem;">
                                                <i class="fas fa-fw fa-trash text-white fs-4 text-center"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 my-5">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-primary">
                        <h5 class="mb-0 text-white text-center">Detail Products Amount</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Quantity
                                <span>{{ $qty ?? 0 }} Item</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total Payment</strong>
                                    <strong>
                                        <p class="mb-0">(Not Including Shipping)</p>
                                    </strong>
                                </div>
                                <span><strong>@currency($amount ?? Rp. 0)</strong></span>
                            </li>
                        </ul>
            
                        <div class="mx-auto text-center {{ $list->isEmpty() ? 'd-none' : '' }}">
                            <a href="{{ route('shipping.create') }}" class="btn btn-primary btn-lg btn-block">
                                Go to add shipping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
                $('.minus').click(function () {
                    let $form = $(this).closest('form');
                    let $input = $(this).parent().find('input');
                    let count = parseInt($input.val()) - 1;
                    let timer;
                    if(timer) {clearTimeout(timer);}
                    count = count < 1 ? 1 : count; 
                    $input.val(count); 
                    $input.change(); 
                    timer = setTimeout($form.submit(), 100);
                    return false; 
                }); 
    
                $('.plus').click(function () { 
                    let $form = $(this).closest('form');
                    let $input=$(this).parent().find('input'); 
                    $input.val(parseInt($input.val()) + 1); 
                    $input.change(); 
                    $form.submit();
                    return false; 
                });
            });
    </script>
@endpush