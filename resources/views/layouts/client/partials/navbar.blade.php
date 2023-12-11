<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-12 col-md-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-success font-weight-bold border px-3 mr-1">Z</span>Vespa
                    </h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/home" class="nav-item nav-link {{ Request::is('home') ? 'active' : '' }}">Home</a>
                        <a href="/about" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>
                        <a href="/visiMisi" class="nav-item nav-link {{ Request::is('visiMisi') ? 'active' : '' }}">Visi & Misi</a>
                        <a href="/popular" class="nav-item nav-link {{ Request::is('popular') ? 'active' : '' }}">Popular</a>
                        <a href="/eventsCompany" class="nav-item nav-link {{ Request::is('eventsCompany') ? 'active' : '' }}">Events</a>
                        <a href="/articelCompany" class="nav-item nav-link {{ Request::is('articelCompany') ? 'active' : '' }}">Articel</a>
                        <a href="/portofolioCompany" class="nav-item nav-link {{ Request::is('portofolioCompany') ? 'active' : '' }}">Portofolio</a>
                    </div>
                    @guest
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ route('login') }}"
                                class="nav-item nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a>
                            <a href="{{ route('register') }}"
                                class="nav-item nav-link {{ Request::is('register') ? 'active' : '' }}">Register</a>
                        </div>
                    @endguest

                    @auth
                        <div class="navbar-nav ml-auto" style="margin-right: 2rem;">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="text-dark">Selamat Datang,</span> {{ Auth::user()->name }}</a>
                                </a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @if(auth()->user()->roles_type == 1)
                                        @can('admin')
                                            <a href="/admin/manage_dashboard" class="dropdown-item">
                                                <i class="fas fa-fw fa-database"></i> Back to Dashboard
                                            </a>
                                        @endcan
                                    @endif

                                    @if(auth()->user()->roles_type == 2)
                                        @can('karyawan')
                                            <a href="/karyawan/manage_data" class="dropdown-item">
                                                <i class="fas fa-fw fa-file-archive"></i> Manage Data
                                            </a>
                                        @endcan
                                    @endif

                                    @if (auth()->user()->roles_type == 0)
                                        <a href="{{ route('edit.data', auth()->user()->email) }}" class="dropdown-item">
                                            <i class="fas fa-fw fa-edit"></i> Edit Profile
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('history.index') }}" class="dropdown-item">
                                           <i class="fas fa-fw fa-history"></i> History Orders
                                        </a>
                                    @endif
                                        
                                    <div class="dropdown-divider"></div>

                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn-logout">
                                            <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </nav>

            @if (Request::is('home'))
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($vespa->take(3) as $key => $item)
                            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}" style="height: 400px;">
                                @if ($item->thumbnail)
                                    <img class="img-fluid" src="{{ asset('storage/' . $item->thumbnail) }}" 
                                        alt="Image-vespa" />
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/customer/img/blank-vespa.png') }}"
                                        alt="Image-vespa" />
                                @endif
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 850px;">
                                        <h4 class="text-light text-capitalize font-weight-medium mb-3">
                                            Find out more about our special promo on accessories and ride for your dream Vespa now
                                        </h4>
                                        <h3 class="display-4 text-light font-weight-bolder mb-4">
                                           {{ $item->name_product }}
                                        </h3>
                                        <a href="#" class="btn btn-success rounded py-2 px-3 w-25">Order Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark rounded-circle" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark rounded-circle" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>