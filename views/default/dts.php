<?php #---------------------------- ?>
<table id="dtable" class="table table-striped table-bordered" width="100%" cellspacing="0">
  <thead>
      <tr>
          <th class="text-center">User ID</th>
          <th class="text-center">First Name</th>
          <th class="text-center">Created</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
      </tr>
  </thead>
  <tfoot>
  </tfoot>
</table>
<?php #/---------------------------- ?>

 <?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerCssFile($assetUrl.'/fontawesome-5.15.3/css/all.min.css');
Yii::app()->clientScript->registerCssFile($assetUrl.'/bootstrap/dist/css/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile($assetUrl.'/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($assetUrl.'/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerCss('addi222333', '
');
$yes = Yii::t('servicemanagement','yes');
$no = Yii::t('servicemanagement','no');
$rusure9 = Yii::t('servicemanagement','rusure9');
$url1 = Yii::app()->createAbsoluteUrl('/yiilab/default/populateUser');
$script = <<< JS
$(function(){

  let csrf_name = getCsrfName(),csrf_value = getCsrfValue();
  // render select2
  //renderSelect2('._select2_');

  var dataTable = $('#dtable').DataTable({
    "processing": true,
    "serverSide": true,
    "info": true,
    "lengthChange":true,
    "pageLength":10,
    "aaSorting": [[2,"DESC"]],
    'deferRender': true,
    "bAutoWidth":true,
    "ajax": {url: "$url1",type: "post",error: function(){alert('error');}},
    "columns":[
      {
        'className':'details-control',
        'orderable': true,
        'data':'user_id'
      },
      {
        'className':'details-control',
        'orderable': true,
        'data':'first_name'
      },
      {
        'className':'details-control',
        'orderable': true,
        'data':'created_dt'
      },
      {
        'className':'text-center',
        'orderable': true,
        'data':'status'
      },
      {
        "orderable":false,
        "className": 'text-center',
        "data": null,
        "render":function(data, type, row, meta)
        {
          var btn = '<a href="#" class="selRow1 mr-20"><i class="fas fa-eye mr-10 font-20"></i></a>';
          return btn;
        },
        "targets": -1
      }

    ]
  });

  $('#dtable tbody').on('click', '.selRow1', function (){
    var data = dataTable.row($(this).parents('tr')).data();
    alert(data['view_url']);
    // window.location = data['view_url'];
    return false;
  });

  $('#dtable tbody').on('click', '.selRow2', function (){
    var datafrm = dataTable.row($(this).parents('tr')).data();
    Swal.fire({
      title: "$rusure9",icon: "warning",showCancelButton: true,
      confirmButtonColor: "#f71616",confirmButtonText: "$yes",
      cancelButtonText: "$no",cancelButtonColor: "#4636f7"
    }).then((result) => {
      if (result.isConfirmed) {
        alert(datafrm['view_url']);
        //delActivity(datafrm['activity_id']);
      }else if (result.dismiss === Swal.DismissReason.cancel) {
      }
    })
    return false;
  });


});
JS;
Yii::app()->clientScript->registerScript('fdfrewtr354t', $script, CClientScript::POS_END);
/**
 * EOF
 */
