<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <title>TruckGo.</title>
    @include('partials.header')
</head>

<body>
    <div>
        <div class="bg-scroll relative brightness-75"
            style="background-image: url('{{ asset('storage/img/bg-beranda.jpeg') }}');  height: 800px; background-size: cover;">
        </div>
        <div class="absolute top-1/2 mt-36 left-6 transform -translate-y-1/2">
            <h1 class="text-6xl font-bold text-white leading-normal tracking-wide">
                Teraman Tercepat <br> Terpercaya
            </h1>
            <p class="mt-8 text-xl text-gray-200 w-full font-light leading-relaxed">
                Perusahaan transportasi yang terpadu dengan tujuan melayani kebutuhan logistik <br>
                pelanggan kami dan menyediakan pelayanan terbaik untuk para pelanggan.
            </p>
        </div>
        <div class="bg-black py-24 text-center rounded-b-[125px] pb-10 ">
            <h1 class=" text-6xl font-extrabold text-white">ARMADA KAMI</h1>
        </div>

        <div class="pt-20 justify-center pb-10">
            <img src="{{ asset('storage/img/gambar.png') }}" alt="Gambar" class="w-full h-auto object-cover">
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4 container mx-auto ">
        <!-- Logo TruckGo -->
        <div class="mb-8">
            <h1 class="text-8xl font-bold text-green-500">TruckGo.</h1>
        </div>
        <div class="invisible"></div>
        <!-- Perusahaan & Lainnya -->
        <div class="grid grid-cols-2 gap-8">
            <div>
                <h2 class="font-bold text-2xl mb-4">PERUSAHAAN</h2>
                <ul class="text-gray-800 space-y-2 font-medium">
                    <li>Profil Perusahaan</li>
                    <li>CSR</li>
                    <li>Hubungi Kami</li>
                </ul>
                <h2 class="font-bold text-2xl mt-6 mb-4">SOLUSI BISNIS</h2>
                <ul class="text-gray-800 space-y-2 font-medium">
                    <li>Kemitraan</li>
                </ul>
            </div>
            <div class="pl-10 pr-10">
                <h2 class="font-bold text-2xl mb-4">LAINNYA</h2>
                <ul class="text-gray-800 space-y-2 font-medium">
                    <li>Lacak Pengiriman</li>
                    <li>Cek Tarif</li>
                    <li>Lokasi</li>
                    <li>Berita</li>
                    <li>Promo</li>
                    <li>FAQ</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2 gir container mx-auto">
        <div>
            <h2 class="font-bold text-2xl mb-4">KONTAK KAMI</h2>
            <ul class="text-gray-800 space-y-2 font-semibold">
                <li>
                    <span class="inline-block mr-2">📞</span> (024) 987652
                </li>
                <li>
                    <span class="inline-block mr-2">✉️</span> truckgo@gmail.com
                </li>
            </ul>
            <div class="flex space-x-4 mt-4">
                <!-- Social Media Icons -->
                <a href="#" class="text-gray-800 hover:text-black"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-800 hover:text-black"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="text-gray-800 hover:text-black"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-800 hover:text-black"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <div>
            <h2 class="font-bold text-2xl mb-4">LOKASI KAMI</h2>
            <p class="text-gray-800 leading-relaxed font-semibold">
                Jl. Kaligawe Raya No.Km.4, Terboyo Kulon, Kec. Genuk,<br>
                Kota Semarang, Jawa Tengah 50112
            </p>
        </div>
    </div>
</body>

<footer>
    @include('partials.footer')
</footer>
