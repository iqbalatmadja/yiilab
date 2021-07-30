<?php
class DefaultController extends Controller {
  public function actionIndex()
  {
    $data = [];
    $this->render('index',$data);
  }

  public function actionPopulateData()
  {
    $requestData = $_REQUEST;
    $columnsToOrder = [
      1 => 'nama_depan',
      2 => 'email',
      3 => 'phone'
    ];
    $columnsToFilter = [
      'nama_depan','email','phone'
    ];
    $tableName = 't_user';

    $sql = "SELECT  * from ".$tableName." where 1=1 ";
    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalData = count($data);
    $totalFiltered = $totalData;

    if(!empty($requestData['search']['value']) && !empty($columnsToFilter)){
      $sql .= "AND( ";
      foreach($columnsToFilter as $f){
        $sql .= $f." LIKE '".$requestData['search']['value']."%' OR ";
      }
      $sql = substr($sql,0,strlen($sql)-3);
      $sql .= ") ";
    }

    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalFiltered = count($data);

    if(!empty($requestData['order'][0])){
      $sql .= " ORDER BY ".$columnsToOrder[$requestData['order'][0]['column']]."  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."  ";
    }
    $result = Yii::app()->db->createCommand($sql)->queryAll();

    $data = [];
    $i=1;

    foreach ($result as $key => $row){
      $nestedData = [];
      $url = '#';
      $nestedData['id'] = $row['id'];
      $nestedData['nama_depan'] = $row["nama_depan"];
      $nestedData['email'] = $row["email"];
      $nestedData['phone'] = $row["phone"];
      $nestedData['buttons'] = '<a href="'.$url.'" class="selRow"><span class="glyphicon glyphicon-pencil">sss</span></a>';
      $data[] = $nestedData;
      $i++;
    }
    $jsonData = [
      "draw" => isset($requestData['draw']) ? intval($requestData['draw']) : 0,
      "recordsTotal" => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data" => $data   // total data array
    ];
    echo CJSON::encode($jsonData);
  }

