@extends('layouts.app')

@section('title', 'Kebijakan Privasi - DonasiKita')

@section('content')
<section class="pt-[120px] pb-xl bg-background">
    <div class="max-w-4xl mx-auto px-gutter">
        <div class="text-center mb-lg">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container rounded-full mb-md">
                <span class="material-symbols-outlined text-primary">privacy_tip</span>
                <span class="font-label-md text-label-md text-primary">Kebijakan Privasi</span>
            </div>

            <h1 class="font-display-lg text-display-lg text-on-surface mb-md">
                Kebijakan Privasi DonasiKita
            </h1>

            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto">
                Penjelasan tentang bagaimana DonasiKita mengumpulkan, menggunakan, menyimpan,
                menampilkan, dan melindungi data pengguna saat menggunakan aplikasi.
            </p>
        </div>

        <article class="bg-surface-container-lowest rounded-2xl shadow-soft-2 p-lg md:p-xl space-y-lg">
            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">1. Pendahuluan</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    DonasiKita menghargai privasi setiap pengguna. Kebijakan Privasi ini menjelaskan
                    bagaimana data donatur dan pengelola dikumpulkan, digunakan, disimpan, dan
                    dilindungi saat menggunakan aplikasi DonasiKita. Dengan menggunakan DonasiKita,
                    pengguna dianggap telah membaca dan memahami kebijakan ini.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">2. Data yang Dikumpulkan</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">DonasiKita dapat mengumpulkan data berikut:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Nama pengguna.</li>
                    <li>Alamat email.</li>
                    <li>Nomor handphone.</li>
                    <li>Alamat.</li>
                    <li>Password akun yang disimpan dalam bentuk terenkripsi atau hash.</li>
                    <li>Data donasi, seperti nominal donasi, kampanye tujuan, status pembayaran, dan tanggal donasi.</li>
                    <li>Komentar atau feedback donatur jika pengguna mengisinya.</li>
                    <li>Data transaksi pembayaran yang diperlukan untuk mencatat status donasi.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">3. Penggunaan Data</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">Data pengguna digunakan untuk:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Membuat dan mengelola akun donatur.</li>
                    <li>Memproses donasi ke kampanye yang dipilih.</li>
                    <li>Menampilkan riwayat donasi.</li>
                    <li>Menampilkan leaderboard berdasarkan donasi yang berhasil.</li>
                    <li>Membantu pengelola memantau kampanye, donasi, penerima, dan laporan.</li>
                    <li>Meningkatkan keamanan dan kenyamanan penggunaan aplikasi.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">4. Pembayaran</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Proses pembayaran donasi dilakukan melalui layanan pihak ketiga, yaitu Midtrans.
                    DonasiKita tidak menyimpan data sensitif pembayaran seperti nomor kartu, PIN,
                    CVV, atau informasi rekening pengguna secara langsung. Status pembayaran akan
                    diperbarui berdasarkan notifikasi atau callback dari Midtrans.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">5. Data yang Dapat Ditampilkan Publik</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">
                    Beberapa data dapat ditampilkan kepada publik dalam fitur aplikasi, seperti:
                </p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Nama donatur pada leaderboard.</li>
                    <li>Total donasi berhasil pada leaderboard.</li>
                    <li>Komentar donatur pada halaman kampanye, jika pengguna memberikan komentar.</li>
                </ul>
                <p class="font-body-md text-body-md text-on-surface-variant mt-sm">
                    DonasiKita tetap berupaya menampilkan data secara wajar dan sesuai kebutuhan fitur aplikasi.
                </p>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">6. Keamanan Data</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">DonasiKita berupaya menjaga keamanan data pengguna dengan cara:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Menyimpan password dalam bentuk hash, bukan teks asli.</li>
                    <li>Membatasi akses pengelola berdasarkan akun dan status pengguna.</li>
                    <li>Menggunakan validasi pada proses login, registrasi, donasi, dan pembaruan profil.</li>
                    <li>Menghindari penyimpanan data pembayaran sensitif secara langsung di sistem.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">7. Hak Pengguna</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-sm">Pengguna memiliki hak untuk:</p>
                <ul class="list-disc pl-6 space-y-xs font-body-md text-body-md text-on-surface-variant">
                    <li>Memperbarui data profil.</li>
                    <li>Mengganti password akun.</li>
                    <li>Menghubungi pengelola jika ingin memperbaiki data yang tidak sesuai.</li>
                    <li>Mengajukan pertanyaan terkait penggunaan data pribadi.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">8. Perubahan Kebijakan</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Kebijakan Privasi dapat diperbarui sewaktu-waktu sesuai kebutuhan pengembangan aplikasi.
                    Perubahan akan berlaku setelah versi terbaru ditampilkan pada halaman ini.
                </p>
            </section>

            <section class="bg-surface-container rounded-2xl p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">9. Kontak</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Jika pengguna memiliki pertanyaan terkait Kebijakan Privasi, pengguna dapat menghubungi
                    DonasiKita melalui halaman
                    <a href="/hubungi-kami" class="text-primary font-semibold hover:underline">Hubungi Kami</a>.
                </p>
            </section>
        </article>
    </div>
</section>
@endsection
