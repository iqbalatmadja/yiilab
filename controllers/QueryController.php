<?php
class QueryController extends Controller {
  public function actionIndex()
  {
    $branchId = 21;
    $subquery = Yii::app()->inventory->getFinalStockdata($branchId,0,0,0);
    $productQueryInfo = Produk::_queryProductInfo();
    $month = 4;
    $year = 2019;
    $query = Yii::app()->db->createCommand()
    ->select("
      p.id product_id, p.vendor_sku AS sku_vendor, p.barcode AS sku_web,
      pinfo.nama AS product_name, p.min_stock AS stock_min,
      SUM(COALESCE(s.stock, 0)) AS stock, s.serialnumber,p.type,p.pidr,
      alloc.packing_number storagelevel_id,sl.risk_cat_id,alloc.*")
    ->from("t_produk AS p")
    ->leftJoin("(".$productQueryInfo.") AS pinfo", "p.id = pinfo.idproduk")
    ->join("(".$subquery.") AS s", "p.id = s.prod_id")
    ->leftJoin("(
        SELECT
            mdetail.product_id,
            SUM(IFNULL(CASE WHEN m.jenis_mutasi = 1 THEN mdetail.qty ELSE 0 END,0)) AS allocin,
            SUM(IFNULL(CASE WHEN m.jenis_mutasi = 11 THEN mdetail.qty ELSE 0 END,0)) AS allocout,
            MAX(DATE(m.mutasi_date)) AS mutasi_date,
            mdetail.location_id,
            mdetail.packing_number
        FROM
            t_mutasi AS m
            INNER JOIN t_mutasi_details AS mdetail ON m.mutasi_id = mdetail.mutasi_id
        WHERE m.status = 1 AND (m.jenis_mutasi IN (1,11))
        GROUP BY mdetail.product_id, mdetail.location_id
    ) AS alloc
    ", "p.id = alloc.product_id")
    ->leftJoin("t_storagelevel sl","sl.id=alloc.packing_number")
    ->where("p.status = 1")
    ;// ->andWhere("MONTH(alloc.mutasi_date) = '".$month."'")
    // ->andWhere("YEAR(alloc.mutasi_date) = '".$year."'");

    $query = $query->group("p.id,p.vendor_sku,p.barcode, pinfo.nama,s.serialnumber")
    ->order("risk_cat_id ASC,stock desc");

    if (isset(Yii::app()->user->company_id) && ! empty(Yii::app()->user->company_id)) {
      if (Yii::app()->user->company_id == 1) {
        $query = $query->join("t_product_company AS pc", "pc.product_id = p.id AND pc.company_id IN (0, 1)");
      }else{
        $query = $query->join("t_product_company AS pc", "pc.product_id = p.id AND pc.company_id = '". Yii::app()->user->company_id ."'");
      }
    }
    $res = $query->queryAll();


    echo "<pre>";print_r($res);echo "</pre>";die;
  }

  public function actionSingle()
  {
    $sql = "SELECT 1";
    $x = Yii::app()->db->createCommand($sql)->queryAll();
    echo "<pre>";print_r($x);echo "</pre>";die;
  }
}

/**
 * EOF
*/
