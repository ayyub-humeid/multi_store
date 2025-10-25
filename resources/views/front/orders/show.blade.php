<x-front-layout title="Order Details">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Order # {{ $order->number }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="#">Orders</a></li>
                            <li>Order # {{ $order->number }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>



    <section class="checkout-wrapper section">
        <div class="container">
            <div id="map" style="height: 50vh;"></div>
        </div>
    </section>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    {{-- <script>
        var map, marker;

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9bbd1071bbb820b9aef1', {
            cluster: 'ap2'
            , channelAuthorization: {
                endpoint: "/broadcasting/auth"
                , headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}"
    }
    }
    });

    var channel = pusher.subscribe('private-deliveries.{{ $order->id }}');
    channel.bind('location-updated', function(data) {
    marker.setPosition({
    lat: Number(data.lat)
    , lng: Number(data.lng)
    });
    });

    </script> --}}
    {{-- <script>
        // Initialize and add the map
        function initMap() {
            // The location of Delivery
            const location = {
                lat: Number("{{ $delivery->lat }}")
    , lng: Number("{{ $delivery->lng }}")
    };
    // The map, centered at Uluru
    map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15
    , center: location
    , });
    // The marker, positioned at Uluru
    marker = new google.maps.Marker({
    position: location
    , map: map
    , });
    }

    window.initMap = initMap;

    </script> --}}
    <script>
        // Use your lat/lng from the controller
        const lat = Number("{{ $delivery->lat ?? 31.5015 }}");
        const lng = Number("{{ $delivery->lng ?? 34.4668 }}");


        // Initialize the map
        const map = L.map('map').setView([lat, lng], 15);

        // Load OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker
        const marker = L.marker([lat, lng]).addTo(map)
            .bindPopup('Delivery Location')
            .openPopup();

    </script>



    {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&callback=initMap&v=weekly" defer></script> --}}
</x-front-layout>
