function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            imgId = '#preview-' + $(input).attr('id');
            $(imgId).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("form#mainform input[type='file']").change(function() {
    readURL(this);
});