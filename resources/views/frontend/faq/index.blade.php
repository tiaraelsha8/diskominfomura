@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            color-scheme: light;
            --bg: #f8f9fa;
            --surface: #fff;
            --ink: #343a40;
            --navy: #003366;
            --muted: #5f6e7c;
            --line: #dde6eb;
            --pale: #eaf7fc;
            --blue: #2fa8d3;
            --accent: #00779f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Inter, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.7;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        button,
        summary {
            font: inherit;
        }

        button,
        a,
        summary {
            -webkit-tap-highlight-color: transparent;
        }

        :focus-visible {
            outline: 3px solid #ed971e;
            outline-offset: 5px;
        }

        .wrap {
            max-width: 1180px;
            margin: auto;
            padding: 0 28px;
        }

        .header {
            background: rgba(47, 168, 211, 0.82);
            border-bottom: 1px solid #259cc5;
            box-shadow: 0 3px 16px #00336615;
        }

        .head-inner {
            min-height: 105px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            line-height: 1.4;
            font-size: 17px;
            font-weight: 700;
            color: #17384b;
        }

        .brand img {
            width: 49px;
            height: 64px;
            object-fit: contain;
        }

        .brand small {
            display: block;
            font-weight: 500;
            font-size: 14px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 25px;
            font-size: 14px;
            font-weight: 600;
            color: #123346;
        }

        .nav a[aria-current] {
            border-bottom: 2px solid #003366;
            padding-block: 9px;
        }

        .theme {
            border: 1px solid #ffffff80;
            border-radius: 24px;
            background: #ffffff55;
            padding: 7px 13px;
            color: inherit;
            cursor: pointer;
            font-size: 14px;
        }

        .crumb {
            display: flex;
            gap: 12px;
            color: var(--muted);
            font-size: 14px;
            padding-top: 31px;
        }

        .intro {
            padding: 28px 0 35px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 35px;
        }

        .eyebrow {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.13em;
            color: var(--accent);
            margin: 0 0 10px;
        }

        h1 {
            font-size: clamp(30px, 4vw, 44px);
            letter-spacing: -0.035em;
            line-height: 1.2;
            color: var(--navy);
            margin: 0 0 16px;
        }

        .intro p:last-child {
            margin: 0;
            color: var(--muted);
            max-width: 630px;
        }

        .layout {
            display: grid;
            grid-template-columns: 235px minmax(0, 1fr);
            gap: 55px;
            padding-bottom: 65px;
        }

        .aside h2 {
            font-size: 20px;
            color: var(--navy);
            margin: 0 0 12px;
            line-height: 1.4;
        }

        .aside p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .count {
            display: inline-block;
            margin-top: 21px;
            background: var(--pale);
            border: 1px solid var(--line);
            padding: 5px 13px;
            border-radius: 20px;
            color: var(--accent);
            font-size: 14px;
            font-weight: 600;
        }

        .faqs {
            display: grid;
            gap: 12px;
        }

        .faq {
            border: 1px solid var(--line);
            background: var(--surface);
            border-radius: 12px;
            overflow: hidden;
        }

        .faq[open] {
            border-color: #8dcce2;
            box-shadow: 0 4px 18px #00336606;
        }

        summary {
            display: flex;
            align-items: flex-start;
            gap: 17px;
            padding: 22px 24px;
            cursor: pointer;
            list-style: none;
            color: var(--navy);
            font-weight: 600;
            line-height: 1.6;
        }

        summary::-webkit-details-marker {
            display: none;
        }

        .number {
            color: var(--accent);
            font-size: 13px;
            font-weight: 600;
            line-height: 2;
            min-width: 23px;
        }

        .question {
            flex: 1;
        }

        .mark {
            width: 22px;
            flex-shrink: 0;
            font-size: 24px;
            line-height: 1.05;
            font-weight: 400;
            color: var(--accent);
        }

        .mark:before {
            content: "+";
        }

        details[open] .mark:before {
            content: "−";
        }

        details[open] summary {
            background: var(--pale);
        }

        .answer {
            padding: 19px 61px 25px;
            line-height: 1.85;
        }

        .answer p {
            margin: 0;
        }
    </style>
    <section class="pt-5 pb-5 mt-5">
        <div class="container">
            <nav class="crumb" aria-label="Breadcrumb">
                <a href="https://disdukcapil.murungrayakab.go.id/">Beranda</a><span aria-hidden="true">/</span><span
                    aria-current="page">FAQ</span>
            </nav>
            <section class="intro">
                <p class="eyebrow">INFORMASI PELAYANAN</p>
                <h1>Pertanyaan yang Sering Diajukan</h1>
                <p>
                    Temukan jawaban seputar pengurusan dokumen dan layanan administrasi
                    kependudukan.
                </p>
            </section>
            <div class="layout">
                <aside class="aside">
                    <div>
                        <h2>Layanan kependudukan</h2>
                        <p>
                            Pilih pertanyaan untuk melihat persyaratan dan prosedur
                            pengurusannya.
                        </p>
                    </div>
                    <span class="count">9 pertanyaan</span>
                </aside>
                <section class="faqs" aria-label="Daftar pertanyaan dan jawaban">
                    <details class="faq" id="faq-1" open>
                        <summary>
                            <span class="number" aria-hidden="true">01</span><span class="question">Apa saja syarat membuat
                                KTP-el baru untuk pemula (usia 17
                                tahun)?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Pemohon cukup membawa fotokopi Kartu Keluarga (KK) dan datang
                                langsung ke Kantor Disdukcapil untuk melakukan perekaman
                                biometrik.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-2">
                        <summary>
                            <span class="number" aria-hidden="true">02</span><span class="question">Bagaimana cara mengurus
                                KTP-el yang rusak atau hilang?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Untuk KTP-el hilang, bawa Surat Keterangan Hilang dari
                                Kepolisian dan fotokopi KK. Untuk KTP-el rusak, cukup bawa fisik
                                KTP-el yang rusak dan fotokopi KK ke loket pelayanan.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-3">
                        <summary>
                            <span class="number" aria-hidden="true">03</span><span class="question">Apa itu Identitas
                                Kependudukan Digital (IKD) dan bagaimana cara
                                daftarnya?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                IKD adalah KTP elektronik versi digital yang diakses melalui
                                aplikasi smartphone. Cara daftarnya: unduh aplikasi Identitas
                                Kependudukan Digital di Play Store/App Store, masukkan NIK,
                                email, nomor HP, lakukan verifikasi wajah (face recognition),
                                lalu datangi petugas Dukcapil untuk aktivasi kode QR.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-4">
                        <summary>
                            <span class="number" aria-hidden="true">04</span><span class="question">Bagaimana prosedur
                                menambah anggota keluarga baru (bayi) di
                                dalam KK?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Bawa KK asli orang tua, Surat Keterangan Kelahiran dari
                                bidan/rumah sakit, dan fotokopi Buku Nikah/Akta Perkawinan orang
                                tua. Petugas akan memproses KK baru sekaligus Akta Kelahiran
                                anak.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-5">
                        <summary>
                            <span class="number" aria-hidden="true">05</span><span class="question">Apa syarat membuat Kartu
                                Identitas Anak (KIA) di Murung
                                Raya?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Bawa fotokopi Akta Kelahiran anak, fotokopi KK orang tua, dan
                                foto anak ukuran 2x3 sebanyak 2 lembar (khusus untuk anak yang
                                telah berusia 5 hingga 17 tahun kurang 1 hari). Anak di bawah 5
                                tahun tidak memerlukan foto.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-6">
                        <summary>
                            <span class="number" aria-hidden="true">06</span><span class="question">Bagaimana cara mengurus
                                Akta Kematian anggota keluarga yang
                                meninggal?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Siapkan Surat Keterangan Kematian dari dokter/rumah sakit/kepala
                                desa/lurah, KK asli, dan KTP-el orang yang meninggal dunia untuk
                                dilaporkan ke loket pelayanan pencatatan sipil.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-7">
                        <summary>
                            <span class="number" aria-hidden="true">07</span><span class="question">Bagaimana alur mengurus
                                perpindahan domisili?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Laporkan kepindahan Anda ke Dinas Dukcapil asal untuk
                                mendapatkan Surat Keterangan Pindah Warga Negara Indonesia
                                (SKPWNI). Setelah surat terbit, bawa SKPWNI tersebut beserta KK
                                asli ke Dinas Dukcapil tujuan untuk diterbitkan KK dan KTP-el
                                dengan alamat baru.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-8">
                        <summary>
                            <span class="number" aria-hidden="true">08</span><span class="question">NIK saya tidak terbaca
                                saat mendaftar BPJS, Bantuan Sosial,
                                DAPODIK, kartu SIM, Perbankan dan lainnya. Apa yang harus
                                dilakukan?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Masalah ini terjadi karena data NIK belum terkonsolidasi di
                                server pusat, atau NIK terindikasi anomali sehingga masuk ke
                                dalam Data Restore. Anda dapat mengajukan
                                sinkronisasi/konsolidasi data melalui loket pengaduan/pelayanan
                                Disdukcapil.
                            </p>
                        </div>
                    </details>
                    <details class="faq" id="faq-9">
                        <summary>
                            <span class="number" aria-hidden="true">09</span><span class="question">Apakah untuk penerbitan
                                Akta Kelahiran Dewasa memerlukan
                                penetapan pengadilan?</span><span class="mark" aria-hidden="true"></span>
                        </summary>
                        <div class="answer">
                            <p>
                                Tidak. Dengan diberlakukannya UU No. 24 Tahun 2013 tentang
                                perubahan atas UU No. 23 Tahun 2006 tentang Administrasi
                                Kependudukan, maka dinyatakan bahwa penerbitan akta kelahiran
                                yang pelaporannya melebihi dari 1 tahun tidak lagi memerlukan
                                penetapan Pengadilan Negeri, tetapi cukup dengan Keputusan
                                Kepala Dinas Kependudukan dan Pencatatan Sipil.
                            </p>
                        </div>
                    </details>
                </section>
            </div>
        </div>
    </section>
@endsection