<?php
class ApiController extends Controller {
  private $apiKey = '0525c8928370824bb39b3bceb122b9bb';
  public function actionIndex()
  {

  }

  public function actionRajaongkir1()
  {
    // Get All Provinces
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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

  public function actionRajaongkir2()
  {
    // Get A Province
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
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

  public function actionRajaongkir3()
  {
    // Get Cities in province
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
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

  public function actionRajaongkir4()
  {
    // Get City
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=5",
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
}

/**
 *
 * EOF
*/
