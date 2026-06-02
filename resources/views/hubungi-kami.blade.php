@extends('layouts.app')

@section('title', 'Hubungi Kami - DonasiKita')

@section('content')
<section class="pt-[120px] pb-xl bg-background">
    <div class="max-w-container-max mx-auto px-gutter">

        {{-- Header --}}
        <div class="text-center mb-lg">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container rounded-full mb-md">
                <span class="material-symbols-outlined text-primary">support_agent</span>
                <span class="font-label-md text-label-md text-primary">Hubungi Kami</span>
            </div>

            <h1 class="font-display-lg text-display-lg text-on-surface mb-md">
                Ada yang Ingin Ditanyakan?
            </h1>

            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto">
                Tim DonasiKita siap membantu menjawab pertanyaan seputar kampanye,
                donasi, kerja sama, maupun kendala penggunaan platform.
            </p>
        </div>

        {{-- Main Contact Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter items-start mb-xl">

            {{-- Contact Info --}}
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-sm">
                    Informasi Kontak
                </h2>

                <p class="font-body-md text-body-md text-on-surface-variant mb-lg">
                    Silakan hubungi kami melalui kontak berikut. Untuk pertanyaan terkait
                    kampanye tertentu, sertakan nama kampanye agar kami dapat membantu lebih cepat.
                </p>

                <div class="space-y-md">
                    <div class="flex items-start gap-sm">
                        <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">mail</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-label-md text-on-surface mb-xs">
                                Email
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                support@donasikita.id
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-sm">
                        <div class="w-12 h-12 rounded-full bg-secondary-container/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-secondary">call</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-label-md text-on-surface mb-xs">
                                WhatsApp
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                +62 812-3456-7890
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-sm">
                        <div class="w-12 h-12 rounded-full bg-tertiary-container/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-tertiary">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-label-md text-on-surface mb-xs">
                                Alamat
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Jl. Kebaikan No. 7, Indonesia
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-sm">
                        <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">schedule</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-label-md text-on-surface mb-xs">
                                Jam Operasional
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Senin - Jumat, 09.00 - 17.00 WIB
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-lg bg-surface-container rounded-2xl p-md">
                    <div class="flex gap-sm items-start">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Untuk kendala donasi, mohon sertakan email akun, nama kampanye,
                            dan waktu transaksi agar proses pengecekan lebih mudah.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-2 p-lg">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-sm">
                    Kirim Pesan
                </h2>

                <p class="font-body-md text-body-md text-on-surface-variant mb-lg">
                    Isi formulir berikut dan kami akan membalas pesan Anda secepat mungkin.
                </p>

                <form action="#" method="POST" class="space-y-md">
                    @csrf

                    <div>
                        <label for="nama" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Nama Lengkap
                        </label>
                        <input
                            id="nama"
                            name="nama"
                            type="text"
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant/60 rounded-xl font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label for="email" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="nama@email.com"
                            class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant/60 rounded-xl font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label for="kategori" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Kategori Pesan
                        </label>
                        <select
                            id="kategori"
                            name="kategori"
                            class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant/60 rounded-xl font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                            <option value="">Pilih kategori pesan</option>
                            <option value="pertanyaan_umum">Pertanyaan Umum</option>
                            <option value="bantuan_donasi">Bantuan Donasi</option>
                            <option value="kampanye">Kampanye</option>
                            <option value="kerja_sama">Kerja Sama</option>
                            <option value="kendala_teknis">Kendala Teknis</option>
                        </select>
                    </div>

                    <div>
                        <label for="subjek" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Subjek
                        </label>
                        <input
                            id="subjek"
                            name="subjek"
                            type="text"
                            placeholder="Tulis subjek pesan"
                            class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant/60 rounded-xl font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label for="pesan" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Pesan
                        </label>
                        <textarea
                            id="pesan"
                            name="pesan"
                            rows="5"
                            placeholder="Tulis pesan atau pertanyaan Anda..."
                            class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant/60 rounded-xl font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                        ></textarea>
                    </div>

                    <button
                        type="button"
                        class="w-full flex justify-center items-center gap-xs px-md py-sm bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95"
                    >
                        <span class="material-symbols-outlined">send</span>
                        Kirim Pesan
                    </button>

                    <p class="font-caption text-caption text-on-surface-variant text-center">
                        Form ini masih tampilan UI. Fitur pengiriman pesan dapat diaktifkan pada tahap berikutnya.
                    </p>
                </form>
            </div>
        </div>

        {{-- FAQ --}}
        <div class="mb-xl">
            <div class="text-center mb-lg">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Beberapa informasi singkat yang mungkin membantu Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg">
                    <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center mb-sm">
                        <span class="material-symbols-outlined text-primary">volunteer_activism</span>
                    </div>
                    <h3 class="font-headline-md text-[20px] font-bold text-on-surface mb-xs">
                        Bagaimana cara berdonasi?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Pilih kampanye yang ingin didukung, login sebagai donatur,
                        lalu isi form donasi sesuai nominal dan metode pembayaran.
                    </p>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg">
                    <div class="w-12 h-12 rounded-full bg-secondary-container/10 flex items-center justify-center mb-sm">
                        <span class="material-symbols-outlined text-secondary">verified</span>
                    </div>
                    <h3 class="font-headline-md text-[20px] font-bold text-on-surface mb-xs">
                        Apakah donasi langsung tercatat?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Donasi akan masuk dengan status menunggu verifikasi sebelum
                        dicatat sebagai dana terkumpul pada kampanye.
                    </p>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-lg">
                    <div class="w-12 h-12 rounded-full bg-tertiary-container/10 flex items-center justify-center mb-sm">
                        <span class="material-symbols-outlined text-tertiary">campaign</span>
                    </div>
                    <h3 class="font-headline-md text-[20px] font-bold text-on-surface mb-xs">
                        Bagaimana cara menghubungi pengelola?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Anda dapat mengirim pesan melalui form kontak atau email
                        support dengan menyertakan nama kampanye terkait.
                    </p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-hero-gradient rounded-2xl shadow-soft-2 p-lg md:p-xl text-center text-white overflow-hidden relative">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>

            <div class="relative z-10">
                <h2 class="font-headline-lg text-headline-lg mb-sm">
                    Siap Membantu Sesama?
                </h2>

                <p class="font-body-lg text-body-lg text-white/90 max-w-2xl mx-auto mb-md">
                    Temukan kampanye sosial yang ingin kamu dukung dan mulai berbagi kebaikan hari ini.
                </p>

                <a
                    href="/kampanye"
                    class="inline-flex items-center gap-xs px-lg py-sm bg-surface-container-lowest text-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:scale-105 transition-transform active:scale-95"
                >
                    <span class="material-symbols-outlined fill">favorite</span>
                    Lihat Kampanye
                </a>
            </div>
        </div>

    </div>
</section>
@endsection