{{-- resources/views/frontend/statistik/partials/sidebar.blade.php --}}

<div class="stat-sidebar">
    <div class="stat-sidebar-heading">Kategori Data</div>

    <div class="stat-category is-open" data-category="kependudukan">
        <button type="button" class="stat-category-btn" onclick="statToggleCategory(this)">
            Kependudukan
            <svg class="stat-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
        <ul class="stat-subcategory-list">
            <li>
                <button type="button" class="stat-subcategory-btn is-active" data-target="rentang-umur" onclick="statShowTable(this)">
                    Rentang Umur
                </button>
            </li>
            <li>
                <button type="button" class="stat-subcategory-btn" data-target="penduduk" onclick="statShowTable(this)">
                    Penduduk
                </button>
            </li>
            <li>
                <button type="button" class="stat-subcategory-btn" data-target="agama" onclick="statShowTable(this)">
                    Agama
                </button>
            </li>
        </ul>
    </div>

    <div class="stat-category" data-category="pendidikan">
        <button type="button" class="stat-category-btn" onclick="statToggleCategory(this)">
            Pendidikan
            <svg class="stat-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
        <ul class="stat-subcategory-list">
            <li>
                <button type="button" class="stat-subcategory-btn" data-target="ijazah-tertinggi" onclick="statShowTable(this)">
                    Ijazah Tertinggi
                </button>
            </li>
        </ul>
    </div>

    <div class="stat-category" data-category="ketenagakerjaan">
        <button type="button" class="stat-category-btn" onclick="statToggleCategory(this)">
            Ketenagakerjaan
            <svg class="stat-chevron" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
        <ul class="stat-subcategory-list">
            <li>
                <button type="button" class="stat-subcategory-btn" data-target="pekerjaan" onclick="statShowTable(this)">
                    Pekerjaan
                </button>
            </li>
        </ul>
    </div>
</div>