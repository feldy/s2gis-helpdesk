var EvtIssue = {
    onChangeAttachmentAction: function () {
        CWIssue.readUrl(this);
    }
};
//CW = Custom Widget
var CWIssue = {
    createFilteringSelect: function () {
        var URL = parsingURL('get-form-api');
        $('.cmb-form').select2({
            language: "id",
            required: true,
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
        if (input.files) {
            $(input).css('display', 'none');
            var element = $('<input>').attr({type: 'file', multiple: '', name: 'attachment[]', accept: "image/*"});
                element.appendTo('.btn-attachment');
                element.change(EvtIssue.onChangeAttachmentAction);
            // console.log('input', input.files);

            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // console.log('>>> pilih gambar', e.target.result);
                    // $('#img-preview').attr('src', e.target.result);
                    $("#file-preview").append('' +
                        '<li class="btn-preview-image">' +
                            '<span class="mailbox-attachment-icon has-img">' +
                                '<img onclick="showModalDialogSSG(this)" class="imgUpload" width="198px" src="'+e.target.result+'">' +
                            '</span>' +
                        '</li>');
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
};
var Issue = {
    startup: function () {
        //binding widget
        CWIssue.createFilteringSelect();
        $("#attachment").change(EvtIssue.onChangeAttachmentAction);

    }
};

// Jquery ready
$(function () {
    Issue.startup();
});