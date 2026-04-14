@extends('layouts.main')

@section('konten')
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - E-Library</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Optional: custom config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f3b5c',
                        secondary: '#2c7da0',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-700 font-sans">

    <!-- Container -->
    <div class="max-w-6xl mx-auto px-5 py-10 md:py-16">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-3">📖 Tentang E-Library</h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto">Perpustakaan digital masa kini — gratis, cepat, dan tanpa batas.</p>
        </div>

        <!-- Misi -->
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 mb-12 text-center border-b-4 border-secondary">
            <h2 class="text-2xl font-semibold text-secondary mb-3">🎯 Misi Kami</h2>
            <p class="text-slate-600 max-w-3xl mx-auto">Membuka akses seluas-luasnya terhadap ilmu pengetahuan dan cerita. Kami percaya bahwa membaca adalah hak semua orang, bukan hanya yang tinggal dekat perpustakaan fisik.</p>
        </div>

        <!-- Fitur Unggulan -->
        <h2 class="text-2xl md:text-3xl font-bold text-center text-primary mb-8">✨ Kenapa Pilih Kami?</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow p-6 text-center hover:-translate-y-1 transition">
                <div class="text-4xl mb-3">📚</div>
                <h3 class="text-xl font-semibold text-primary">10.000+ Buku</h3>
                <p class="text-slate-500 text-sm">Dari novel bestseller hingga jurnal akademik.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center hover:-translate-y-1 transition">
                <div class="text-4xl mb-3">🔍</div>
                <h3 class="text-xl font-semibold text-primary">Pencarian Pintar</h3>
                <p class="text-slate-500 text-sm">Temukan buku dalam hitungan detik.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center hover:-translate-y-1 transition">
                <div class="text-4xl mb-3">📱</div>
                <h3 class="text-xl font-semibold text-primary">Akses Multi-Platform</h3>
                <p class="text-slate-500 text-sm">Baca di HP, tablet, atau laptop.</p>
            </div>
        </div>

        <!-- Statistik -->
        <div class="bg-primary text-white rounded-2xl p-6 md:p-8 mb-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold">12.500+</div>
                    <p class="text-slate-200 text-sm">Buku Digital</p>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold">8.200+</div>
                    <p class="text-slate-200 text-sm">Pengguna Aktif</p>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold">450+</div>
                    <p class="text-slate-200 text-sm">Penulis Terdaftar</p>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold">32</div>
                    <p class="text-slate-200 text-sm">Mitra Institusi</p>
                </div>
            </div>
        </div>

        <!-- Tim Kami -->
        <div class="mb-12 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-8">👥 Tim Kami</h2>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-white rounded-full px-6 py-2 shadow-sm">Fardhan Ahmad Haidar - UI/UX Designer</div>
                <div class="bg-white rounded-full px-6 py-2 shadow-sm">Fardhan Ahmad Haidar - Backend Dev</div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-slate-100 rounded-2xl p-6 md:p-8 text-center">
            <h3 class="text-xl font-semibold text-primary mb-2">📬 Ada Pertanyaan atau Kolaborasi?</h3>
            <p class="text-slate-500 mb-4">Hubungi kami atau follow media sosial kami.</p>
            <a href="#" class="inline-block bg-secondary hover:bg-primary text-white font-medium px-6 py-2 rounded-full transition">Hubungi Kami</a>
        </div>

        <!-- Footer -->
        <footer class="text-center text-slate-400 text-sm mt-12">
            &copy; 2025 E-Library. Semua konten dilindungi.
        </footer>

    </div>

</body>
</html>
@endsection