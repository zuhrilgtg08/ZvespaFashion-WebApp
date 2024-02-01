<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}
        <title>Print Invoice</title>
        <style>
            @font-face {
                font-family: Arial, Helvetica, sans-serif;
            }

            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #001028;
                text-decoration: none;
            }

            body {
                font-family: Junge;
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-size: 14px;
            }

            .arrow {
                margin-bottom: 4px;
            }

            .arrow.back {
                text-align: right;
            }

            .inner-arrow {
                padding-right: 10px;
                height: 30px;
                display: inline-block;
                background-color: rgb(233, 125, 49);
                text-align: center;

                line-height: 30px;
                vertical-align: middle;
            }

            .arrow.back .inner-arrow {
                background-color: rgb(233, 217, 49);
                padding-right: 0;
                padding-left: 10px;
            }

            .arrow:before,
            .arrow:after {
                content: '';
                display: inline-block;
                width: 0;
                height: 0;
                border: 15px solid transparent;
                vertical-align: middle;
            }

            .arrow:before {
                border-top-color: rgb(233, 125, 49);
                border-bottom-color: rgb(233, 125, 49);
                border-right-color: rgb(233, 125, 49);
            }

            .arrow.back:before {
                border-top-color: transparent;
                border-bottom-color: transparent;
                border-right-color: rgb(233, 217, 49);
                border-left-color: transparent;
            }

            .arrow:after {
                border-left-color: rgb(233, 125, 49);
            }

            .arrow.back:after {
                border-left-color: rgb(233, 217, 49);
                border-top-color: rgb(233, 217, 49);
                border-bottom-color: rgb(233, 217, 49);
                border-right-color: transparent;
            }

            .arrow span {
                display: inline-block;
                width: 80px;
                margin-right: 20px;
                text-align: right;
            }

            .arrow.back span {
                margin-right: 0;
                margin-left: 20px;
                text-align: left;
            }

            h1 {
                color: #5D6975;
                font-family: Junge;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                border-top: 1px solid #5D6975;
                border-bottom: 1px solid #5D6975;
                margin: 0 0 2em 0;
            }

            h1 small {
                font-size: 0.45em;
                line-height: 1.5em;
                float: left;
            }

            h1 small:last-child {
                float: right;
            }

            #project {
                float: left;
            }

            #company {
                float: right;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 30px;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: center;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: middle;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
                text-align: center
            }

            table td.sub {
                border-top: 1px solid #C1CED9;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
            }

            table tr:nth-child(2n-1) td {
                background: #EEEEEE;
            }

            table tr:last-child td {
                background: #DDDDDD;
            }

            #details {
                margin-bottom: 30px;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
        {{-- <link rel="stylesheet" href="{{ asset('assets/customer/struk/style.css') }}" media="all" /> --}}
    </head>

    <body>
        <main>
            <h1 class="clearfix">
                INVOICE - {{ Auth::user()->name }}
                <small>
                    <span>DATE</span><br />
                    {{ date('F j, Y') }}
                </small>
            </h1>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="desc">Product</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($datas as $item)
                        <tr>
                            <td class="service">{{ $no++ }}</td>
                            <td class="desc">{{ $item->product->name_product }}</td>
                            <td class="unit">@currency($item->product->harga_product)</td>
                            <td class="qty">{{ $item->quantity }} Item</td>
                            <td class="total">@currency($item->product->harga_product * $item->quantity)</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="sub">SUBTOTAL</td>
                        <td class="sub total">@currency($total_harga)</td>
                    </tr>
                    <tr>
                        <td colspan="4">ONGKOS KIRIM</td>
                        <td class="total">@currency($ongkir)</td>
                    </tr>
                    <tr>
                        <td colspan="4">TAX</td>
                        <td class="total">@currency(5000)</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">@currency($payment + 5000)</td>
                    </tr>
                </tbody>
            </table>
            <div id="details" class="clearfix">
                <div id="project">
                    <div class="arrow">
                        <div class="inner-arrow"><span>KURIR</span> {{ $paket }} </div>
                    </div>
                    <div class="arrow">
                        <div class="inner-arrow"><span>CLIENT</span> {{ Auth::user()->name }}</div>
                    </div>
                    <div class="arrow">
                        <div class="inner-arrow"><span>ADDRESS</span> {{ $alamat }}</div>
                    </div>
                    <div class="arrow">
                        <div class="inner-arrow"><span>EMAIL</span> {{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div id="company">
                    <div class="arrow back">
                        <div class="inner-arrow">{{ $provinsi }} <span>PROVINSI</span></div>
                    </div>
                    <div class="arrow back">
                        <div class="inner-arrow">{{ $kota }} <span>KOTA</span></div>
                    </div>
                    <div class="arrow back">
                        <div class="inner-arrow">{{ Auth::user()->phone_number }} <span>PHONE</span></div>
                    </div>
                    <div class="arrow back">
                        <div class="inner-arrow">{{ $status }} <span>STATUS</span></div>
                    </div>
                </div>
            </div>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            </div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>