  public function actionError() {
    $this->layout = 'main_login';
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
          echo $error['message'];
      else
          $this->render('error', $error);
    }
  }

  public function actionValidatephone(){
    $l = [
      '021567898989',
      '085656565656',
      '+62867564545',
      '+622190989789887',
      '02278674556',
      '025178569078',
      '628345687967'
    ];
    foreach($l as $v){
        $c = Helpers::ValidatePhone($v);
        echo "converting ".$v." to ".$c."<br/>";

    }
  }

  public function actionDistance()
  {
    //$addressFrom = 'Perum Villa Mahkota Indah Blok F15/2 Jl. Damai 5, PAHLAWAN SETIA, TARUMAJAYA, BEKASI, JAWA BARAT';
    $addressFrom = 'Perum Villa Mahkota Indah Blok F15/2 Jl. Damai 5, PAHLAWAN SETIA, BEKASI';
    //$addressTo = 'Jalan Tanjung Duren Timur No.4 RT 09 RW 1, Tanjung Duren selatan, Grogol Petamburan, Jakarta Barat, DKI Jakarta';
    $addressTo = 'Jalan Tanjung Duren Timur I No.4 RT 09 RW 01, Tanjung Duren Selatan, Jakarta Barat';

    $distance = Helpers::getDrivingDistance(urlencode($addressFrom), urlencode($addressTo));
    echo '<pre>';print_r($distance);echo '</pre>';
  }

  public function actionImage()
  {
      $pid = 99;
      $file = 'royal-doulton-hemmingwaydesign-grey-16-piece-set-701587306201.jpg';
      $x = Helpers::GetImageInfo($pid,$file);
      echo '<pre>';print_r($x);echo '</pre>';
      echo $x['imageUrl']['thumb'];
  }

  public function actionInv()
  {
      $productId = 189;
      $serialnumber = '';
      $y = Yii::app()->inventory->stockDetail(0,$productId, 0, '', $serialnumber);
      $x = Helpers::ArrayGrouping('cabang_id',$y);
      $result = [];
      foreach($x as $k=>$v){
          $result[] = $k;
      }
      echo '<pre>';print_r($result);die;
  }

  public function actionUnit()
    {
        $w = 1001;
        echo ceil($w/1000);
    }

    public function actionReportSql()
    {
        $commissionPercentage = 0.01;
        $startDate = '2020-09-01';
        $endDate = '2020-09-30';
        $sql = "SELECT t.status,
        CONCAT(t2.firstname_shipping,t2.lastname_shipping) AS nama_customer,
        t.tanggal,t1.source_name,t.id AS order_id,t.invoice_no,
        (SELECT GROUP_CONCAT(t4.nama SEPARATOR ', ') FROM t_order_detail t4 WHERE t4.idorder=t.id) AS product_name,
        (SELECT GROUP_CONCAT(t6.barcode SEPARATOR ', ') FROM t_order_detail t5 INNER JOIN t_produk t6 ON(t5.idproduk = t6.id) WHERE t5.idorder=t.id) AS sku_web,
        t.total_barang,t.voucher_nominal,t.cashback,t.total_shipping,
        (t.total_barang-t.voucher_nominal-t.cashback) AS harga_jual_barang,
        0 AS gratis_ongkir,
        0 AS insurance,
        FORMAT((t.total_barang-t.voucher_nominal+t.total_shipping+0),2) AS total_received_from_customer,
        FORMAT((t.total_barang/1.1),2) AS price_exc_ppn,
        FORMAT((t.total_barang-t.voucher_nominal)*".$commissionPercentage.",2) AS comission
        FROM t_order t
        LEFT JOIN t_source t1 ON(t1.source_id=t.source_id)
        INNER JOIN t_order_infos t2 ON(t2.order_id=t.id)
        WHERE t.tanggal BETWEEN '".$startDate."' AND '".$endDate."'
        ORDER BY t.tanggal DESC ";
        $orders = Yii::app()->db->createCommand($sql)->queryAll();

        $filename = 'report_'.$startDate.'-'.$endDate.'.xls';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        $separator = "\t";

        if(!empty($orders)){
            echo ",,,,,,,,RECEIVED FROM CUSTOMER\n";
            echo "\n";
            echo "\n";
            $title = "Nama Customer,Tanggal Transfer,Marketplace, Tanggal Transaksi,".
            "Order Invoice Marketplace,Order ID Megakanal,SKU Web, Nama Barang,".
            "Harga Jual Barang,Price incl. PPN (IDR),Discount (IDR) ,Cashback (IDR),".
            "Shipping Fee (IDR),Gratis Ongkir (IDR),Insurance (IDR),TOTAL Received from Customer (IDR),".
            "Price excl. PPN (IDR),Commission incl. PPN,PPH (IDR),Shipping by Marketplace (IDR) Gratis ongkir,".
            "Insurance by Marketplaces (IDR),TOTAL Received from Marketplace (IDR),Discount From Client (IDR),".
            "Discount on Marketplaces (IDR),Selisih Discount (IDR),Shipping Cost (JNE/LION/DAKOTA) (IDR),".
            "Received Shipping from Customer,Selisih Shipping (IDR),Promotion Cost From Shipping,".
            "TOTAL Promotion Cost (IDR),PAID TO CLIENT (IDR),Note,COGS,Profit\n";
            //echo "Periode ".$startDate."-".$endDate."\n";
            echo $title;
            //echo implode($separator, array_keys($orders[0])) . "\n";
        }
    }

    public function actionExcel()
    {
        echo date('H:i:s') , " Create new PHPExcel object <br/>";


        $objPHPExcel = new PHPExcel();
        // Set document properties
        echo date('H:i:s') , " Set document properties <br/>";
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    				 ->setLastModifiedBy("Maarten Balliauw")
    				 ->setTitle("PHPExcel Test Document")
    				 ->setSubject("PHPExcel Test Document")
    				 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
    				 ->setKeywords("office PHPExcel php")
    				 ->setCategory("Test result file");
                     // Add some data
        echo date('H:i:s') , " Add some data<br/>";
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Miscellaneous glyphs')
                    ->setCellValue('A5', 'xxxxxxxx sxxxxxx');


        $objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


        $value = "-ValueA\n-Value B\n-Value C";
        $objPHPExcel->getActiveSheet()->setCellValue('A10', $value);
        $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A10')->setQuotePrefix(true);

        // Rename worksheet
        echo date('H:i:s') , " Rename worksheet <br/>";
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        echo date('H:i:s') , " Write to Excel2007 format<br/>";
        $callStartTime = microtime(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $fileFullPath = dirname(Yii::app()->request->scriptFile).'/upload/x.xls';
        //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objWriter->save($fileFullPath);
    }

    public function actionReport()
    {
        $writer = new XLSXWriter();
        $writer->setTitle('Some Title');
        $writer->setSubject('Some Subject');
        $writer->setAuthor('Some Author');
        $writer->setCompany('Some Company');
        //$writer->setKeywords($keywords);
        $writer->setDescription('Some interesting description');
        $writer->setTempDir(sys_get_temp_dir());//set custom tempdir
        $filename = "example.xlsx";

        $styles1 = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');

        $writer->writeSheetRow('Sheet1', $rowdata = array(1,2,'=(A1+B1)*2',789), $styles1 );
        //$writer->writeToFile("php://output");

        header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $writer->writeToStdOut();


    }

    public function actionIp()
    {
        $ip = Helpers::getIP();
        echo "IP:".$ip;
    }

    public function actionTrans()
    {
      echo Yii::app()->language;
      echo '<br/>';
      echo Yii::app()->language = 'en';

      echo Yii::t('d2chome','header.company-information');
    }

    public function actionTt()
    {
      $x = AdsSpending::getSpendingComparison('2021-04-01 00:00:00','2021-05-30 23:59:59',9,'monthly' );
      echo "<pre>";print_r($x);echo "</pre>";die;
    }

    public function actionCounting()
    {
      $start = '2021-04-01';
      $end = '2021-06-01';
      $channelId = NULL;
      $x = Helpers::getRevenue($channelId,$start,$end);
      echo "<pre>";print_r($x);echo "</pre>";die;
    }

    public function actionC2()
    {
      $start = '2021-04-01';
      $end = '2021-04-01';
      $channelId = 9;
      $revenueArray[] = Helpers::getRevenue(NULL,$start." 00:00:00" ,$end." 23:59:59");
      echo "<pre>";print_r($revenueArray);echo "</pre>";die;;
    }

  public function actionC3()
  {
    $userId = 172;
    $addresses = AddressList::model()->with(['country', 'province', 'district', 'subdistrict', 'urbanvillage'])->findAllByAttributes([
          'user_id' => $userId
      ]);
    echo "<pre>";print_r($addresses[0]->province->name);echo "</pre>";
    foreach($addresses as $a){
      echo "<pre>";print_r($a->province->name);echo "</pre>";
      echo "<pre>";print_r($a->district->name);echo "</pre>";
      echo "<pre>";print_r($a->subdistrict->name);echo "</pre>";
      echo "<pre>";print_r($a->urbanvillage->name);echo "</pre>";
      echo "--------------------------------------------------------<br/>";
    }

  }

  public function actionC4()
  {
    $array = [
      'warranty_code' => 'ssss',
      'issues' => [
        [
          'key' => 774,
          'issue' => 'Keempukan',
          'status' => 0
        ],
        [
          'key' => 397,
          'issue' => 'Patah',
          'status' => 0
        ],
      ]
    ];
    $json = CJSON::encode($array);
    echo $json;die;
    echo "<pre>";print_r($array);echo "</pre>";die;
  }

  public function actionEditor()
  {
    $this->render('editor',[]);
  }

  public function actionMap()
  {
    $data = [];
    $this->render('map',$data);
  }

  public function actionMap2()
  {
    $data = [];
    $this->render('map2',$data);
  }

  public function actionAny()
  {
    $data = [];
    $this->render('any',$data);
  }

  public function actionDts()
  {
    $data = [];
    $this->render('dts',$data);
  }

  public function actionPopulateUser()
  {
    $sql = "SELECT t.id user_id,t.nama_depan first_name,
    t.nama_belakang last_name, t.datecreate created_dt,t.status
    FROM t_user t
    WHERE 1 ";

    $requestData = $_REQUEST;
    $columns = ['user_id','first_name','last_name','created_dt','status'];

    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalData = count($data);
    $totalFiltered = $totalData;

    if(!empty($requestData['search']['value']) && !empty($columns)){
      $sql .= "AND( ";
      foreach($columns as $f){
        $sql .= $f." LIKE '".$requestData['search']['value']."%' OR ";
      }
      $sql = substr($sql,0,strlen($sql)-3);
      $sql .= ") ";
    }

    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalFiltered = count($data);

    if(!empty($requestData['order'][0])){
      $sql .= " ORDER BY ".$columns[$requestData['order'][0]['column']]."  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."  ";
    }
    $result = Yii::app()->db->createCommand($sql)->queryAll();

    $data = [];
    $i=1;

    foreach ($result as $key => $row){
      $nestedData = [];
      $viewUrl = Yii::app()->createAbsoluteUrl('/servicemanagement/schedules/view',['id'=>$row['user_id']]);
      $nestedData = [
        'user_id' => $row['user_id'],
        'first_name' => $row['first_name'],
        'last_name' => $row["last_name"],
        'created_dt' => $row["created_dt"],
        'status' => $row['status'],
        'view_url' => $viewUrl,
      ];
      $data[] = $nestedData;
      $i++;
    }

    $jsonData = [
      "draw" => isset($requestData['draw']) ? intval($requestData['draw']) : 0,
      "recordsTotal" => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data" => $data   // total data array
    ];
    echo CJSON::encode($jsonData);

  }

}

/**
 *
 * EOF
*/
