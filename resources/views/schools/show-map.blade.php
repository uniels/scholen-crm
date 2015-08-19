{{-- OSM --}}
@section('heading')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
@stop
<div id="map" class="col-sm-8" style="height:450px"></div>
<script>
    var map = L.map('map');
    $.getJSON("http://nominatim.openstreetmap.org/search?limit=1&format=json&q={{ $school->number }}+{{ $school->street }},+{{ $school->place }}",function (data) {
        $.each( data, function( key, object ) {
            var marker = L.marker([object.lat, object.lon]).addTo(map);
            marker.bindPopup("<h4>{{ $school->name }}</h4>" +"<p>"+ object.display_name+"</p>");
            return map.setView([object.lat, object.lon], 16);
        });
    });
    L.tileLayer('http://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);  
</script>