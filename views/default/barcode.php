<?php
echo '<div id="showBarcode"><div>'; //the same id should be given to the extension item id

$optionsArray = array(
  'elementId'=>'showBarcode',
  'value'=>'INV-123-678',
  'type' => 'code128',
  'settings'=>array(
    'output'=>'css' /*css, bmp, canvas note- bmp and canvas incompatible wtih IE*/,
    /*if the output setting canvas*/
    'posX' => 10,
    'posY' => 20,
    /* */
    'bgColor'=>'#ffffff', /*background color*/
    'color' => '#000000', /*"1" Bars color*/
    'barWidth' => 1,
    'barHeight' => 50,
    /*-----------below settings only for datamatrix--------------------*/
    'moduleSize' => 5,
    'addQuietZone' => 0, /*Quiet Zone Modules */
  ),
  'rectangular'=> false /* true or false*/
  /* */
);
$this->widget('ext.barcode.Barcode', $optionsArray);
?>
