<header id="header" class="fixed-top p-3">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo ml-0">
            <div class="row">
                <div class="col-2">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.jpg') }}" class="bi me-2" alt="">
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ url('/') }}">
                        SMP Terpadu Darur Roja 
                    </a>
                </div>
            </div>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="onepage/assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ url('/') }}">Home</a></li>
                {{-- <li><a class="nav-link scrollto" href="#about">Profil</a></li>  --}}
                <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                     <ul>
                        <li><a href="{{ url('/visi-misi') }}">Visi dan Misi</a></li>
                        <li><a href="{{ url('/sejarah') }}">Sejarah Berdirinya SMP</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/') }}#team">Struktur Organisasi </a></li>
                <li><a class="nav-link scrollto" href="{{ url('/') }}#services">Kurikulum</a></li>
                <li><a class="nav-link scrollto" href="https://fliphtml5.com/bookcase/sdxlx">Perpustakaan</a></li>
               {{-- <li><a class="nav-link scrollto" href="{{ url('/') }}#pricing">Pricing</a></li> --}}
                <li><a class="nav-link scrollto" href="{{ url('/') }}#contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="{{ url('/') }}#testimonials">Team</a></li>
                {{-- <li><a class="getstarted scrollto" href="{{ url('/') }}#about">Get Started</a></li> --}}
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>