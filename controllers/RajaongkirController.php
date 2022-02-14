<?php
class RajaongkirController extends Controller {
  private $apiKey = 'b6bcabe308c3efaf35197ac2f50c81e3';
  public function actionIndex()
  {

  }

  public function actionProvince($id=0)
  {
    $curl = curl_init();
    $apiUrl = "https://pro.rajaongkir.com/api/province";
    if($id>0){
      $apiUrl .= "?id=".$id;
    }
    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: $this->apiKey"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  public function actionCity($id=0)
  {
    $apiUrl = "https://api.rajaongkir.com/starter/city";
    if($id > 0){
      // $apiUrl .= "?province=".$id;
      $apiUrl .= "?id=".$id;
    }
    // Get Cities in province
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: $this->apiKey"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

  }

  public function actionRajaongkir5()
  {
    $json = Helpers::getAreaJson();
    echo "<pre>";print_r($json);echo "</pre>";
  }

  public function actionGetcost()
  {
    //calculateCost($urbanvillage,$qty_dim,$calculate_branch_id = 0,$subdistrict = 0)
    $companyId = 0;
    $xcode = 'jne2';
    if(Yii::app()->params['company_id'] > 1 && Yii::app()->params['project_name'] == 'adminlite'){
      $companyId = Yii::app()->params['company_id'];
      $xcode = $companyId . '_jne';
    }

    $apiKey = Yii::app()->checkout->getExtSetting($xcode, 'api_key');
    $serviceType = Yii::app()->checkout->getExtSetting($xcode, 'service_type');
    $areaJson = strtolower(Yii::app()->checkout->getExtSetting($xcode, 'area_json'));
    $areaJson = CJSON::decode($areaJson);

    $villageIdOrigin = 42845; // KEBAYORAN LAMA SELATAN
    $villageIdDestination = 35016; // GROGOL
    $weight = 1000;

    $fullDestination = Helpers::fullAddress($villageIdDestination);
    if(!empty($fullDestination)){
      $key = array_search(strtolower($fullDestination['city_name']), array_column($areaJson[$fullDestination['province_id']], 'city_name'));
      $destination = $areaJson[$fullDestination['province_id']][$key];
    }else{
      $destination = [];
    }

    $fullOrigin = Helpers::fullAddress($villageIdOrigin);
    if(!empty($fullOrigin)){
      $key = array_search(strtolower($fullOrigin['city_name']), array_column($areaJson[$fullOrigin['province_id']], 'city_name'));
      $origin = $areaJson[$fullOrigin['province_id']][$key];
    }else{
      $origin = [];
    }

    unset($areaJson); // to save memory

    if(!empty($destination) && !empty($origin)){
      // echo "<pre>";print_r($destination);echo "</pre>";
      // echo "<pre>";print_r($origin);echo "</pre>";
      // Hit API to get Cost
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin['city_id']."&destination=".$destination['city_id']."&weight=".$weight."&courier=jne",
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key: ".$apiKey
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }

    }else{
      if(empty($destination)){
        Yii::log("EMPTY DESTINATION","warning");
      }
      if(empty($origin)){
        Yii::log("EMPTY ORIGIN","warning");
      }
    }

    // echo "<pre>";print_r($fullDestination);echo "</pre>";
    // echo "<pre>";print_r($areaJson[$fullDestination['province_id']]);echo "</pre>";
    // echo "<pre>";print_r($key);echo "</pre>";
    // echo "<pre>";print_r($apiKey);echo "</pre>";
    // echo "<pre>";print_r($serviceType);echo "</pre>";
    // echo "<pre>";print_r($areaJson);echo "</pre>";

  }

  public function actionGetcostpro()
  {
    //calculateCost($urbanvillage,$qty_dim,$calculate_branch_id = 0,$subdistrict = 0)
    $companyId = 0;
    $xcode = 'jne2';
    if(Yii::app()->params['company_id'] > 1 && Yii::app()->params['project_name'] == 'adminlite'){
      $companyId = Yii::app()->params['company_id'];
      $xcode = $companyId . '_jne';
    }

    $apiKey = 'b6bcabe308c3efaf35197ac2f50c81e3'; # pro
    $serviceType = Yii::app()->checkout->getExtSetting($xcode, 'service_type');
    $areaJson = strtolower(Yii::app()->checkout->getExtSetting($xcode, 'area_json'));
    $areaJson = CJSON::decode($areaJson);

    //$villageIdOrigin = 42845; // KEBAYORAN LAMA SELATAN
    $villageIdOrigin = 29079; // KETILENG - CILEGON
    $villageIdDestination = 35016; // GROGOL
    $weight = 1000;

    $fullDestination = Helpers::fullAddress($villageIdDestination);
    if(!empty($fullDestination)){
      $key = array_search(strtolower($fullDestination['city_name']), array_column($areaJson[$fullDestination['province_id']], 'city_name'));
      $destination = $areaJson[$fullDestination['province_id']][$key];
    }else{
      $destination = [];
    }

    $fullOrigin = Helpers::fullAddress($villageIdOrigin);
    if(!empty($fullOrigin)){
      $key = array_search(strtolower($fullOrigin['city_name']), array_column($areaJson[$fullOrigin['province_id']], 'city_name'));
      $origin = $areaJson[$fullOrigin['province_id']][$key];
    }else{
      $origin = [];
    }

    unset($areaJson); // to save memory

    if(!empty($destination) && !empty($origin)){
      $weight = 1000;
      $courier = "ninja";
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin['city_id']."&originType=city&destination=".$destination['city_id']."&destinationType=city&weight=".$weight."&courier=".$courier,
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key: ".$apiKey
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }

    }else{
      if(empty($destination)){
        Yii::log("EMPTY DESTINATION","warning");
      }
      if(empty($origin)){
        Yii::log("EMPTY ORIGIN","warning");
      }
    }
  }

  public function actionSubdistrict($id=0)
  {
    $apiKey = 'b6bcabe308c3efaf35197ac2f50c81e3'; # pro
    $curl = curl_init();
    $apiUrl = "https://pro.rajaongkir.com/api/subdistrict?city=55";
    // $apiUrl = "https://pro.rajaongkir.com/api/subdistrict";

    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: ".$apiKey
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  public function actionGetcost2()
  {
    $apiKey = 'b6bcabe308c3efaf35197ac2f50c81e3'; # pro
    $weight = 1000;
    $courier = 'ninja';
    //$origin = 54;
    $origin = 151;
    $destination = 151;
    $curl = curl_init();
    // $postFields = "origin=501&originType=city&destination=574&destinationType=subdistrict&weight=".$weight."&courier=".$courier;
    $postFields = "origin=".$origin."&originType=city&destination=".$destination."&destinationType=city&weight=".$weight."&courier=".$courier;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $postFields,
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key:".$apiKey
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  public function actionTracking()
  {
    $apiKey = 'b6bcabe308c3efaf35197ac2f50c81e3';
    $waybill = '6300592100003425';
    $courier = 'jne';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "waybill=6300592100003425&courier=jne",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: b6bcabe308c3efaf35197ac2f50c81e3"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

  }
}

/**
 *
 * EOF
*/
