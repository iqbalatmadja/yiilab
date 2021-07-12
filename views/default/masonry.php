<?php echo str_repeat('<br/>',2);?>
<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 100 }'>
    <?php
    $resproduk = Yii::app()->baseurl.Yii::app()->params['resproduk'];
    if(!empty($menus)){
        foreach($menus as $k=>$m){
            $image = ProdukGambar::gambarSatu($m->id);
            if (!$image){
                $imagez = Yii::app()->baseUrl.'/images/notfound.jpg';

            }else{
                $imagez =$resproduk.'/'.$m->id.'/thumb-'.@$image->url;
            }
            $productName = $m->getProductInfo()->nama;
            $shownProductName = strlen($productName)>23 ? substr($productName,0,20).'...' : $productName;
            $imghtml=CHtml::image(@$imagez, $productName);
    ?>
    <div class="grid-item">
        <img src="<?php echo $imagez; ?>" alt="" style="width: 111px;height: 111px;"/>
    </div>

    <?php
        }
    }
    ?>
</div>

<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->getBaseUrl() . '/js/masonry.pkgd.min.js',CClientScript::POS_END );
