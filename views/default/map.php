<?php 
$iconBase = "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
$markers = [
  ['<b>Jakarta</b>','-6.208760','106.845599',''],
  ['Makassar', '-5.147696', '119.432593',$iconBase.'parking_lot_maps.png'],
  ['Padang', '-0.947110', '100.414603',''],
  ['Pontianak', '-0.027842', '109.344250',''],
  ['Manokwari', '-0.861277', '134.062422',''],
  ['Nabire', '-3.371565', '135.501464',''],
  ['Yogyakarta', '-7.795766', '110.369866',''],
  ['Bali', '-8.344295', '115.101547',''],
  ['Palangkaraya', '-2.216392', '113.921577',''],
  ['Palembang', '-2.976224', '104.773948','']
];

$addMarker = '';
if(!empty($markers)){
  foreach($markers as $m){
    $addMarker .= "addMarker('".$m[1]."', '".$m['2']."', '".$m['0']."','".$m['3']."');";
  }
}
?>
<div id="googleMap" style="width:1100px;height:500px;"></div>
<?php

$apikey = 'AIzaSyCsM95TN0qAosv86-v5xljjMMAYjQPnfhk';
Yii::app()->clientScript->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=".$apikey."&callback=initializing_map",CClientScript::POS_END,['defer'=> 'true','async'=>'true']);
$script = <<< JS
const iconBase = "https://developers.google.com/maps/documentation/javascript/examples/full/images/";

var marker;
function initializing_map(){
    // Variabel untuk menyimpan informasi lokasi
    var infoWindow = new google.maps.InfoWindow;
    //  Variabel berisi properti tipe peta
    var mapOptions = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    } 
    // Pembuatan peta
    const peta = new google.maps.Map(document.getElementById('googleMap'), mapOptions);      
    // Variabel untuk menyimpan batas kordinat
    var bounds = new google.maps.LatLngBounds();
    // Pengambilan data dari database MySQL
    $addMarker

    // Proses membuat marker 
    function addMarker(lat, lng, info,icon){
      var lokasi = new google.maps.LatLng(lat, lng);
      bounds.extend(lokasi);
      var marker = new google.maps.Marker({
        map: peta,
        position: lokasi,
        icon: icon,
      });       
      peta.fitBounds(bounds);
      bindInfoWindow(marker, peta, infoWindow, info);
    }
    // Menampilkan informasi pada masing-masing marker yang diklik
    function bindInfoWindow(marker, peta, infoWindow, html){
        google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(peta, marker);
      });
    }
}
JS;
Yii::app()->clientScript->registerScript("myj",$script,CClientScript::POS_END);

  