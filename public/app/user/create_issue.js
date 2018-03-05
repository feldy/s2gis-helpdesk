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
    }
};
var Issue = {
    startup: function () {
        //binding widget
        CWIssue.createFilteringSelect();
    }
};

// Jquery ready
$(function () {
    Issue.startup();
});