$(function () {
    //datepicker
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd',maxDate: new Date()});

    //company-symbol dropdown
    var $dropdown = $("#company_symbol");
    if (localStorage.getItem("data")) {
        $.each(JSON.parse(localStorage.getItem("data")), function (index, data) {
            $dropdown.append($("<option />").val(data.symbol).text(data.company_name));
        });
    } else {
        var data = [];
        $.ajax({
            "url": url + "/get-company-symbol",
            method: "GET",
            dataType: 'json'
        }).done(function (results) {
            $.each(results, function (index, result) {
                data.push({"symbol": result.Symbol, 'company_name': result["Company Name"]});
                $dropdown.append($("<option />").val(result.Symbol).text(result["Company Name"]));
            });
            localStorage.setItem("data", JSON.stringify(data));
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
        });
    }

    //company-form validation
    $("#company-form").validate({
        rules: {
            company_symbol: {
                required: true,
                lettersonly:true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
                greaterThanEqualTo: "#start_date"
            },
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            company_symbol: {
                "required":"The company symbol field is required.",
                "lettersonly":"The company symbol must only contain letters."
            },
            start_date:"The start date field is required",
            end_date:{
                "required":"The end date field is required"
            },
            email:{
                "required": "The email field is required",
                "email":"The email must be a valid email address"
            }
        },
        submitHandler: function(form) {
            $("#btn-submit").attr("disabled",true);
            var action = $('#company-form').attr("action");
            var companyName = $("#company_symbol :selected").text();
            var symbol = $("#company_symbol :selected").val();
            var startDate = $("#start_date").val();
            var endDate = $("#end_date").val();
            var email = $("#email").val();
            $.ajax({
                url: action,
                method: "GET",
                data: {
                    'company_symbol':symbol,
                    'company_name':companyName,
                    'start_date':startDate,
                    'end_date':endDate,
                    'email':email,
                },
                dataType: 'json',
                beforeSend: function () {
                    resetFormState('Loading...')
                }
            }).done(function (response) {
                if (typeof response.prices != 'undefined') {
                    $("#historical-data").html("");
                    if (response.prices.length) {
                        $.each(response.prices, function (i, item) {
                            var $tr = $('<tr>').append(
                                $('<td>').text(unixToDatetime(item.date)),
                                $('<td>').text(formatPrice(item.open)),
                                $('<td>').text(formatPrice(item.high)),
                                $('<td>').text(formatPrice(item.low)),
                                $('<td>').text(formatPrice(item.close)),
                                $('<td>').text(item.volume)
                            );
                            $tr.appendTo("#historical-data");
                        });
                        drawChart(companyName, response.prices)
                    } else {
                        resetFormState()
                    }
                }
                $("#btn-submit").attr("disabled",false);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
                resetFormState()
                $("#btn-submit").attr("disabled",false);
            });
        }
    });

    $('#btn-reset').click(function (){
        $('#company-form').find('label').remove();
        $('#company-form').find('input,select').val("");
        resetFormState()
    });
});

