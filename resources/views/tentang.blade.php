@include ('partials.header')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<body>
    <div class="relative h-[400px] flex items-center justify-center"
        style="background-image: url('{{ asset('storage/img/bg-tentangakami.jpeg') }}'); height: 800px; background-size: cover;">
        <h1 class="text-center font-extrabold text-green-600 text-8xl relative justify-center text-shadow-white">Siapa Kami ?</h1>
    </div>
    <div class="flex flex-wrap lg:flex-nowrap bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Kolom Visi dan Misi -->
        <div class="w-full lg:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h2>
            <ul class="list-decimal pl-6 text-gray-600 space-y-2">
                <li>Mengatasi masalah logistik pelanggan kami.</li>
                <li>Mempertahankan posisi kami sebagai pemimpin pasar di industri transportasi.</li>
                <li>Menjadi perusahaan dengan reputasi baik dan terkenal.</li>
                <li>Memperkaya pengalaman kami di dunia transportasi.</li>
                <li>Menjadi perusahaan publik.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Visi Kami</h2>
            <p class="text-gray-600">
                Perusahaan transportasi yang terpadu dengan tujuan melayani kebutuhan logistik pelanggan kami
                dan menyediakan pelayanan terbaik untuk para pelanggan.
            </p>
        </div>
        <!-- Kolom Peta -->
        <div class="w-full lg:w-1/2 p-4">
            <div id="map" class="w-full h-96 rounded-lg shadow-md"></div>
        </div>
    </div>
</div>

<!-- Script Leaflet -->
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-6.987532, 110.431724], 13); // Koordinat awal
    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker
    L.marker([-6.987532, 110.431724]).addTo(map)
        .bindPopup("<b>Kantor TruckGo.</b><br>Semarang, Indonesia.")
        .openPopup();
</script>
</body>
<footer>
    @include ('partials.footer')
</footer>
