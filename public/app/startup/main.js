//jqueryByID
JQByID = function (id) {
    return $("#"+id);
}

//format date to server
formatDateServer = function (date) {
    if (date) {
        return moment(date).format("YYYY-MM-DD");
    }

    return null;
}

showModalDialogSSG = function () {
    
}

// Jquery ready
$(function () {
    //Date picker
    $('.datepicker').datepicker({autoclose: true, format: "dd/mm/yyyy"});
    $('.datepickermonth').datepicker({autoclose: true, minViewMode: 1, format: "mm/yyyy"});
    $(".numberOnly").on('keypress', function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
        return true;
    });


    $('.btn-preview-image').on('click', function() {
        console.log('>>>>>>>>>>...');
        // console.log('>>', $(this).attr('src'));
        var src = $(this).attr('src'); //string

        //cek apakah berbentuk array atau tidak
        var obj = src;
        try {
            obj = jQuery.parseJSON(src);
        } catch (error) {}
        // console.log('obj >> ', obj);
        $("#img_items_previews").empty();
        $('#img_items_previews').css('display', 'none');
        $('#imagepreview').css('display', 'none');
        if (obj && typeof obj == "object") {
            $('#img_items_previews').css('display', 'inline-block');
            for(var i = (obj.length-1); i >= 0; i--) {
                var file = obj[i];
                $('#img_items_previews').prepend('<img class="img-responsive" src="'+(getURLAsset() + file)+'?dummy=371662" />');
            }
            $('#imagemodal').modal('show');
        } else if (src && src.length > 0) {
            $('#imagepreview').css('display', 'inline-block');
            $('#imagepreview').attr('src', getURLAsset() + src + '?dummy=371662');
            $('#imagemodal').modal('show');
        } else {
            alert('File tidak ditemukan.')
        }
    });
});