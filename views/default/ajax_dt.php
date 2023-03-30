<?php
echo str_repeat('</br/>',10);
?>
<?php Yii::app()->clientScript->registerCssFile('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')?>
<?php Yii::app()->clientScript->registerScriptFile('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', CClientScript::POS_END);?>

<table id="ajaxdt" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>a</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>a</th>
        </tr>
    </tfoot>
</table>
<?php
Yii::app()->clientScript->registerScript('scr1',
'
$(document).ready(function() {
    var dt = $("#ajaxdt").DataTable( {
        "ajax": "'.Yii::app()->createAbsoluteUrl('test/populateDt').'",
        "deferRender": true,
        "columns": [
            { "data": "nama_depan" },
            { "data": "nama_belakang" },
            { "data": "perusahaan" },
            { "data": "email" },
            { "data": "datecreate" },
            { "data": "password" },
            {
                "className":"details-control",
                "orderable": false,
                "data": null,
                "defaultContent": "<a href=\"#\" class=\"showInfo\">a</a>"+
                "&nbsp;<button class=\"showModal\">b</button>"+
                ""
            },
        ]
    } );

    $("#ajaxdt tbody").on("click", "button", function () {
        var data = dt.row($(this).parents("tr")).data();
        alert(data["nama_depan"]);
    } );

} )


;


', CClientScript::POS_END);
?>
<script>
</script>
