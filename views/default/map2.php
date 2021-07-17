<div id="googlemap"></div>

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

$center = [$markers[0][1],$markers[0][2]];

Yii::app()->clientScript->registerCss('yuyu32u', '
/* Set the size of the div element that contains the map */
#googlemap {
  height: 400px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}
');
$apikey = 'AIzaSyCsM95TN0qAosv86-v5xljjMMAYjQPnfhk';
Yii::app()->clientScript->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=".$apikey."&callback=initmap",CClientScript::POS_END,['defer'=> 'true','async'=>'true']);
$script = <<< JS
function initmap(){
  const center = {lat:$center[0],lng:$center[1]};
  const map = new google.maps.Map(document.getElementById('googlemap'),{
    zoom: 10,
    center: center
  });

  // const marker = new google.maps.Marker({
  //   position: {lat:$center[0],lng:$center[1]},
  //   map: map,
  // });
}

function addMarker(map,lat,lng){
  new google.maps.Marker({
    position: {lat:lat,lng:lng},
    map: map,
  });
}
JS;
Yii::app()->clientScript->registerScript("myj",$script,CClientScript::POS_END);