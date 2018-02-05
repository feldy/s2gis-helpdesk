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
});