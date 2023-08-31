<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            @if (Request::is('home'))
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-success text-white w-100"
                    aria-expanded="true" href="#" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0 text-white">Categories</h6>
                    <i class="fa fa-angle-down text-white"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden">
                        @foreach ($categories as $item)
                            <a href="{{ $item->slug }}" class="nav-item nav-link">{{ $item->name_category }}</a>
                        @endforeach
                    </div>
                </nav>
            @endif
        </div>
        <div class="col-lg-9">
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
                        <a href="" class="nav-item nav-link">Home</a>
                        <a href="" class="nav-item nav-link">About</a>
                        <a href="" class="nav-item nav-link">Visi & Misi</a>
                        <a href="" class="nav-item nav-link">Popular</a>
                        <a href="" class="nav-item nav-link">Events</a>
                        <a href="" class="nav-item nav-link">Articel</a>
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
                                    <a href="" class="dropdown-item">Edit</a>
                                    <a href="" class="dropdown-item">History Orders</a>
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
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="{{ asset('assets/customer/img/blank-vespa.png') }}"
                                alt="Image-vespa" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        10% Off Your First Order
                                    </h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                        Fashionable Dress
                                    </h3>
                                    <a href="" class="btn btn-success rounded-pill py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>