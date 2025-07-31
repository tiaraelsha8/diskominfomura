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
                     {{-- Instagram --}}
                     @if (!empty($kontak?->link_ig))
                         <a href="{{ $kontak->link_ig }}" class="icon-circle instagram-icon" target="_blank">
                             <i class="bi bi-instagram"></i>
                         </a>
                     @endif

                     {{-- Facebook --}}
                     @if (!empty($kontak?->link_fb))
                         <a href="{{ $kontak->link_fb }}" class="icon-circle facebook-icon" target="_blank">
                             <i class="bi bi-facebook"></i>
                         </a>
                     @endif

                     {{-- Twitter --}}
                     @if (!empty($kontak?->link_twitter))
                         <a href="{{ $kontak->link_twitter }}" class="icon-circle twitter-icon" target="_blank">
                             <i class="bi bi-twitter"></i>
                         </a>
                     @endif

                     {{-- TikTok --}}
                     @if (!empty($kontak?->link_tiktok))
                         <a href="{{ $kontak->link_tiktok }}" class="icon-circle tiktok-icon" target="_blank">
                             <i class="bi bi-tiktok"></i>
                         </a>
                     @endif

                     {{-- YouTube --}}
                     @if (!empty($kontak?->link_youtube))
                         <a href="{{ $kontak->link_youtube }}" class="icon-circle youtube-icon" target="_blank">
                             <i class="bi bi-youtube"></i>
                         </a>
                     @endif
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
