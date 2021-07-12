<br/><br/>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
axios.get('<?php echo Yii::app()->createAbsoluteUrl("test/testaxios");?>')
  .then(function (response) {
    // handle success
    console.log(response);
    alert(response.status);
    alert(response.data.message);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .finally(function () {
    // always executed
  });

</script>

f23fd23
