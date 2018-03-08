var EvtIssue = {

};
//CW = Custom Widget
var CWIssue = {
    createFilteringSelect: function () {
        var URL = parsingURL('get-form-api');
        $('.cmb-form').select2({
            language: "id",
            theme: "bootstrap",
            minimumInputLength: 2,
            ajax: {
                url: URL,
                dataType: 'json',
                type: "GET",
                delay: 500,
                placeholder: 'Pencarian Form',
                data: function (params) {
                    return {value: params.term};
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.form_name,
                                id: item.form_id
                            }
                        })
                    };
                }
            }
        });
    },
    readUrl: function (input) {
        // console.log('input', input.files);
        if (input.files) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    console.log('>>> pilih gambar', e.target.result);
                    // $('#img-preview').attr('src', e.target.result);
                    $("#file-preview").append('<li class="btn-preview-image"><span class="mailbox-attachment-icon has-img"><img class="btn-preview-image" width="198px" src="'+e.target.result+'"></span></li>');
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
        // if (input.files && input.files[0]) {
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //         console.log('>>> pilih gambar', e.target.result);
        //         // $('#img-preview').attr('src', e.target.result);
        //     };
        //
        //     reader.readAsDataURL(input.files[0]);
        // }
    }
};
var Issue = {
    startup: function () {
        //binding widget
        CWIssue.createFilteringSelect();
        $("#attachment").change(function(){
            CWIssue.readUrl(this);
        });
    }
};

// Jquery ready
$(function () {
    Issue.startup();
});