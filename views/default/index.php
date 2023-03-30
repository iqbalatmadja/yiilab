<h2>DATATABLES</h2>
<table id="dtable" class="table table-striped table-bordered" width="100%" cellspacing="0">
   <thead>
       <tr>
           <th>ID</th>
           <th>Nama Depan</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Action</th>
       </tr>
   </thead>

   <tfoot>

</table>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
// Yii::app()->clientScript->registerScriptFile($assetUrl.'/select2/dist/js/select2.min.js', CClientScript::POS_END);
// Yii::app()->clientScript->registerCssFile($assetUrl.'/select2/dist/css/select2.min.css');
// Yii::app()->clientScript->registerCssFile($assetUrl.'/sweetalert2/sweetalert2.min.css');
// Yii::app()->clientScript->registerScriptFile($assetUrl.'/sweetalert2/sweetalert2.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile($assetUrl.'/js/bootstrap-waitingfor.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($assetUrl.'/bootstrap/dist/css/bootstrap.min.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);

// DATATABLES
Yii::app()->clientScript->registerCssFile($assetUrl.'/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($assetUrl.'/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($assetUrl.'/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js', CClientScript::POS_END);
$url = Yii::app()->createAbsoluteUrl('yiilab/default/populateData');
$script = <<< JS
  $(document).ready(function() {
      var dataTable = $('#dtable').DataTable({
      "processing": true,
      "serverSide": true,
      "info": true,
      "lengthChange":true,
      "pageLength":5,
      "aaSorting": [[1,"DESC"]],
      "bAutoWidth":true,
      "ajax": {
          url: "$url",
          type: "post",
          error: function()
          {
             alert('error');
          }

      },
      "columns":[
        {
          'className':'details-control',
          'orderable': false,
          'data':'id'
        },
        {
          'className':'details-control',
          'orderable': true,
          'data':'nama_depan'
        },
        {
          'className':'details-control',
          'orderable': false,
          'data':'email'
        },
        {
          'className':'details-control',
          'orderable': false,
          'data':'phone'
        },
        {
          'className':'details-control',
          'orderable': false,
          'data':'buttons'
        },

      ]
  });

  $('#dtofficer tbody').on('click', '.selRow', function (){
    var data = dataTable.row($(this).parents('tr')).data();
    alert(data['id']);
    //window.location = '';
    return false;
  });

});
JS;
Yii::app()->clientScript->registerScript('wweeeqqwewq', $script, CClientScript::POS_END);
