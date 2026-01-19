@extends('layout')

@section('title')
    Détails de la langue
@endsection

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-xl-6">

            <div class="card google-card shadow-sm border-0">

                

                <div class="card-header bg-white py-4 border-bottom position-relative">

                    <div class="header-accent-line-yellow"></div>

                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">

                            <div class="icon-circle bg-warning-subtle text-warning me-3">

                                <i class="fa-solid fa-circle-info"></i>

                            </div>

                            <div>

                                <h4 class="card-title mb-0 fw-bold text-dark">Informations sur la langue</h4>

                            </div>

                        </div>

                        <a href="{{ route('langues.edit', $langue->id) }}" class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-bold">

                            <i class="fa-solid fa-pen me-1"></i> Modifier

                        </a>

                    </div>

                </div>



                <div class="card-body p-4 p-lg-5">

                    <div class="text-center mb-5">

                        <div class="display-1 fw-bold text-warning mb-2 opacity-50" style="letter-spacing: -2px;">

                            {{ strtoupper($langue->code_langue) }}

                        </div>

                        <h2 class="fw-bold text-dark mb-0">{{ $langue->nom_langue }}</h2>

                        <div class="badge bg-light text-muted border px-3 py-2 mt-2 rounded-pill">

                            Identifiant unique : #{{ $langue->id }}

                        </div>

                    </div>



                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="info-box p-3 rounded-4 bg-light border-0 h-100">

                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">

                                    <i class="fa-solid fa-hashtag me-2 text-warning"></i>Code ISO

                                </label>

                                <div class="fs-5 fw-bold text-dark">{{ $langue->code_langue }}</div>

                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="info-box p-3 rounded-4 bg-light border-0 h-100">

                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">

                                    <i class="fa-solid fa-calendar-day me-2 text-warning"></i>Ajoutée le

                                </label>

                                <div class="fs-5 fw-bold text-dark text-truncate">

                                    {{ $langue->created_at ? $langue->created_at->format('d/m/Y') : 'Non renseigné' }}

                                </div>

                            </div>

                        </div>



                        <div class="col-12">

                            <div class="info-box p-4 rounded-4 bg-light border-0">

                                <label class="text-muted small fw-bold text-uppercase mb-3 d-block">

                                    <i class="fa-solid fa-align-left me-2 text-warning"></i>Description détaillée

                                </label>

                                <p class="text-dark mb-0 lh-lg italic">

                                    @if($langue->description)

                                        {{ $langue->description }}

                                    @else

                                        <span class="text-muted">Aucune description n'a été fournie pour cette langue.</span>

                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="card-footer bg-white border-top p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <a href="{{ route('langues.index') }}" class="btn btn-light rounded-pill px-4 fw-bold text-secondary">

                            <i class="fa-solid fa-arrow-left me-2"></i>Retour à la liste

                        </a>

                        

                        <div class="small text-muted italic">

                            Dernière mise à jour : {{ $langue->updated_at ? $langue->updated_at->diffForHumans() : 'Jamais' }}

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </div>

</div>

@endsection



@push('styles')

<style>

    .google-card { border-radius: 20px; overflow: hidden; }

    .header-accent-line-yellow {

        position: absolute; top: 0; left: 0; right: 0; height: 5px; background: #F0C43B;

    }



    /* Icône d'en-tête */

    .icon-circle {

        width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 14px;

        font-size: 1.2rem;

    }

    .bg-warning-subtle { background-color: #fff9e6 !important; }



    /* Info Boxes */

    .info-box {

        transition: transform 0.2s ease, box-shadow 0.2s ease;

    }

    .info-box:hover {

        background-color: #fff !important;

        box-shadow: 0 10px 20px rgba(0,0,0,0.05);

        transform: translateY(-3px);

    }



    /* Typographie */

    .italic { font-style: italic; }

    

    /* Boutons */

    .btn-outline-warning {

        border-color: #F0C43B;

        color: #d4a007;

    }

    .btn-outline-warning:hover {

        background-color: #F0C43B;

        border-color: #F0C43B;

        color: white;

    }

    

    .btn-light {

        background-color: #f8f9fa;

        border: 1px solid #eee;

    }

    .btn-light:hover {

        background-color: #e9ecef;

    }

</style>
@endpush