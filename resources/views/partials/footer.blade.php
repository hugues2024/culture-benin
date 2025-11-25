<footer class="app-footer bg-white border-top py-3">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">
        <span class="text-muted">Plateforme Culturelle du Bénin</span>
    </div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <div class="text-muted">
        <strong>
            Copyright &copy; 2014-2025&nbsp;
            <a href="{{ route('home') }}" class="text-decoration-none text-primary">CultureBénin.io</a>.
        </strong>
        Tous droits réservés.
    </div>
    <!--end::Copyright-->
</footer>

<style>
.app-footer {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    backdrop-filter: blur(10px);
    font-size: 0.9rem;
}

.app-footer a {
    transition: all 0.3s ease;
    font-weight: 600;
}

.app-footer a:hover {
    color: #1976d2 !important;
    transform: translateY(-1px);
}
</style>