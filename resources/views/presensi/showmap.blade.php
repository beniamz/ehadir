<style>
  #map { height: 400px; }
</style>

<div id="map"></div>

<script>
// lokasi User
  var lokasi = "{{ $presensi->lokasi_in }}";
  var lok = lokasi.split(",");
  var latitude = lok[0];
  var longitude = lok[1];
  var map = L.map('map').setView([latitude, longitude], 17);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
  }).addTo(map);
  var marker = L.marker([latitude, longitude]).addTo(map);

  //lokasi kantor/MI
  var circle = L.circle([-6.382423909194619, 106.85282676924122], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 100,
            }).addTo(map);

  marker.bindPopup("<b>{{ $presensi->nama_lengkap }}</b>").openPopup();

</script>