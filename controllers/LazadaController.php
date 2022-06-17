<?php
class LazadaController extends Controller {
  public function actionIndex()
  {
    $m = 'lazada';
    $class = CExtensions::getMarketplace($m);
    //$x = $class->getCategoryAttributes(1);
    //$x = $class->getLogo();
    //$x = $class->__refreshToken();
    //$x = $class->__generateToken();
    // $x = $class->prepareGenerateCode();
    // $x = $class->updateStock();
    //$x = $class->getOptionTreeLazada(['category_id'=>1]);
    //$x = $class->getProductCategories();
    // $filepath = Yii::getPathOfAlias('application.runtime') . "/data_lazada_products.txt";
    // $content = file_get_contents($filepath);
    // $products = json_decode($content,true);
    // for($i=851;$i>2;$i--){
    //   unset($products[$i]);
    // }
    $x = $class->getProductsFromMplace();
    echo "<pre>";print_r($x);echo "</pre>";die;
  }

  public function actionLazada()
  {

    $path = Yii::getPathOfAlias('ext.lazada-op') . DIRECTORY_SEPARATOR .  'LazopSdk.php';
    spl_autoload_unregister(array('YiiBase','autoload'));
    require_once ( $path );
    spl_autoload_register(array('YiiBase','autoload'));

    // $baseApiUrl = "https://api.lazada.co.id/rest";
    $baseApiUrl = "https://auth.lazada.com/rest";
    $apiKey = "114099";
    $apiSecret = "LXiIvXYzt9pAlPQxuFIIX508FJ60VYIk";
    $route = "/products/get";
    $method = "";

    $c = new LazopClient($baseApiUrl, $apiKey, $apiSecret);
    $request = new LazopRequest($route,$method);
    $request->addApiParam("filter", "live");
    echo $apiKey."<br/>";
    echo $baseApiUrl."<br/>";
    echo $route."<br/>";
    var_dump($c->execute($request));



  }

  public function actionLab()
  {
    $path = Yii::getPathOfAlias('ext.lazada-op') . DIRECTORY_SEPARATOR .  'LazopSdk.php';
    spl_autoload_unregister(array('YiiBase','autoload'));
    require_once ( $path );
    spl_autoload_register(array('YiiBase','autoload'));

    $baseApiUrl = "https://auth.lazada.com/rest";
    $apiKey = "125705";
    $accessToken = "50000300b20gSYjApXsyce7mveJRgTuj182709a2WDCrePw0DFIKjZkzxlZ6r55d";
    $apiSecret = "OelzfPwC0nY3Ry5UyISqKMo3eTDdjZNA";
    $route = "/products/get";

    $c = new LazopClient($baseApiUrl,$apiKey,$apiSecret);
    $request = new LazopRequest('/products/get','GET');
    $request->addApiParam('filter','live');
    $request->addApiParam('update_before','2018-01-01T00:00:00+0800');
    $request->addApiParam('create_before','2018-01-01T00:00:00+0800');
    $request->addApiParam('offset','0');
    $request->addApiParam('create_after','2010-01-01T00:00:00+0800');
    $request->addApiParam('update_after','2010-01-01T00:00:00+0800');
    $request->addApiParam('limit','10');
    $request->addApiParam('options','1');
    $request->addApiParam('sku_seller_list',' [\"39817:01:01\", \"Apple 6S Black\"]');
    var_dump($c->execute($request, $accessToken));
  }
}

/**
 * EOF
*/
