<!DOCTYPE html>
<html>
<head>
    @include('partials.header')
    @vite(['resources/js/components/maps.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="flex flex-col min-h-screen">
    <!-- Background Gambar -->
    {{-- <div class="bg-scroll"
        style="background-image: url('{{ asset('storage/img/bg-layanan.jpg') }}'); height: 800px; background-size: cover;">
    </div> --}}



{{-- Pembatasan --}}
<div class="relative bg-scroll"
        style="background-image: url('{{ asset('storage/img/bg-layanan.jpg') }}'); height: 800px; background-size: cover;">
        
        <!-- Tulisan Solusi Logistik -->
        <div class="absolute inset-0 flex left-10 top-36">
            <h1 class="text-white text-4xl font-bold text-left tracking-wide ">
                "Solusi Logistik dan <br> Pergudangan Terintegrasi, <br>
                Aman, Efisien, untuk <br>Bisnis Anda!"
            </h1>
        </div>

        <!-- Kontainer Layanan -->
        <div class="absolute bottom-0 left-0 right-0 top-96 flex flex-col items-center justify-between">
            <div class="container mx-auto px-4 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                    <!-- Sistem Pemantauan -->
                    <div class="flex flex-col items-center text-center py-6 px-4">
                        <img src="{{ asset('storage/img/gambar3.png') }}" alt="Pergudangan" class="w-96">
                    </div>
                    
                    <!-- Pemeliharaan -->
                    <div class="flex flex-col items-center text-center py-6 px-4">
                        <img src="{{ asset('storage/img/gambar2.png') }}" alt="Pergudangan" class="w-96">
                    </div>
                    
                    <!-- Pergudangan -->
                    <div class="flex flex-col items-center text-center py-6 px-4 ">
                        <img src="{{ asset('storage/img/gambar1.png') }}" alt="Pergudangan" class="w-96">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Pembatasan --}}
    <div class="flex-grow py-8 mt-36">
        <!-- Seksi Temukan Armada -->
        <div class="bg-white pt-8">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-4xl font-bold mb-6 text-gray-800">TEMUKAN ARMADA TERDEKAT</h2>
                
                <!-- Tambahan Kolom Pencarian -->
                <div class="w-full max-w-4xl mb-6">
                    <div class="flex space-x-4">
                        <input type="text" id="searchInput" 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                               placeholder="Search TruckGo. by TruckID, Goods, or Destination...">
                        <select id="searchCriteria" 
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="all">All</option>
                            <option value="truck_id">Truck ID</option>
                            <option value="goods">Goods</option>
                            <option value="destination">Destination</option>
                        </select>
                        <button id="searchButton" 
                                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">
                            Find
                        </button>
                    </div>
                </div>

                <!-- Hasil Pencarian -->
                <div id="searchResults" class="w-full max-w-4xl mb-6 hidden">
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="font-bold mb-3">Hasil Pencarian</h3>
                        <div id="resultsList" class="space-y-2">
                            <!-- Hasil pencarian akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>

                <div id="map"
                    class="w-full max-w-4xl h-[400px] rounded-lg shadow-lg overflow-hidden border border-gray-300">
                </div>
                
                <div id="coordinates" class="mt-4 text-white">
                    <p>Latitude: <span id="latitude">-</span></p>
                    <p>Longitude: <span id="longitude">-</span></p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Menyimpan semua marker dalam objek
        let markers = {};
        let map, userMarker;

        // Inisialisasi peta
        map = L.map('map').setView([-6.95642, 110.45919], 13);

        // Tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Fungsi pencarian
        function searchTrucks() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const searchCriteria = document.getElementById('searchCriteria').value;
            const resultsList = document.getElementById('resultsList');
            
            // Reset hasil pencarian
            resultsList.innerHTML = '';
            document.getElementById('searchResults').classList.remove('hidden');

            // Reset semua marker ke warna default
            Object.values(markers).forEach(marker => {
                marker.setIcon(L.icon({
                    iconUrl: 'https://unpkg.com/leaflet/dist/images/marker-icon.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                }));
            });

            // Mencari truck
            fetch('/api/trucks')
                .then(response => response.json())
                .then(trucks => {
                    const filteredTrucks = trucks.filter(truck => {
                        if (searchCriteria === 'truck_id') {
                            return truck.truck_id.toLowerCase().includes(searchQuery);
                        } else if (searchCriteria === 'goods') {
                            return truck.goods.toLowerCase().includes(searchQuery);
                        } else if (searchCriteria === 'destination') {
                            return truck.destination.toLowerCase().includes(searchQuery) ||
                                   truck.next_destination.toLowerCase().includes(searchQuery);
                        } else {
                            return truck.truck_id.toLowerCase().includes(searchQuery) ||
                                   truck.goods.toLowerCase().includes(searchQuery) ||
                                   truck.destination.toLowerCase().includes(searchQuery) ||
                                   truck.next_destination.toLowerCase().includes(searchQuery);
                        }
                    });

                    if (filteredTrucks.length === 0) {
                        resultsList.innerHTML = '<p class="text-gray-500">Tidak ada hasil ditemukan</p>';
                        return;
                    }

                    // Tampilkan hasil dan highlight marker
                    filteredTrucks.forEach(truck => {
                        // Tambah ke daftar hasil
                        const resultItem = document.createElement('div');
                        resultItem.className = 'p-3 hover:bg-gray-100 rounded cursor-pointer';
                        resultItem.innerHTML = `
                            <p class="font-bold">${truck.truck_id}</p>
                            <p class="text-sm text-gray-600">
                                ${truck.goods} - Menuju: ${truck.destination}
                            </p>
                        `;
                        
                        // Event click untuk zoom ke marker
                        resultItem.addEventListener('click', () => {
                            const marker = markers[truck.truck_id];
                            if (marker) {
                                map.setView(marker.getLatLng(), 15);
                                marker.openPopup();
                            }
                        });
                        
                        resultsList.appendChild(resultItem);

                        // Highlight marker yang sesuai
                        if (markers[truck.truck_id]) {
                            markers[truck.truck_id].setIcon(L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41]
                            }));
                        }
                    });

                    // Fit bounds jika ada hasil
                    if (filteredTrucks.length > 0) {
                        const bounds = L.latLngBounds(filteredTrucks.map(truck => [truck.lat, truck.long]));
                        map.fitBounds(bounds, { padding: [50, 50] });
                    }
                })
                .catch(error => console.error("Error searching trucks:", error));
        }

        // Event listener untuk tombol pencarian
        document.getElementById('searchButton').addEventListener('click', searchTrucks);
        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchTrucks();
        });

        // Fungsi update lokasi yang sudah ada
        function updateLocation(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            document.getElementById('latitude').textContent = lat.toFixed(6);
            document.getElementById('longitude').textContent = lng.toFixed(6);

            if (userMarker) {
                userMarker.setLatLng([lat, lng]);
            } else {
                userMarker = L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup("Lokasi Anda")
                    .openPopup();
            }

            map.setView([lat, lng]);

            fetch('/api/update-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ latitude: lat, longitude: lng })
            })
            .then(response => response.json())
            .catch(error => console.error('Error:', error));
        }

        function handleError(error) {
            console.error('Error getting location:', error);
        }

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(updateLocation, handleError, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }

        // Load trucks dari database
        fetch('/api/trucks')
            .then(response => response.json())
            .then(trucks => {
                trucks.forEach(truck => {
                    const marker = L.marker([truck.lat, truck.long])
                        .addTo(map)
                        .bindPopup(`
                            <b>Truck ID:</b> ${truck.truck_id}<br>
                            <b>Goods:</b> ${truck.goods}<br>
                            <b>Destination:</b> ${truck.destination}<br>
                            <b>Next Destination:</b> ${truck.next_destination}
                        `);
                    markers[truck.truck_id] = marker;
                });
            })
            .catch(error => console.error("Error loading trucks:", error));
    </script>

    @push('scripts')
        <script type="module">
            import MapTracker from '../resources/js/components/maps.js';

            document.addEventListener('DOMContentLoaded', () => {
                const tracker = new MapTracker();
                tracker.init();
            });
        </script>
    @endpush
</body>
</html>