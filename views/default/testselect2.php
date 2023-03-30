<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <select class="js-data-example-ajax form-control"></select>
        </div>
    </div>
</div>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/select2.full.min.js", CClientScript::POS_END);

Yii::app()->clientScript->registerCss('additional_css', '
    .result-select2{
        padding: 0 5px;
        font-family: "Poppins", sans-serif;
    }
    .result-select2-header{

    }
    .result-select2-footer-content{
        display: inline-block;
        min-width: 28%;
        margin-right: 20px;
        font-size: 14px;
    }
    .result-select2-footer-content .fa{
        margin-right: 10px !important;
    }
');
Yii::app()->clientScript->registerScript('additional', '

$(document).ready(function(){

    $(".js-data-example-ajax").select2({
        ajax: {
            url: "'.Yii::app()->createAbsoluteUrl("test/ajaxGetCustomer").'",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    "sda" : "asdsds",
                    search: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params){
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                        more: (params.page * 5) < data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: "Search for a customer",
        minimumInputLength: 2,
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        templateResult: formatRepo,
    });


function formatRepo (data) {
    if (data.loading) {
        return data.text;
    }
    var nama = data.nama_depan + " " + data.nama_belakang;
    var phone = "-";
    var email = "-";

    if(data.email != ""){
        email = data.email;
    }
    if(data.phone != ""){
        phone = data.phone;
    }

    var markup = `
        <div class="result-select2">
            <h6 class="result-select2-header">` + nama + `</h6>
            <div class="result-select2-footer">
                <div class="result-select2-footer-content">
                    <i class="fa fa-envelope" aria-hidden="true"></i>` + email + `
                </div>
                <div class="result-select2-footer-content">
                    <i class="fa fa-phone" aria-hidden="true"></i>` + phone + `
                </div>
            </div>
        </div>
    `;

    return markup;
}

});

', CClientScript::POS_END);

?>
