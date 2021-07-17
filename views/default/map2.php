<div id="googlemap"></div>
<div id="legend"><h3>Legend</h3></div>


<?php
$iconBase = "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
$markers = [
  ['<b>Jakarta</b>','-6.208760','106.845599',''],
  ['Bandung', '-6.9024759', '107.6166159',$iconBase.'parking_lot_maps.png'],
  ['Padang', '-0.947110', '100.414603',''],
  ['Pontianak', '-0.027842', '109.344250',''],
  ['Manokwari', '-0.861277', '134.062422',''],
  ['Nabire', '-3.371565', '135.501464',''],
  ['Yogyakarta', '-7.795766', '110.369866',''],
  ['Bali', '-8.344295', '115.101547',''],
  ['Palangkaraya', '-2.216392', '113.921577',''],
  ['Palembang', '-2.976224', '104.773948','']
];
$center = [$markers[0][1],$markers[0][2],$markers[0][3]];
$jakarta = [$markers[0][1],$markers[0][2],$markers[0][3]];
$bandung = [$markers[1][1],$markers[1][2],$markers[1][3]];

Yii::app()->clientScript->registerCss('yuyu32u', '
#googlemap {
  height: 100%;
  width: 100%;
}
');
$apikey = 'AIzaSyCsM95TN0qAosv86-v5xljjMMAYjQPnfhk';
Yii::app()->clientScript->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=".$apikey."&callback=initmap",CClientScript::POS_END,['defer'=> 'true','async'=>'true']);
$script = <<< JS
let map,center,locationButton,infoWindow;

function initmap(){
  center = {lat:$center[0],lng:$center[1]};
  map = new google.maps.Map(document.getElementById('googlemap'),{
    zoom: 8,
    center: center,
    mapTypeId: 'roadmap', // satellite||terrain||hybrid||roadmap
    disableDefaultUI: true,
    zoomControl: true,
    mapTypeControl: true,
    scaleControl: true,
    streetViewControl: true,
    rotateControl: true,
    fullscreenControl: true
  });
  
  infoWindow = new google.maps.InfoWindow();
  
  // ADDING MARKER
  addMarker(map,$jakarta[0],$jakarta[1],'$jakarta[2]');
  addMarker(map,$bandung[0],$bandung[1],'$bandung[2]');
  // /ADDING MARKER

  // PAN TO CURRENT POSITION
  const locationButton = document.createElement("button");
  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          infoWindow.setPosition(pos);
          infoWindow.setContent("<b>Location found.</b>");
          infoWindow.open(map);
          map.setCenter(pos);
        },() => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
  // /PAN TO CURRENT POSITION

  // LEGEND
  const legend = document.getElementById("legend");
  const div = document.createElement("div");
  div.innerHTML = 'd2d2ed2d23d23d23';
  legend.appendChild(div);
  map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(legend);
  //RIGHT_BOTTOM||LEFT_TOP||RIGHT_TOP||LEFT_BOTTOM||LEFT_CENTER||RIGHT_CENTER
  // /LEGEND


  

} // /initmap()

function addMarker(map,lat,lng,icon=''){
  // MARKER
  var marker = new google.maps.Marker({
    position: {lat:lat,lng:lng},
    map: map,
    icon: icon
  });
  // /MARKER

  // INFOWINDOW
  var infowindow = new google.maps.InfoWindow();
  google.maps.event.addListener(marker, 'click', (function() {
    return function() {
      infowindow.setContent('<div>Do ajax here to get content</div>');
      infowindow.open(map, marker);
    }
  })());
  // /INFOWINDOW

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

JS;
Yii::app()->clientScript->registerScript("myj",$script,CClientScript::POS_END);