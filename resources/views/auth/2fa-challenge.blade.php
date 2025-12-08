@extends('layouts.app1')

@section('content')
<div class="min-vh-100 d-flex align-items-center py-5" style="background: #f5f5f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg" style="border: none; border-radius: 15px; overflow: hidden;">
                    <div class="card-header text-white text-center py-4" style="background: #F0C43B; border: none;">
                        <h4 class="mb-1 fw-bold">Code de Vérification</h4>
                        <p class="mb-0 small">Authentification à Deux Facteurs</p>
                    </div>

                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 rounded-circle" style="background: #e8f5e9;">
                                <span style="font-size: 3rem;">📱</span>
                            </div>
                        </div>

                        <p class="text-center text-muted mb-4">
                            Ouvrez votre application <strong style="color: #F0C43B;">Google Authenticator</strong> et entrez le code à 6 chiffres
                        </p>

                        <form method="POST" action="{{ route('2fa.verify.login') }}" id="challenge2faForm">
                            @csrf
                            <div class="mb-4">
                                <input type="text"
                                       name="code"
                                       id="code2faChallenge"
                                       class="form-control form-control-lg text-center"
                                       style="border: 3px solid #F0C43B; font-size: 32px; letter-spacing: 12px; font-weight: bold; color: #F0C43B; background: #e8f5e9;"
                                       placeholder="000000"
                                       maxlength="6"
                                       pattern="[0-9]{6}"
                                       required
                                       autofocus>
                                <small class="d-block text-center text-muted mt-2">
                                    Le code change toutes les 30 secondes
                                </small>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger text-center">
                                    <strong></strong> {{ $errors->first() }}
                                </div>
                            @endif

                            <button type="submit" class="btn btn-lg w-100 text-white fw-bold" style="background: #F0C43B; border: none;">
                                Vérifier le Code
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="text-muted small">
                                Annuler
                            </a>
                            <form id="logout-form" action="{{ url('/') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div class="card-footer text-center py-3" style="background: #f8f9fa; border: none;">
                        <small style="color: #F0C43B;">Culture Béninoise - Connexion Sécurisée</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('code2faChallenge').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');

        if(this.value.length === 6) {
            this.style.boxShadow = '0 0 0 0.2rem rgba(0, 135, 81, 0.25)';
        }
    });

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Code invalide',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#F0C43B'
        });
    @endif
</script>
@endpush
