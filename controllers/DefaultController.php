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
    $columns = [
      0 => 'id',
      1 => 'nama_depan',
      2 => 'email',
      3 => 'phone'
    ];
    $tableName = 't_user';

    $sql = "SELECT  * from ".$tableName." where 1=1";
    $data = Yii::app()->db->createCommand($sql)->queryAll();
    $totalData = count($data);
    $totalFiltered = $totalData;

    if (!empty($requestData['search']['value'])){
      $sql.=" AND (nama_depan LIKE '" . $requestData['search']['value'] . "%' ";
      $sql.=" OR email LIKE '" . $requestData['search']['value'] . "%'";
      $sql.=" OR phone LIKE '" . $requestData['search']['value'] . "%')";
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
      $url = '#';
      $nestedData['id'] = $row['id'];
      $nestedData['nama_depan'] = $row["nama_depan"];
      $nestedData['email'] = $row["email"];
      $nestedData['phone'] = $row["phone"];
      $nestedData['buttons'] = '<a href="'.$url.'" class="selRow"><span class="glyphicon glyphicon-pencil">sss</span></a>';
      $data[] = $nestedData;
      $i++;
    }
    $json_data = array(
      "draw" => isset($requestData['draw']) ? intval($requestData['draw']) : 0, 
      "recordsTotal" => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data" => $data   // total data array
    );
    echo json_encode($json_data);
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
}

/** 
 * 
 * EOF
*/
