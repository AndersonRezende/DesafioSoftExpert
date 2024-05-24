$(document).ready(function() {
    $('#formFile').change(function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(event.target.files[0]);
    });
});