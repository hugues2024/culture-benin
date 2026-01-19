<nav class="app-header navbar navbar-expand fixed-top" id="mainHeader">

    <div class="container-fluid px-4">



        <div class="navbar-brand d-flex align-items-center">

            <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center">

                <span class="fs-4 fw-normal text-dark  ms-1" style="font-weight: bold !important">Bénin</span>

                <span class="fs-4 fw-bold text-secondary  ms-1">Compte</span>

            </a>

        </div>



        <div class="ms-auto me-3 d-none d-lg-block">

            </div>



        <ul class="navbar-nav align-items-center">

            <li class="nav-item me-2 d-none d-sm-block">

                <a class="nav-link text-secondary p-2 rounded-circle hover-bg" href="#"><i class="bi bi-question-circle fs-5"></i></a>

            </li>

            <li class="nav-item me-3 d-none d-sm-block">

                <a class="nav-link text-secondary p-2 rounded-circle hover-bg" href="#"><i class="bi bi-grid-3x3-gap fs-5"></i></a>

            </li>



            <li class="nav-item dropdown user-menu">

                <a href="#" class="nav-link p-0" data-bs-toggle="dropdown" aria-expanded="false">

                    @if (Auth::user()->photo)

                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" 

                             class="rounded-circle border" alt="Profil"

                             style="width: 40px; height: 40px; object-fit: cover;">

                    @else

                        @php

                            $initials = strtoupper(substr(Auth::user()->nom, 0, 1));

                            $colors = ['#1a73e8', '#d93025', '#f9ab00', '#188038'];

                            $bgColor = $colors[crc32(Auth::user()->nom) % count($colors)];

                        @endphp

                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"

                             style="width: 40px; height: 40px; background-color: {{ $bgColor }}; font-size: 1.2rem;">

                            {{ $initials }}

                        </div>

                    @endif

                </a>

                

                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 mt-2" 

                     style="width: 320px; border-radius: 24px;" 

                     onclick="event.stopPropagation()">

                    

                    <div class="text-center py-3">

                        <p class="small text-muted mb-2">{{ auth()->user()->email }}</p>

                        @if (Auth::user()->photo)

                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">

                        @else

                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white display-6"

                                 style="width: 80px; height: 80px; background-color: {{ $bgColor }};">

                                {{ $initials }}

                            </div>

                        @endif

                        <h5 class="mb-0">Bonjour, {{ Auth::user()->nom }} !</h5>

                        <p class="text-muted small">{{ auth()->user()->role->nom ?? 'Administrateur' }}</p>

                        

                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 my-3 small fw-bold">

                            Gérer votre compte Culture-Bénin

                        </a>

                    </div>



                    <div class="border-top pt-3 mt-2 d-flex justify-content-center">

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button type="submit" class="btn btn-light border rounded px-4 py-2 d-flex align-items-center small shadow-sm">

                                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion

                            </button>

                        </form>

                    </div>

                </div>

            </li>

        </ul>

    </div>

</nav>   

<style>   
/* Suppression des bordures de la header */
#mainHeader {
    border-bottom: none !important; /* Enlève la ligne de séparation */
}
/* Fixation et Scroll */

body {

    padding-top: 64px; /* Hauteur du header */

    background-color: #f8f9fa;

}



#mainHeader {

    height: 64px;

    transition: background-color 0.3s ease, box-shadow 0.3s ease;

    z-index: 1050;

}



/* Effet au scroll : Devient légèrement plus gris */

#mainHeader.scrolled {

    background-color: #f1f3f4 !important;

    box-shadow: 0 1px 2px 0 rgba(60,64,67,.3), 0 2px 6px 2px rgba(60,64,67,.15) !important;

}



/* Styles Google UI */

.hover-bg:hover {

    background-color: rgba(60, 64, 67, 0.08);

}



.dropdown-menu {

    background-color: #fff;

}



/* On prépare le conteneur principal pour la Sidebar et le Body */

.main-wrapper {

    display: flex;

    min-height: calc(100vh - 64px);

}

</style> 

<script>

window.onscroll = function() {

    var header = document.getElementById("mainHeader");

    if (window.pageYOffset > 20) {

        header.classList.add("scrolled");

    } else {

        header.classList.remove("scrolled");

    }

};

</script>
