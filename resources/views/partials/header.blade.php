@vite('resources/css/app.css', 'resources/js/app.js', 'resources/js/maps.js')
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<body>
    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <!-- Logo di Kiri -->
                <div class="flex lg:flex-1">
                    <a href="{{ url('/') }}" class="-m-1.5 p-1.5">
                        <span class="text-4xl font-semibold text-green-500">TruckGo.</span>
                    </a>
                </div>
                <!-- Navigasi di Tengah -->
                <div class="absolute left-1/2 transform -translate-x-1/2 hidden lg:flex lg:gap-x-12 font-sans">
                    <a href="{{ url('/') }}" class="text-2xl  text-black">Beranda</a>
                    <a href="{{ url('/tentang') }}" class="text-2xl  text-black">Tentang Kami</a>
                    <a href="{{ url('/layanan') }}" class="text-2xl  text-black">Layanan</a>
                </div>
                <!-- Ruang Kosong untuk Justify Between -->
                <div class="lg:flex-1"></div>
            </nav>
        </header>
    </div>
</body>
