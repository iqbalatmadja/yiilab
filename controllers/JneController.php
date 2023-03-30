<?php
class JneController extends Controller {
  private $apiKey = 'e846efc8198ae34d3501fab58413a94a';
  private $username = 'INTEGRASIMEGAKANALAGENSI';

  public function actionIndex()
  {
    $url="http://apiv2.jne.co.id:10101/tracing/api/pricedev";
    $pars = "username=INTEGRASIMEGAKANALAGENSI&api_key=e846efc8198ae34d3501fab58413a94a&from=CKR10000&thru=CGK10101&weight=1";
    
    //$key_cache = $this->companyId.'_'.$this->xcode.'_'. md5($pars);
    // $data_cache = Yii::app()->cache->get($key_cache);

    // if(isset($data_cache->error)){
    //   $data_cache = false;
    // }
    $data_cache = false;

    if(!$data_cache){
      #calling API
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 90,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
          "Content-Type : application/x-www-form-urlencoded",
          'Accept: application/json'
        ),
      ));
      curl_setopt($curl, CURLOPT_POSTFIELDS, $pars);
      $response = curl_exec($curl);
      $data_cache = json_decode($response,true);
      $err = curl_error($curl);
      curl_close($curl);

      // if(isset($data_cache->error)){}
      // Yii::app()->cache->set($key_cache,$data_cache,4);
    }
    echo "<pre>";print_r($data_cache);echo "</pre>";die;
  }


}

/**
 *
 * EOF
*/
