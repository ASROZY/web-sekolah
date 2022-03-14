@extends('templates.user.index')
@section('content')    
<section id="about-video" class="about-video">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 video-box align-self-baseline" data-aos="fade-right" data-aos-delay="100">
                 <img src="{{ asset('images/sejarah.jpg') }}" class="d-block w-100" style="max-height: 500px" 
                 alt="...">
            </div>

             <div class="col-lg-6 pt-3 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                <h3>SEJARAH BERDIRINYA SMP</h3>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore
                    magna aliqua.
                </p>
                <ul>
                    <li><i class="bx bx-check-double"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.</li>
                    <li><i class="bx bx-check-double"></i> Duis aute irure dolor in reprehenderit in voluptate
                        velit.</li>
                    <li><i class="bx bx-check-double"></i> Voluptate repellendus pariatur reprehenderit
                        corporis
                        sint.</li>
                    <li><i class="bx bx-check-double"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda
                        mastiro dolore eu fugiat nulla pariatur.</li>
                </ul>
                <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                    reprehenderit in voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>
        </div>
    </div> 
</section><!-- End About Video Section -->
@endsection