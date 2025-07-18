 @php
     use App\Models\Kontak;
     $kontak = Kontak::first();
 @endphp
 <footer class="custom-footer">
     <div class="container py-4">
         <div class="footer-main">
             <!-- Kiri: Teks Kontak -->
             <div class="footer-left">
                 <p class="fw-bold mb-2">Alamat :</p>
                 <p class="mb-1">
                     {{ optional($kontak)->lokasi ?? 'Alamat Belum Tersedia' }}
                 </p>
                 <p class="mb-1">
                     Email:
                     @if (optional($kontak)->email)
                         <a href="mailto:{{ $kontak->email }}" class="footer-link">{{ $kontak->email }}</a>
                     @else
                         <span class="text-muted">Email Belum tersedia</span>
                     @endif
                 </p>
                 <p class="mb-0">
                     Telepon: {{ optional($kontak)->telepon ?? 'Telepon Belum tersedia' }}
                </p>
             </div>
             <!-- Kanan: Ikon Sosial Media -->
             <div class="footer-right">
                 <div class="social-icons">
                     <a href="#" class="icon-circle"><i class="bi bi-instagram"></i></a>
                     <a href="#" class="icon-circle facebook-icon">f</a>
                     <a href="#" class="icon-circle"><i class="bi bi-twitter"></i></a>
                     <a href="#" class="icon-circle"><i class="bi bi-tiktok"></i></a>
                     <a href="#" class="icon-circle"><i class="bi bi-youtube"></i></a>
                 </div>
             </div>
         </div>
         <!-- Divider & Copyright -->
         <hr class="footer-divider">
         <div class="footer-bottom text-center">
             &copy; Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Murung Raya
         </div>
     </div>
 </footer>
