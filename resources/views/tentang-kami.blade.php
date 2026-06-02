@extends('layouts.app')

@section('title', 'Tentang Kami - DonasiKita')

@section('content')
<section class="pt-[120px] pb-xl bg-background">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="text-center mb-lg">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container rounded-full mb-md">
                <span class="material-symbols-outlined text-primary">favorite</span>
                <span class="font-label-md text-label-md text-primary">Tentang Kami</span>
            </div>

            <h1 class="font-display-lg text-display-lg text-on-surface mb-md">
                Menghubungkan Kebaikan dengan Mereka yang Membutuhkan
            </h1>

            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto">
                DonasiKita adalah platform donasi digital yang membantu masyarakat
                menyalurkan bantuan kepada kampanye sosial secara lebih mudah,
                transparan, dan terpercaya.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-xl">
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-primary-container/10 flex items-center justify-center mb-sm">
                    <span class="material-symbols-outlined text-primary text-[32px]">volunteer_activism</span>
                </div>
                <h3 class="font-headline-md text-on-surface mb-xs">Mudah</h3>
                <p class="font-body-md text-on-surface-variant">
                    Pengguna dapat melihat kampanye, membaca detail kebutuhan, dan mulai berdonasi dengan alur yang sederhana.
                </p>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-secondary-container/10 flex items-center justify-center mb-sm">
                    <span class="material-symbols-outlined text-secondary text-[32px]">visibility</span>
                </div>
                <h3 class="font-headline-md text-on-surface mb-xs">Transparan</h3>
                <p class="font-body-md text-on-surface-variant">
                    Informasi kampanye, target dana, dan dana terkumpul ditampilkan dengan jelas agar donatur merasa yakin.
                </p>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-tertiary-container/10 flex items-center justify-center mb-sm">
                    <span class="material-symbols-outlined text-tertiary text-[32px]">groups</span>
                </div>
                <h3 class="font-headline-md text-on-surface mb-xs">Berdampak</h3>
                <p class="font-body-md text-on-surface-variant">
                    Setiap donasi diharapkan dapat membantu penerima manfaat dan menciptakan perubahan positif.
                </p>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl shadow-soft-2 p-lg md:p-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-lg items-center">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-sm">
                        Apa itu DonasiKita?
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-md">
                        DonasiKita adalah aplikasi web penggalangan dana sosial yang dibuat
                        untuk mempertemukan donatur dengan kampanye yang membutuhkan bantuan.
                        Melalui platform ini, pengguna dapat melihat daftar kampanye,
                        memahami detail kebutuhan, dan memberikan dukungan secara lebih terarah.
                    </p>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Platform ini dikembangkan sebagai proyek Rekayasa Perangkat Lunak
                        dengan fokus pada kemudahan penggunaan, transparansi informasi, dan
                        alur donasi yang jelas.
                    </p>
                </div>

                <div class="bg-hero-gradient rounded-2xl p-lg text-white">
                    <h3 class="font-headline-md mb-sm">Misi Kami</h3>
                    <p class="font-body-md text-white/90 mb-md">
                        Menyediakan wadah digital yang memudahkan masyarakat untuk saling membantu
                        melalui kampanye sosial yang terpercaya.
                    </p>
                    <a href="/kampanye" class="inline-flex items-center gap-xs px-md py-sm bg-white text-primary rounded-full font-label-md hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined fill">favorite</span>
                        Lihat Kampanye
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection