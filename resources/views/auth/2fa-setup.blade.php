@extends('layouts.app1')

@section('content')
<style>
    :root {
        --benin-primary: #008751;
        --benin-primary-dark: #006b3f;
        --benin-light: #e8f5e9;
        --benin-gradient: linear-gradient(135deg, #008751 0%, #00a862 100%);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    .setup-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        padding: 2rem 1rem;
    }

    .setup-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Header */
    .page-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .page-logo {
        width: 56px;
        height: 56px;
        background: var(--benin-gradient);
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0, 135, 81, 0.2);
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .page-subtitle {
        font-size: 1rem;
        color: #64748b;
        line-height: 1.5;
    }

    /* Main Card */
    .setup-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    /* Two Column Layout */
    .two-column-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }

    /* Left Column - QR Section */
    .qr-column {
        background: var(--benin-gradient);
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .qr-column::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('data:image/svg+xml,<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.08)"/></svg>');
        background-size: 40px 40px;
    }

    .qr-content {
        position: relative;
        z-index: 1;
    }

    .qr-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .qr-title {
        font-size: 1.625rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .qr-description {
        font-size: 0.9375rem;
        opacity: 0.92;
        margin-bottom: 2rem;
        line-height: 1.7;
        max-width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .qr-code-wrapper {
        background: white;
        padding: 1.5rem;
        border-radius: 20px;
        display: inline-block;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        margin-bottom: 1.75rem;
        transition: transform 0.3s ease;
    }

    .qr-code-wrapper:hover {
        transform: scale(1.02);
    }

    .qr-code-wrapper img {
        display: block;
        width: 220px;
        height: 220px;
        border-radius: 8px;
    }

    .manual-entry {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 12px;
        padding: 1.25rem;
        backdrop-filter: blur(10px);
    }

    .manual-label {
        font-size: 0.8125rem;
        opacity: 0.9;
        margin-bottom: 0.875rem;
        display: block;
    }

    .secret-display {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        padding: 0.875rem;
    }

    .secret-code {
        flex: 1;
        font-family: 'Courier New', monospace;
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--benin-primary);
        letter-spacing: 1.5px;
        word-break: break-all;
    }

    .copy-btn {
        flex-shrink: 0;
        background: var(--benin-light);
        border: 1px solid rgba(0, 135, 81, 0.3);
        color: var(--benin-primary);
        padding: 0.5rem 0.875rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .copy-btn:hover {
        background: var(--benin-primary);
        color: white;
        border-color: var(--benin-primary);
    }

    .copy-btn.copied {
        background: var(--benin-primary);
        border-color: var(--benin-primary);
        color: white;
    }

    /* Right Column - Form Section */
    .form-column {
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header {
        margin-bottom: 2rem;
    }

    .form-step {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        background: var(--benin-light);
        color: var(--benin-primary);
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .form-subtitle {
        font-size: 0.9375rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* Info Alert */
    .info-alert {
        display: flex;
        gap: 0.875rem;
        padding: 1rem 1.125rem;
        background: var(--benin-light);
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .info-alert-icon {
        flex-shrink: 0;
        font-size: 1.25rem;
    }

    .info-alert-content {
        flex: 1;
    }

    .info-alert-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--benin-primary-dark);
        margin-bottom: 0.25rem;
    }

    .info-alert-text {
        font-size: 0.8125rem;
        color: var(--benin-primary-dark);
        line-height: 1.5;
    }

    /* Form */
    .verify-form {
        margin-bottom: 1.5rem;
    }

    .alert-error {
        padding: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        color: #991b1b;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.625rem;
    }

    .code-input {
        width: 100%;
        height: 64px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 0.75rem;
        color: var(--benin-primary);
        background: #f8fafc;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding-left: 1rem;
        font-family: 'Courier New', monospace;
    }

    .code-input::placeholder {
        color: #cbd5e1;
        opacity: 0.6;
    }

    .code-input:hover {
        border-color: #94a3b8;
    }

    .code-input:focus {
        outline: none;
        border-color: var(--benin-primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 135, 81, 0.1);
        transform: scale(1.01);
    }

    .code-input.valid {
        border-color: var(--benin-primary);
        background: var(--benin-light);
    }

    .input-hint {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        margin-top: 0.75rem;
        font-size: 0.8125rem;
        color: #64748b;
    }

    .submit-btn {
        width: 100%;
        padding: 1rem 1.5rem;
        background: var(--benin-gradient);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0, 135, 81, 0.25);
        position: relative;
        overflow: hidden;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 135, 81, 0.35);
    }

    .submit-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(0, 135, 81, 0.25);
    }

    .submit-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Apps List */
    .apps-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .apps-title {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .apps {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .app-badge {
        padding: 0.5rem 0.875rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #64748b;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: default;
    }

    .app-badge:hover {
        border-color: var(--benin-primary);
        color: var(--benin-primary);
        background: var(--benin-light);
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0, 135, 81, 0.15);
    }

    /* Footer */
    .page-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        font-size: 0.875rem;
        color: #64748b;
    }

    .page-footer strong {
        color: var(--benin-primary);
    }

    /* Responsive */
    @media (max-width: 968px) {
        .two-column-layout {
            grid-template-columns: 1fr;
        }

        .qr-column {
            padding: 2.5rem 2rem;
        }

        .form-column {
            padding: 2.5rem 2rem;
        }

        .qr-code-wrapper img {
            width: 200px;
            height: 200px;
        }
    }

    @media (max-width: 640px) {
        .setup-page {
            padding: 1.5rem 1rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .qr-column,
        .form-column {
            padding: 2rem 1.5rem;
        }

        .qr-code-wrapper {
            padding: 1.5rem;
        }

        .qr-code-wrapper img {
            width: 180px;
            height: 180px;
        }

        .code-input {
            font-size: 1.75rem;
            height: 58px;
            letter-spacing: 0.5rem;
        }

        .form-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="setup-page">
    <div class="setup-container">
        
        <!-- Header -->
        <div class="page-header">
            <div class="page-logo">🔐</div>
            <h1 class="page-title">Authentification à Deux Facteurs</h1>
            <p class="page-subtitle">Sécurisez votre compte avec une protection supplémentaire</p>
        </div>

        <!-- Main Card - Two Columns -->
        <div class="setup-card">
            <div class="two-column-layout">
                
                <!-- Left Column - QR Code -->
                <div class="qr-column">
                    <div class="qr-content">
                        <div class="qr-badge">🔒 Configuration sécurisée</div>
                        <h2 class="qr-title">Scannez le code QR</h2>
                        <p class="qr-description">
                            Utilisez votre application d'authentification pour scanner ce code. Une fois configuré, vous recevrez des codes de sécurité temporaires pour protéger votre compte.
                        </p>
                        
                        <div class="qr-code-wrapper">
                            @if(isset($qrCodeImage))
                                {!! $qrCodeImage !!}
                            @else
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode($qrCodeUrl) }}&bgcolor=ffffff" 
                                     alt="QR Code 2FA"
                                     onerror="this.src='https://chart.googleapis.com/chart?chs=220x220&cht=qr&chl={{ urlencode($qrCodeUrl) }}';">
                            @endif
                        </div>

                        <div class="manual-entry">
                            <label class="manual-label">Saisie manuelle du code secret :</label>
                            <div class="secret-display">
                                <code class="secret-code" id="secretCode">{{ $secret }}</code>
                                <button type="button" class="copy-btn" onclick="copySecret()">Copier</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Verification Form -->
                <div class="form-column">
                    <div class="form-header">
                        <div class="form-step">Configuration finale</div>
                        <h3 class="form-title">Vérification du code</h3>
                        <p class="form-subtitle">
                            Entrez le code à 6 chiffres généré par votre application d'authentification
                        </p>
                    </div>

                    <!-- Info Alert -->
                    <div class="info-alert">
                        <span class="info-alert-icon">💡</span>
                        <div class="info-alert-content">
                            <div class="info-alert-title">Protection maximale</div>
                            <div class="info-alert-text">
                                La 2FA empêche l'accès non autorisé même si votre mot de passe est compromis.
                            </div>
                        </div>
                    </div>

                    <!-- Verify Form -->
                    <div class="verify-form">
                        <form method="POST" action="{{ route('2fa.verify') }}" id="verifyForm">
                            @csrf

                            @if($errors->any())
                                <div class="alert-error">
                                    <span>⚠️</span>
                                    <span>{{ $errors->first() }}</span>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="code">Code de vérification</label>
                                <input type="text" 
                                       name="code" 
                                       id="code"
                                       class="code-input"
                                       placeholder="000000" 
                                       maxlength="6" 
                                       pattern="[0-9]{6}"
                                       inputmode="numeric"
                                       required 
                                       autofocus>
                                <div class="input-hint">
                                    <span>⏱</span>
                                    <span>Le code change toutes les 30 secondes</span>
                                </div>
                            </div>

                            <button type="submit" class="submit-btn">
                                Activer l'authentification 2FA
                            </button>
                        </form>
                    </div>

                    <!-- Apps Section -->
                    <div class="apps-section">
                        <div class="apps-title">Applications recommandées</div>
                        <div class="apps">
                            <span class="app-badge">📱 Google Authenticator</span>
                            <span class="app-badge">🔷 Microsoft Authenticator</span>
                            <span class="app-badge">🔐 Authy</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="page-footer">
            🇧🇯 <strong>Culture Béninoise</strong> · Plateforme sécurisée
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    const codeInput = document.getElementById('code');
    const form = document.getElementById('verifyForm');

    function copySecret() {
        const secret = document.getElementById('secretCode').textContent;
        const btn = event.target;
        
        navigator.clipboard.writeText(secret).then(() => {
            btn.textContent = '✓ Copié';
            btn.classList.add('copied');
            
            setTimeout(() => {
                btn.textContent = 'Copier';
                btn.classList.remove('copied');
            }, 2000);
        }).catch(() => {
            const textArea = document.createElement('textarea');
            textArea.value = secret;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            
            btn.textContent = '✓ Copié';
            btn.classList.add('copied');
            
            setTimeout(() => {
                btn.textContent = 'Copier';
                btn.classList.remove('copied');
            }, 2000);
        });
    }

    codeInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        
        if (this.value.length === 6) {
            this.classList.add('valid');
        } else {
            this.classList.remove('valid');
        }
    });

    form.addEventListener('submit', function(e) {
        if (codeInput.value.length !== 6) {
            e.preventDefault();
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Code incomplet',
                    text: 'Veuillez saisir les 6 chiffres du code de vérification',
                    confirmButtonColor: '#008751'
                });
            } else {
                alert('Veuillez saisir les 6 chiffres du code de vérification');
            }
            
            codeInput.focus();
        }
    });

    @if($errors->any())
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Code invalide',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#008751'
            });
        }
        
        setTimeout(() => {
            codeInput.focus();
            codeInput.select();
        }, 500);
    @endif

    window.addEventListener('load', function() {
        setTimeout(() => {
            codeInput.focus();
        }, 300);
    });
</script>
@endpush