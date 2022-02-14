<?php
class TestController extends Controller {
  public function actionIndex()
  {
    //$x = Helpers::getXaxis('2021-08-01','2021-08-30');
    // echo "<pre>";print_r($x);echo "</pre>";die;
    /*
    $sql =
    "SELECT DATE(cal.date) daydate FROM (
    SELECT SUBDATE('2021-08-30', INTERVAL 30 DAY) + INTERVAL xc DAY AS DATE
    FROM(
    SELECT @xi:=@xi+1 AS xc FROM(
    SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc1,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc2,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc3,
    (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc4,
    (SELECT @xi:=-1) xc0) xxc1) cal
    WHERE cal.date <= NOW()
    GROUP BY DATE(cal.date) ORDER BY DATE(cal.date) ASC";
    $dates = Yii::app()->db->createCommand($sql)->queryAll();
    echo "<pre>";print_r($dates);echo "</pre>";die;
    */
    /*
    $j = '[{"seller_info":{"id":0,"nama":"ECCS Demo [OFFICIAL]","nama_depan":"ECCS Demo","nama_belakang":"[OFFICIAL]","perusahaan":"","email":"","url":"#"},"seller_items":[{"index":0,"product_id":"560","barcode":"SN000000000007","type":"0","prod_name":"Motor Bebek","description":"<p>motor bebek<\/p>","image":"\/so\/image\/thumb-produk-560\/thumb-1618974675+1.jpg","quantity":1,"lead_time":0,"price":16000000,"text_price":"Rp 16,000,000","discount":0,"discount_amount":0,"price_after_discount":16000000,"text_price_after_discount":"Rp 16,000,000","total_after_discount":16000000,"text_total_after_discount":"Rp 16,000,000","serialnumber":"SND000000008","attributes":[{"prod_attr_id":"336","prod_attr_dtl_id":"690","prod_attr_name":"Warna","prod_attr_dtl_name":"Red","price":"0","sku":"SND000000008","use_stock":"1"}],"attribute_note":"","i":0,"weight":"2000.00","satuanberat":"Kg","available_in":true,"assigned_branch":"","packing_dimension":2100,"config_list":[]}],"totals":{"sub_total":16000000,"text_sub_total":"Rp 16,000,000","shipping_Total":0,"text_shipping_total":"Rp 0","grand_total":16000000,"text_grand_total":"Rp 16,000,000"}}]';
    $j = '[{"index":0,"product_id":"560","barcode":"SN000000000007","type":"0","prod_name":"Motor Bebek","description":"<p>motor bebek<\/p>","image":"\/so\/image\/thumb-produk-560\/thumb-1618974675+1.jpg","quantity":2,"lead_time":0,"price":16000000,"text_price":"Rp 16,000,000","discount":0,"discount_amount":0,"price_after_discount":16000000,"text_price_after_discount":"Rp 16,000,000","total_after_discount":32000000,"text_total_after_discount":"Rp 32,000,000","serialnumber":"SND000000008","attributes":[{"prod_attr_id":"336","prod_attr_dtl_id":"690","prod_attr_name":"Warna","prod_attr_dtl_name":"Red","price":"0","sku":"SND000000008","use_stock":"1"}],"attribute_note":"","i":0,"weight":"200.00","satuanberat":"Kg","available_in":true,"assigned_branch":"","packing_dimension":600,"config_list":[]}]';
    $x = CJSON::decode($j);
    echo "<pre>";print_r($x);echo "</pre>";die;
    */
    /*
    $start = '2021-07-19 00:00:00';
    $end = '2021-10-19 23:59:59';
    $x = Order::GetTransactions($start,$end);
    echo "<pre>";print_r($x);echo "</pre>";die;
    */

    // if(isset(Yii::app()->params['shipping']['local_db'] ) && Yii::app()->params['shipping']['local_db'] == true){
    //   echo 'calculate from local db';
    // }else{
    //   echo 'calculate direct api (normal)';
    // }

    // $orderDetailId = '9519';
    // $x = ProductAttributes::getListProductAttributeByOrderDetail($orderDetailId);
    // echo "<pre>";print_r($x);echo "</pre>";die;
    /*
    $fullAttributes = '';
    $temp = [];
    $orderDetail = OrderDetail::model()->findByPk($orderDetailId);
    $arr = [];
    if(!empty($orderDetail) && !empty($orderDetail->options)){
      $arr = explode('-',$orderDetail->options);
    }
    if(!empty($arr)){
      foreach($arr as $a){
        $prodAttrDtl = ProductAttributesDetail::model()->findByAttributes(['sku'=>$a]);
        if(!empty($prodAttrDtl)){
          $name = $prodAttrDtl->product_attribute->atribut->nama;
          $value = $prodAttrDtl->atribut_detail->nama;
        }
      }
    }
    */
    //echo "<pre>";print_r();echo "</pre>";
    /*
    $products = Yii::app()->db->createCommand()
                          ->select('p.*, pi.nama')
                          ->from('t_produk p')
                          ->leftJoin("(". Produk::_queryProductInfo() .") AS pi", 'p.id = pi.idproduk')
						  ->join("(
							  SELECT DISTINCT md.product_id
							  FROM t_mutasi_details AS md
							  INNER JOIN t_mutasi AS m ON m.mutasi_id = md.mutasi_id
							  WHERE m.status = 1 AND md.location_id = '32' AND md.packing_number = '248'
						  ) AS md", 'md.product_id = p.id')
						  ->where('p.status = 1')->queryAll();
    echo "<pre>";print_r($products);echo "</pre>";
    */
    // $product_details = Yii::app()->inventory->stockDetail(21,188, 0, '', '');
    // echo "<pre>";print_r($product_details);echo "</pre>";
    echo "<pre>";print_r(CGlobal::checkAccess('admin.import.csv'));echo "</pre>";die;
  }


}

/**
 * EOF
*/
