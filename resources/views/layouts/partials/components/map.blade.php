@push('css2')
    <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('leaflet/leaflet.js') }}"></script>
@endpush

<div id="map" style="width: 400px; height: 400px; border: 1px solid #AAA;"></div>   

@push('scripts2')
      <script type="text/javascript">

          var point = ['25.43707396776717', '-100.99594116210938'];
          var map = L.map('map').setView(point, 8);

          L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
              maxZoom: 18
          }).addTo( map );

          var myURL = '';
          var myIcon = L.icon({
              iconUrl: myURL + 'images/pin24.png',
              iconRetinaUrl: myURL + 'images/pin48.png',
              iconSize: [29, 24],
              iconAnchor: [9, 21],
              popupAnchor: [0, -14]
          });          

          if ( $("[name=latitud]").val() > 0 ) {
              //alert("porque" + $("[name=latitud]").val());
              var position = [ $("[name=latitud]").val() , $("[name=longitud]").val() ];
              map.setView(position,14);

              maker = L.marker( position, {draggable: true})
                          .bindPopup("Coordenadas: " + position[0] + "," + position[1] )
                          .addTo(map);

              maker.on('drag', function(e) {
                    var position = this.getLatLng()
                    //console.log('marker drag event');
                    this.bindPopup("Coordenadas: " + position.lat + "," + position.lng );
                    $("[name=latitud]").val(position.lat);
                    $("[name=longitud]").val(position.lng);
                  })                
                  .addTo(map);

              maker.on('mouseover', function (e) {
                this.openPopup();
              });

              maker.on('mouseout', function (e) {
                  this.closePopup();
              }); 
          }

          map.on("contextmenu", function (event) {
              console.log("Coordinates: " + event.latlng.toString());

             maker = L.marker(event.latlng, {draggable: true});

             maker.on('drag', function(e) {
                    var position = this.getLatLng()
                    //console.log('marker drag event');
                    this.bindPopup("Coordenadas: " + position.lat + "," + position.lng );
                    $("[name=latitud]").val(position.lat);
                    $("[name=longitud]").val(position.lng);
                  })                
                  .addTo(map);

              maker.on('mouseover', function (e) {
                this.openPopup();
              });

              maker.on('mouseout', function (e) {
                  this.closePopup();
              });   
            });
          
      </script>
@endpush