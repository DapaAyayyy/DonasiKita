@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - DonasiKita')

@section('content')
<section class="pt-[120px] pb-xl bg-background">
    <div class="max-w-4xl mx-auto px-gutter">
        <div class="text-center mb-lg">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container rounded-full mb-md">
                <span class="material-symbols-outlined text-primary">gavel</span>
                <span class="font-label-md text-label-md text-primary">Syarat & Ketentuan</span>
            </div>

            <h1 class="font-display-lg text-display-lg text-on-surface mb-md">
                Syarat & Ketentuan DonasiKita
            </h1>

            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto">
                Aturan penggunaan aplikasi DonasiKita, termasuk akun, donasi, pembayaran,
                komentar, dan tanggung jawab pengguna.
            </p>
        </div>

        <article class="bg-surface-container-lowest rounded-2xl shadow-soft-2 p-lg md:p-xl space-y-lg">
            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">1. Penerimaan Syarat</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Dengan mendaftar, masuk, menggunakan aplikasi, atau melakukan donasi melalui DonasiKita,
                    pengguna dianggap telah membaca, memahami, dan menyetujui Syarat & Ketentuan ini.
                    Jika pengguna tidak menyetujui ketentuan ini, pengguna disarankan untuk tidak menggunakan layanan DonasiKita.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">2. Definisi</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">Dalam Syarat & Ketentuan ini:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li><strong>DonasiKita</strong> adalah platform digital untuk membantu pengelolaan kampanye sosial dan donasi.</li>
                    <li><strong>Donatur</strong> adalah pengguna yang memberikan donasi melalui aplikasi.</li>
                    <li><strong>Pengelola</strong> adalah pihak yang mengelola data kampanye, penerima, donasi, dan laporan.</li>
                    <li><strong>Kampanye</strong> adalah program sosial yang dapat menerima donasi.</li>
                    <li><strong>Donasi</strong> adalah dana yang diberikan donatur kepada kampanye yang dipilih.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">3. Akun Pengguna</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Pengguna wajib memberikan data yang benar saat melakukan registrasi. Pengguna bertanggung jawab
                    menjaga keamanan email dan password masing-masing. Segala aktivitas yang terjadi melalui akun
                    pengguna menjadi tanggung jawab pemilik akun. DonasiKita dapat membatasi atau menonaktifkan akun
                    jika ditemukan penyalahgunaan, data palsu, atau aktivitas yang merugikan sistem.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">4. Ketentuan Donasi</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">Ketentuan donasi di DonasiKita:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Donasi hanya dapat dilakukan oleh donatur yang sudah login.</li>
                    <li>Minimal nominal donasi mengikuti aturan sistem, yaitu <strong>Rp10.000</strong>.</li>
                    <li>Donasi dapat memiliki status <code class="px-1 py-0.5 rounded bg-surface-container">pending</code>, <code class="px-1 py-0.5 rounded bg-surface-container">berhasil</code>, atau <code class="px-1 py-0.5 rounded bg-surface-container">gagal</code>.</li>
                    <li>Donasi dianggap berhasil setelah pembayaran dikonfirmasi oleh sistem pembayaran.</li>
                    <li>Donatur bertanggung jawab memastikan kampanye dan nominal donasi sudah benar sebelum menyelesaikan pembayaran.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">5. Pembayaran</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Pembayaran donasi dilakukan melalui Midtrans sebagai penyedia layanan pembayaran. Kegagalan transaksi
                    dapat terjadi karena kendala dari bank, e-wallet, jaringan, atau payment gateway. DonasiKita akan
                    mencatat status transaksi berdasarkan notifikasi resmi dari Midtrans. DonasiKita tidak bertanggung
                    jawab atas gangguan teknis dari pihak penyedia pembayaran, tetapi akan berupaya menampilkan status
                    donasi sesuai data transaksi yang diterima.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">6. Penggunaan Dana</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Dana donasi ditujukan untuk kampanye yang dipilih oleh donatur. Informasi kampanye, penerima, dan
                    laporan dikelola oleh pengelola. Data donasi dapat digunakan untuk kebutuhan transparansi, rekap,
                    laporan, dan pemantauan perkembangan kampanye.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">7. Komentar dan Feedback</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">
                    Donatur dapat memberikan komentar atau feedback pada donasi. Komentar tidak boleh mengandung:
                </p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Ujaran kebencian.</li>
                    <li>SARA.</li>
                    <li>Pornografi.</li>
                    <li>Spam.</li>
                    <li>Informasi palsu.</li>
                    <li>Ancaman atau pelecehan.</li>
                    <li>Konten lain yang melanggar hukum atau norma.</li>
                </ul>
                <p class="font-body-md text-body-md text-on-surface-variant mt-sm">
                    Pengelola berhak menyembunyikan, menghapus, atau menindaklanjuti komentar yang dianggap melanggar ketentuan.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">8. Batasan Tanggung Jawab</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    DonasiKita berperan sebagai platform pengelolaan donasi dan kampanye sosial. Pengguna wajib membaca
                    detail kampanye sebelum berdonasi. Kesalahan input nominal, kesalahan memilih kampanye, atau kelalaian
                    pengguna menjadi tanggung jawab pengguna, kecuali terbukti disebabkan oleh kesalahan sistem.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">9. Perubahan Layanan dan Ketentuan</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    DonasiKita dapat memperbarui fitur, tampilan, aturan, atau Syarat & Ketentuan sesuai kebutuhan
                    pengembangan aplikasi. Perubahan berlaku setelah ditampilkan pada halaman ini.
                </p>
            </section>

            <section class="bg-surface-container rounded-2xl p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">10. Kontak</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Jika pengguna memiliki pertanyaan terkait Syarat & Ketentuan, pengguna dapat menghubungi DonasiKita
                    melalui halaman
                    <a href="/hubungi-kami" class="text-primary font-semibold hover:underline">Hubungi Kami</a>.
                </p>
            </section>
        </article>
    </div>
</section>
@endsection
