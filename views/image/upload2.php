<div class="container" >
	<br />
	<h3>Crop Image Before Upload using CropperJS with PHP</h3>
	<br />

	<div class="row">
		<div class="col-md-4">&nbsp;</div>
		<form method="post" action="<?php echo Yii::app()->createAbsoluteUrl("yiilab/image/submit");?>">
		<div class="col-md-4">
			<div class="image_area">
					<input type="text" name="temporary_name" id="temporary_name"/>
					<label for="upload_image">
						<img src="http://kebudayaan.kemdikbud.go.id/ditpmmb/wp-content/uploads/sites/66/2020/09/dummy-image-green-e1398449160839.jpg" id="uploaded_image" class="img-responsive img-circle" />
						<div class="overlay">
							<div class="text">Click to Change Profile Image</div>
						</div>
						<input type="file" name="image" class="image" id="upload_image" style="display:none" />
					</label>

			</div>
		</div>
		<div class="col-md-12">
			<input type="submit" />
		</div>
		</form>
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Crop Image Before Upload</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="img-container">
									<div class="row">
											<div class="col-md-8">
													<img src="" id="sample_image" />
											</div>
											<div class="col-md-4">
													<div class="preview"></div>
											</div>
									</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" id="crop" class="btn btn-primary">Crop</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
				</div>
			</div>
	</div>
</div>
<?php
$assetUrl = Yii::app()->getModule('yiilab')->getAssetsUrl();
Yii::app()->clientScript->registerScriptFile($assetUrl.'/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($assetUrl.'/bootstrap/dist/css/bootstrap.min.css');

Yii::app()->clientScript->registerCssFile($assetUrl.'/dropzone-5.7.0/dist/min/dropzone.min.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/dropzone-5.7.0/dist/min/dropzone.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerCssFile($assetUrl.'/cropperjs/dist/cropper.min.css');
Yii::app()->clientScript->registerScriptFile($assetUrl.'/cropperjs/dist/cropper.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerCss('xxsxxs', '
.image_area {
	position: relative;
}

img {
		display: block;
		max-width: 100%;
}

.preview {
		overflow: hidden;
		width: 160px;
		height: 160px;
		margin: 10px;
		border: 1px solid red;
}

.modal-lg{
		max-width: 1000px !important;
}

.overlay {
	position: absolute;
	bottom: 10px;
	left: 0;
	right: 0;
	background-color: rgba(255, 255, 255, 0.5);
	overflow: hidden;
	height: 0;
	transition: .5s ease;
	width: 100%;
}

.image_area:hover .overlay {
	height: 50%;
	cursor: pointer;
}

.text {
	color: #333;
	font-size: 20px;
	position: absolute;
	top: 50%;
	left: 50%;
	-webkit-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	text-align: center;
}
');

$urlSaveImage = Yii::app()->createAbsoluteUrl("/yiilab/image/SaveImage");
$script = <<< JS

$(document).ready(function(){
	var modal = $('#modal');
	var image = document.getElementById('sample_image');
	var cropper;
	$('#upload_image').change(function(event){
		var files = event.target.files;
		var done = function(url){
			image.src = url;
			modal.modal('show');
		};
		if(files && files.length > 0){
			reader = new FileReader();
			reader.onload = function(event){
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
 		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				var data = {"image":base64data};
				var url = "$urlSaveImage";
				Ajax.call(data, url, function(resp1){
			    if(resp1.result == 1){
						$("#temporary_name").val(resp1.message);
			    }
				});
				modal.modal('hide');
				$('#uploaded_image').attr('src', base64data);

			};
		});
	});

});

JS;
Yii::app()->clientScript->registerScript('ewqe2e23e23', $script, CClientScript::POS_END);

/**
EOF
*/
