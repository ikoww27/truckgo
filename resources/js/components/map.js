class MapTracker {
    constructor() {
        this.map = null;
        this.marker = null;
        this.watchId = null;
        this.markers = new Map(); // Untuk menyimpan semua marker truck
        this.trucks = []; // Untuk menyimpan data truck
    }

    init() {
        // Inisialisasi peta
        this.map = L.map("map").setView([-6.95642, 110.45919], 13);

        // Tambahkan tile layer
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
        }).addTo(this.map);

        this.startTracking();
        this.loadLocations();
    }

    startTracking() {
        if (navigator.geolocation) {
            this.watchId = navigator.geolocation.watchPosition(
                this.updateLocation.bind(this),
                this.handleError.bind(this),
                {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0,
                }
            );
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    updateLocation(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        // Update koordinat di tampilan
        document.getElementById("latitude").textContent = lat.toFixed(6);
        document.getElementById("longitude").textContent = lng.toFixed(6);

        // Update atau buat marker
        if (this.marker) {
            this.marker.setLatLng([lat, lng]);
        } else {
            this.marker = L.marker([lat, lng]).addTo(this.map);
        }

        // Center map
        this.map.setView([lat, lng]);

        // Kirim ke server
        this.sendLocationToServer(lat, lng);
    }

    sendLocationToServer(lat, lng) {
        fetch("/api/update-location", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({ latitude: lat, longitude: lng }),
        })
            .then((response) => response.json())
            .catch((error) => console.error("Error:", error));
    }

    // Tambahkan kode debug ini di maps.js
    loadLocations() {
        console.log("Memulai loadLocations..."); // tambahkan ini
        fetch("/api/trucks")
            .then((response) => {
                console.log("Response status:", response.status); // tambahkan ini
                return response.json();
            })
            .then((data) => {
                console.log("Data yang diterima:", data); // tambahkan ini
                this.trucks = data; // Simpan data trucks
                this.clearAllMarkers(); // Hapus marker yang ada
                data.forEach((truck) => {
                    console.log("Menambahkan marker untuk truck:", truck); // tambahkan ini
                    const popupContent = `
                    <b>Truck ID:</b> ${truck.truck_id}<br>
                    <b>Goods:</b> ${truck.goods}<br>
                    <b>Destination:</b> ${truck.destination}<br>
                    <b>Next Destination:</b> ${truck.next_destination}
                `;

                    L.marker([lat, long])
                        .addTo(this.map)
                        .bindPopup(popupContent);

                    // Simpan marker dengan truck_id sebagai key
                    this.markers.set(truck.truck_id, marker);
                });
            })
            .catch((error) => {
                console.error("Error detail:", error); // perbaiki pesan error
            });
    }

    handleError(error) {
        console.error("Error getting location:", error);
    }

    stopTracking() {
        if (this.watchId) {
            navigator.geolocation.clearWatch(this.watchId);
            this.watchId = null;
        }
    }

    // Mesin Pencarian
    clearAllMarkers() {
        this.markers.forEach((marker) => {
            this.map.removeLayer(marker);
        });
        this.markers.clear();
    }
    // Fungsi pencarian
    search(query, criteria = "all") {
        const searchQuery = query.toLowerCase();
        let results = [];

        switch (criteria) {
            case "truck_id":
                results = this.trucks.filter((truck) =>
                    truck.truck_id.toLowerCase().includes(searchQuery)
                );
                break;
            case "goods":
                results = this.trucks.filter((truck) =>
                    truck.goods.toLowerCase().includes(searchQuery)
                );
                break;
            case "destination":
                results = this.trucks.filter(
                    (truck) =>
                        truck.destination.toLowerCase().includes(searchQuery) ||
                        truck.next_destination
                            .toLowerCase()
                            .includes(searchQuery)
                );
                break;
            case "all":
            default:
                results = this.trucks.filter(
                    (truck) =>
                        truck.truck_id.toLowerCase().includes(searchQuery) ||
                        truck.goods.toLowerCase().includes(searchQuery) ||
                        truck.destination.toLowerCase().includes(searchQuery) ||
                        truck.next_destination
                            .toLowerCase()
                            .includes(searchQuery)
                );
                break;
        }

        this.highlightSearchResults(results);
        return results;
    }

    // Fungsi untuk menyoroti hasil pencarian
    highlightSearchResults(results) {
        // Reset semua marker ke style default
        this.markers.forEach((marker) => {
            marker.setIcon(
                L.icon({
                    iconUrl:
                        "https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png",
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                })
            );
        });

        // Highlight marker yang cocok dengan hasil pencarian
        results.forEach((truck) => {
            const marker = this.markers.get(truck.truck_id);
            if (marker) {
                // Gunakan icon berbeda untuk hasil pencarian
                marker.setIcon(
                    L.icon({
                        iconUrl:
                            "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                    })
                );

                // Zoom ke marker yang ditemukan
                if (results.length === 1) {
                    this.map.setView(marker.getLatLng(), 15);
                    marker.openPopup();
                }
            }
        });

        // Jika ada beberapa hasil, fit bounds ke semua hasil
        if (results.length > 1) {
            const bounds = L.latLngBounds(
                results.map((truck) => [truck.latitude, truck.longitude])
            );
            this.map.fitBounds(bounds, { padding: [50, 50] });
        }
    }
}

// Export class
export default MapTracker;
