@extends('layouts.app')

@section('title', 'Pembayaran Donasi - DonasiKita')

@section('content')
@php
    $isProduction = filter_var(config('midtrans.is_production'), FILTER_VALIDATE_BOOLEAN);
    $snapScriptUrl = $isProduction
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp

<div class="max-w-container-max mx-auto px-gutter pt-[120px] pb-xl">
    <div class="flex items-center gap-xs mb-lg font-caption text-caption text-on-surface-variant">
        <a href="/" class="hover:text-primary transition-colors flex items-center gap-xs">
            <span class="material-symbols-outlined text-[16px]">home</span> Beranda
        </a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="/kampanye" class="hover:text-primary transition-colors">Kampanye</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface font-semibold">Pembayaran Donasi</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-lg items-start">
        <div class="lg:col-span-3">
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 overflow-hidden">
                <div class="bg-hero-gradient px-md py-lg text-on-primary">
                    <div class="w-14 h-14 rounded-full bg-white/15 flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined fill text-[32px]">volunteer_activism</span>
                    </div>
                    <p class="font-caption text-caption uppercase tracking-wide text-on-primary/80 mb-xs">
                        Satu langkah lagi
                    </p>
                    <h1 class="font-headline-lg text-headline-lg leading-snug">
                        Selesaikan Pembayaran Donasimu
                    </h1>
                    <p class="font-body-md text-body-md text-on-primary/85 mt-sm max-w-[640px]">
                        Donasimu sudah tercatat dengan status pending. Klik tombol pembayaran untuk membuka Snap Midtrans dan memilih metode pembayaran.
                    </p>
                </div>

                <div class="p-md">
                    <div id="payment-status" class="hidden mb-md rounded-xl border px-sm py-sm font-body-md text-body-md"></div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-sm mb-md">
                        <div class="p-sm bg-surface-container rounded-xl">
                            <p class="font-caption text-caption text-on-surface-variant uppercase tracking-wide mb-xs">Order ID</p>
                            <p class="font-label-md text-label-md text-on-surface break-all">{{ $orderId }}</p>
                        </div>
                        <div class="p-sm bg-surface-container rounded-xl">
                            <p class="font-caption text-caption text-on-surface-variant uppercase tracking-wide mb-xs">Nominal</p>
                            <p class="font-headline-md text-headline-md text-primary">
                                Rp {{ number_format($nominal, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-sm bg-surface-container rounded-xl">
                            <p class="font-caption text-caption text-on-surface-variant uppercase tracking-wide mb-xs">Status</p>
                            <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full bg-secondary-container/10 text-secondary font-label-md text-label-md">
                                <span class="material-symbols-outlined text-[18px]">schedule</span>
                                Pending
                            </span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-outline-variant/40 bg-surface-container-low p-md mb-md">
                        <h2 class="font-headline-md text-headline-md text-on-surface mb-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-primary">payments</span>
                            Cara Pembayaran
                        </h2>
                        <div class="h-px w-full bg-outline-variant/30 mb-sm"></div>
                        <ol class="space-y-sm font-body-md text-body-md text-on-surface-variant">
                            <li class="flex gap-sm">
                                <span class="w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-md text-label-md flex-shrink-0">1</span>
                                Klik tombol <strong class="text-on-surface">Bayar Sekarang</strong>.
                            </li>
                            <li class="flex gap-sm">
                                <span class="w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-md text-label-md flex-shrink-0">2</span>
                                Pilih metode pembayaran yang tersedia di Snap Midtrans.
                            </li>
                            <li class="flex gap-sm">
                                <span class="w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-md text-label-md flex-shrink-0">3</span>
                                Selesaikan instruksi pembayaran sampai status transaksi diperbarui.
                            </li>
                        </ol>
                    </div>

                    <button
                        type="button"
                        id="pay-button"
                        class="w-full py-sm bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95 flex justify-center items-center gap-xs text-[16px]">
                        <span class="material-symbols-outlined fill">favorite</span>
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md sticky top-[100px]">
                <div class="flex items-center gap-sm mb-md p-sm bg-surface-container rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-tertiary-container/20 flex items-center justify-center text-tertiary font-bold flex-shrink-0">
                        <span class="material-symbols-outlined">verified_user</span>
                    </div>
                    <div>
                        <p class="font-caption text-caption text-on-surface-variant uppercase tracking-wide">Pembayaran Aman</p>
                        <p class="font-label-md text-label-md text-on-surface">Diproses oleh Midtrans</p>
                    </div>
                </div>

                <div class="h-px w-full bg-outline-variant/30 mb-md"></div>

                <div class="space-y-sm mb-md">
                    <div class="flex justify-between gap-sm">
                        <span class="font-body-md text-body-md text-on-surface-variant">Nominal donasi</span>
                        <span class="font-label-md text-label-md text-on-surface text-right">
                            Rp {{ number_format($nominal, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between gap-sm">
                        <span class="font-body-md text-body-md text-on-surface-variant">Biaya platform</span>
                        <span class="font-label-md text-label-md text-on-surface">Rp 0</span>
                    </div>
                </div>

                <div class="h-px w-full bg-outline-variant/30 mb-md"></div>

                <div class="flex justify-between items-end gap-sm mb-md">
                    <span class="font-label-md text-label-md text-on-surface">Total Bayar</span>
                    <span class="font-headline-md text-headline-md text-primary">
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </span>
                </div>

                <a href="/kampanye"
                   class="w-full py-sm border border-outline-variant text-on-surface-variant font-label-md text-label-md rounded-full hover:bg-surface-container transition-colors flex justify-center items-center gap-xs">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali ke Kampanye
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ $snapScriptUrl }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.getElementById('pay-button');
    const paymentStatus = document.getElementById('payment-status');
    const snapToken = @json($snapToken);
    const campaignListUrl = @json(url('/kampanye'));

    function showPaymentStatus(message, type = 'info') {
        const colorMap = {
            success: 'border-tertiary-container/30 bg-tertiary-container/10 text-tertiary',
            error: 'border-error-container bg-error-container/40 text-error',
            info: 'border-outline-variant/40 bg-surface-container text-on-surface-variant',
        };

        paymentStatus.className = `mb-md rounded-xl border px-sm py-sm font-body-md text-body-md ${colorMap[type] || colorMap.info}`;
        paymentStatus.textContent = message;
        paymentStatus.classList.remove('hidden');
    }

    function redirectToCampaignList(delay = 2500) {
        window.setTimeout(function () {
            window.location.href = campaignListUrl;
        }, delay);
    }

    payButton?.addEventListener('click', function () {
        if (!window.snap) {
            showPaymentStatus('Snap Midtrans belum berhasil dimuat. Cek koneksi internet atau konfigurasi client key.', 'error');
            return;
        }

        window.snap.pay(snapToken, {
            onSuccess: function () {
                showPaymentStatus('Pembayaran berhasil. Terima kasih sudah berdonasi! Status akan diperbarui setelah notifikasi Midtrans diproses. Kamu akan diarahkan kembali ke halaman kampanye.', 'success');
                redirectToCampaignList();
            },
            onPending: function () {
                showPaymentStatus('Transaksi masih pending. Silakan selesaikan instruksi pembayaran dari Midtrans. Status akan diperbarui setelah notifikasi Midtrans diproses.', 'info');
            },
            onError: function () {
                showPaymentStatus('Pembayaran gagal diproses. Silakan coba kembali.', 'error');
            },
            onClose: function () {
                showPaymentStatus('Popup pembayaran ditutup sebelum transaksi selesai.', 'info');
            },
        });
    });
</script>
@endsection
