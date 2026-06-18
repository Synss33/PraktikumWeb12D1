<?php 
require 'vendor/autoload.php';
use Money\Money;
use Money\Currency;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XChange - Solusi Pembayaran E-Commerce Global</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Google Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 md:p-12 relative overflow-x-hidden">

    <!-- ELEMEN BACKGROUND IKLAN (Abstrak & Modern) -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- CONTAINER UTAMA (Grid Layout untuk Teks Iklan + Kalkulator) -->
    <div class="w-full max-w-5xl grid md:grid-cols-12 gap-8 items-center relative z-10">
        
        <!-- SISI KIRI: TEKS PROMOSI / IKLAN PRODUK -->
        <div class="md:col-span-6 space-y-6 text-white text-center md:text-left p-4">
            <div class="inline-flex items-center space-x-2 bg-indigo-500/10 border border-indigo-500/30 px-3 py-1.5 rounded-full text-xs font-semibold tracking-wide text-indigo-300 uppercase">
                <span>⚡ Rate Terbaik Hari Ini</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight bg-gradient-to-r from-white via-slate-200 to-indigo-200 bg-clip-text text-transparent">
                Belanja Global, <br class="hidden md:inline">Bayar Pakai Rupiah.
            </h1>
            
            <p class="text-slate-400 text-base md:text-lg max-w-md">
                Solusi konversi mata uang instan untuk platform e-commerce Anda. Checkout produk dari seluruh dunia tanpa khawatir biaya silang yang tersembunyi.
            </p>

            <!-- Keunggulan Layanan (Fitur Iklan) -->
            <div class="grid grid-cols-2 gap-4 pt-4 text-left">
                <div class="flex items-start space-x-2.5">
                    <div class="p-1 bg-emerald-500/20 rounded-lg text-emerald-400 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-200">Kurs Transparan</h4>
                        <p class="text-xs text-slate-400">Tanpa biaya tambahan</p>
                    </div>
                </div>
                <div class="flex items-start space-x-2.5">
                    <div class="p-1 bg-indigo-500/20 rounded-lg text-indigo-400 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-200">Proses Kilat</h4>
                        <p class="text-xs text-slate-400">Konversi < 1 detik</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: KARTU APLIKASI / KONVERTER -->
        <div class="md:col-span-6 w-full max-w-md mx-auto">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl shadow-indigo-950/50 border border-white/20 overflow-hidden">
                
                <!-- Header Kartu -->
                <div class="bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-8 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                    <div class="flex items-center space-x-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="text-xs font-semibold tracking-widest uppercase text-indigo-200">XChange Checkout</span>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">Kalkulator Kurs</h2>
                </div>

                <!-- Form Konten -->
                <div class="p-6 space-y-6">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">Jumlah Belanja Anda (USD)</label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-medium text-sm">$</span>
                                </div>
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    step="0.01" 
                                    min="0" 
                                    placeholder="0.00"
                                    required 
                                    class="block w-full pl-8 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-700 font-medium transition-all text-lg"
                                >
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">USD</span>
                                </div>
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-150 flex items-center justify-center space-x-2 text-base"
                        >
                            <span>Hitung Total IDR</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>

                    <!-- Bagian Logika PHP & Output Hasil -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $jumlahUSD = (float) $_POST['jumlah'];
                        $jumlahCent = (string) round($jumlahUSD * 100);
                        
                        $uangUSD = new Money($jumlahCent, new Currency('USD'));
                        $kurs = 15000; 
                        $jumlahIDR = ((int) $uangUSD->getAmount() / 100) * $kurs;
                        ?>
                        
                        <hr class="border-slate-100">

                        <div class="bg-emerald-50 rounded-2xl p-4 border border-emerald-100 text-center">
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Total Pembayaran Anda</p>
                            
                            <div class="flex items-center justify-center space-x-2 text-slate-400 text-xs mb-1">
                                <span>USD <?= number_format($jumlahUSD, 2) ?></span>
                                <span>•</span>
                                <span>Kurs Rp <?= number_format($kurs, 0, ',', '.') ?></span>
                            </div>

                            <div class="text-2xl font-bold text-emerald-600 tracking-tight">
                                Rp <?= number_format($jumlahIDR, 0, ',', '.') ?>
                            </div>
                            <span class="text-[10px] text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full font-medium mt-2 inline-block">Bebas Biaya Tambahan</span>
                        </div>
                    <?php } ?>
                </div>

                <!-- Footer Mini -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        Terinkripsi & Aman
                    </span>
                    <span>Powered by MoneyPHP</span>
                </div>

            </div>
        </div>

    </div>

</body>
</html>