<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <label class="cabinet center-block">
        <figure>
          <img src="" class="gambar img-responsive img-thumbnail" id="item-img-output" />
          <figcaption>
            UPLOAD NEW
          </figcaption>
        </figure>
        <input type="file" class="item-img file center-block" name="file_photo"/>
      </label>
    </div>
  </div>
</div>

<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit</h4>
      </div>
      <div class="modal-body">
        <div id="upload-demo" class="center-block"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
      </div>
    </div>
  </div>
</div>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerScriptFile($assetUrl.'/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($assetUrl.'/bootstrap/dist/css/bootstrap.min.css');

Yii::app()->clientScript->registerCssFile($assetUrl.'/Croppie/croppie.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/Croppie/croppie.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCss('eelknjohupoiu', '
label.cabinet{
	display: block;
	cursor: pointer;
}

label.cabinet input.file{
	position: relative;
	height: 100%;
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	width: 250px;
	height: 250px;
  padding-bottom:25px;
}

');

$script = <<< JS
// Start upload preview image
$(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
var uploadCrop,tempFilename,rawImg,imageId;
function readFile(input) {
	if(input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
  		$('.upload-demo').addClass('ready');
  		$('#cropImagePop').modal('show');
      rawImg = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }else{
    alert("Sorry - you're browser doesn't support the FileReader API");
  }
}

uploadCrop = $('#upload-demo').croppie({
	viewport: {
		width: 150,
		height: 200,
	},
	enforceBoundary: false,
	enableExif: true
});

$('#cropImagePop').on('shown.bs.modal', function(){
	// alert('Shown pop');
	uploadCrop.croppie('bind', {
    		url: rawImg
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
});

$('.item-img').on('change', function () {
  imageId = $(this).data('id');
  tempFilename = $(this).val();
  $('#cancelCropBtn').data('id', imageId);
  readFile(this);
});

$('#cropImageBtn').on('click', function (ev) {
	uploadCrop.croppie('result', {
		type: 'base64',
		format: 'jpeg',
		size: {width: 150, height: 200}
	}).then(function (resp) {
		$('#item-img-output').attr('src', resp);
		$('#cropImagePop').modal('hide');
	});
});

JS;
Yii::app()->clientScript->registerScript('vfderwf', $script, CClientScript::POS_END);
