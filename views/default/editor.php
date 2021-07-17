<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tiny.cloud/1/bdwoxrx2g7hjn3im2jyu7tartaz1b11yqg74js3gnfnz180x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <?php /*<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>*/?>

</head>
<body>
  <textarea id="texthere">
    Welcome to TinyMCE!
  </textarea>
  <a id="a">A</a>
  <script>
    tinymce.init({
      selector: '#texthere',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });

   $("#a").click(function(){
     alert($("#texthere").val());
   })

  </script>
</body>
</html>

