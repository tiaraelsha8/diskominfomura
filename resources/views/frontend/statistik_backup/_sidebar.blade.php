
<div class="card">
    <div class="card-header bg-white">
        <a class="d-flex justify-content-between align-items-center text-decoration-none text-dark" data-toggle="collapse" href="#menuPenduduk" role="button">
            <span class="font-weight-bold"><i class="fas fa-chart-pie mr-2"></i>Statistik Penduduk</span>
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <div class="collapse show" id="menuPenduduk">
        <div class="list-group list-group-flush">
            <a href="{{ route('statistik.rentang-umur') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('statistik.rentang-umur') ? 'active' : '' }}">
                Rentang Umur
            </a>
            <a href="{{ route('statistik.jenis-kelamin') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('statistik.jenis-kelamin') ? 'active' : '' }}">
                Jenis Kelamin
            </a>
            <a href="{{ route('statistik.agama') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('statistik.agama') ? 'active' : '' }}">
                Agama
            </a>
        </div>
    </div>
</div>