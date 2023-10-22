@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Visi & Misi Perusahaan</span></h1>
            <div class="col-lg-10 col-md-10 mb-3">
                <p class="text-gray-900 text-justify">{!! $data_visi_misi->visi !!}</p>
                <p class="text-gray-900 text-justify">{!! $data_visi_misi->misi !!}</p>
            </div>
            <div class="col-lg-10 col-md-10 mb-5">
                <h3 class="section-title px-5 mb-3"><span class="px-2">Pencapaian Terbaru</span></h3>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="{{ asset('assets/customer/img/pencapaian1.jpg') }}" class="card-img-top" alt="pencapaian">
                            <div class="card-body">
                                <p class="card-text">
                                    DEALER MOTOPLEX ICONIC 4 BRANDS PT PIAGGIO INDONESIA KINI HADIR DI DAERAH ISTIMEWA YOGYAKARTA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="{{ asset('assets/customer/img/pencapaian2.jpg') }}" class="card-img-top" alt="pencapaian">
                            <div class="card-body">
                                <p class="card-text">
                                    PT PIAGGIO INDONESIA TERUS PERLUAS KEHADIRAN DEALER PREMIUM MOTOPLEX PIAGGIO VESPA DAN KALI INI DI JEMBER, JAWA TIMUR
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="{{ asset('assets/customer/img/pencapaian3.jpg') }}" class="card-img-top" alt="pencapaian">
                            <div class="card-body">
                                <p class="card-text">
                                    PENINGKATAN LEVEL PREMIUMISASI MOTOPLEX DIMULAI MELALUI PEMBUKAAN DILER BARU MOTOPLEX JAKARTA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="{{ asset('assets/customer/img/pencapaian4.jpg') }}" class="card-img-top" alt="pencapaian">
                            <div class="card-body">
                                <p class="card-text">
                                    PT PIAGGIO INDONESIA MERAYAKAN HARI JADINYA YANG KE 10 DI INDONESIA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 mb-3">
                <h3 class="section-title px-5 mb-3"><span class="px-2">Best Services</span></h3>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <img src="{{ asset('assets/customer/img/teknisi.png') }}" class="card-img-top" alt="best-services" width="50"/>
                            <div class="card-body">
                                <h4 class="card-title text-center">Teknisi Profesional</h4>
                                <p class="card-text text-center">
                                    Kendaraan Anda ditangani oleh teknisi berpengalaman dan professional yang telah melewati proses pelatihan dan
                                    sertifikasi sesuai dengan standar pelatihan resmi Piaggio Group.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <img src="{{ asset('assets/customer/img/spare-part.png') }}" class="card-img-top" alt="best-services" width="50"/>
                            <div class="card-body">
                                <h4 class="card-title text-center">Spare Parts Asli</h4>
                                <p class="card-text text-center">
                                    Jaminan suku cadang asli, harga yang sama diseluruh lokasi dan proteksi garansi suku cadang selama 
                                    <span class="text-danger font-weight-bolder">6 bulan*</span>. 
                                    Serta, dilengkapi juga dengan garansi servis 1 minggu setelah melakukan perawatan di bengkel resmi Motoplex.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 h-100">
                            <img src="{{ asset('assets/customer/img/garansi.png') }}" class="card-img-top" alt="best-services" width="50"/>
                            <div class="card-body">
                                <h4 class="card-title text-center">100% Garansi</h4>
                                <p class="card-text text-center">
                                    Jaminan garansi resmi yang meliputi:
                                    <ul>
                                        <li>Garansi kendaraan selama <br> <span class="text-danger font-weight-bolder">3 tahun**</span></li>
                                        <li>Garansi suku cadang asli selama <span class="text-danger font-weight-bolder">1 tahun**</span></li>
                                        <li>Garansi servis selama 1 minggu</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection