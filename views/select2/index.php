<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php /*
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
*/?>


<div>
    <h4>basic select2</h4>
    <select class="example1" name="state[]" multiple="multiple" style="width: 150px;">
    <option value="AA">AA</option>
    <option value="AB">AB</option>
    <option value="AC">AC</option>
    <option value="AD">AD</option>
    <option value="AE">AE</option>
    <option value="AF">AF</option>
    <option value="AG">AG</option>
    <option value="WH">WH</option>
    </select>
</div>


<div>
<div>
    <h4>select2 with thumbnail</h4>
    <select class="example2" name="state[]" multiple="multiple" style="width: 150px;">
    <option value="AA" data-image="http://localhost/images/01.png">AA</option>
    <option value="AB" data-image="http://localhost/images/02.png">AB</option>
    <option value="AC" data-image="http://localhost/images/03.png">AC</option>
    <option value="AD" data-image="http://localhost/images/04.png">AD</option>
    <option value="AE" data-image="http://localhost/images/05.png">AE</option>
    <option value="AF" data-image="http://localhost/images/06.png">AF</option>
    <option value="AG" data-image="http://localhost/images/07.png">AG</option>
    <option value="WH" data-image="http://localhost/images/08.png">WH</option>
    </select>
</div>

</div>

<script>
$(document).ready(function() {
    $('.example1').select2({
        placeholder: 'Select an option',
        allowClear: true,
        maximumSelectionLength: 2,
        closeOnSelect: false, // only applicable on multiple: true
        disabled: false,
        multiple: true,

    });

    $('.example2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        maximumSelectionLength: 4,
        closeOnSelect: false, // only applicable on multiple: true
        disabled: false,
        multiple: true,
        templateResult: addUserPic, // thumbnail on options
        // templateSelection: addUserPic // thumbnail on selected options

    });

    function addUserPic(opt) {
        if (!opt.id) {
            return opt.text;
        }
        var optimage = $(opt.element).data('image');
        if (!optimage) {
            return opt.text;
        } else {
            var $opt = $(
            '<span class="userName"><img src="' + optimage + '" class="userPic" style="width: 50px;"/> ' + $(opt.element).text() + '</span>'
            );
            return $opt;
        }
    };

});
</script>