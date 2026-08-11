{{-- resources/views/frontend/statistik/partials/cards.blade.php --}}

<div class="row stat-cards g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card stat-card--total">
           
            <div class="stat-card-icon">
                <i class="fa-solid fa-people-group" style="font-size: 1.3rem;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-label">Jumlah Penduduk</div>
                <div class="stat-card-value">{{ number_format($totalPenduduk, 0, ',', '.') }} <span>jiwa</span></div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card stat-card--laki">
            <div class="stat-card-icon">
              <i class="fa-solid fa-person" style="font-size: 1.3rem;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-label">Laki-laki</div>
                <div class="stat-card-value">{{ number_format($totalLakiLaki, 0, ',', '.') }} <span>jiwa</span></div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card stat-card--perempuan">
            <div class="stat-card-icon">
                    <i class="fa-solid fa-person-dress" style="font-size: 1.3rem;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-label">Perempuan</div>
                <div class="stat-card-value">{{ number_format($totalPerempuan, 0, ',', '.') }} <span>jiwa</span></div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card stat-card--kk">
            <div class="stat-card-icon">
                <i class="fa-solid fa-house-user" style="font-size: 1.3rem;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-label">Jumlah Keluarga</div>
                <div class="stat-card-value">{{ number_format($jumlahKk, 0, ',', '.') }} <span>KK</span></div>
            </div>
        </div>
    </div>
</div>