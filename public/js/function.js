function unixToDatetime(unixtimestamp) {
    // Convert timestamp to milliseconds
    var date = new Date(unixtimestamp * 1000);
    // Year
    var year = date.getFullYear();
    // Month
    var month = '' + (date.getMonth() + 1);
    // Day
    var day = '' + date.getDate();

    if (month < 10)
        month = '0' + month;
    if (day < 10)
        day = '0' + day;
    // Display date time in yyyy-mm-dd format
    return year + '-' + month + '-' + day;
}

function formatPrice(price, len = 2) {
    return price != "" ? parseFloat(price, 10).toFixed(len) : ""
}

function drawChart(companyName, data) {
    var dps1 = [], dps2 = [];
    var stockChart = new CanvasJS.StockChart("chart-container", {
        theme: "light2",
        exportEnabled: true,
        title: {
            text: "StockChart with Date Axis"
        },
        subtitles: [{
            text: companyName + "Stock Price (in USD)"
        }],
        charts: [{
            axisX: {
                crosshair: {
                    enabled: false,
                    snapToDataPoint: false
                }
            },
            axisY: {
                prefix: "$"
            },
            data: [{
                type: "candlestick",
                yValueFormatString: "$#,###.##",
                dataPoints: dps1
            }]
        }],
        navigator: {
            data: [{
                dataPoints: dps2
            }]
        }
    });
    $.each(data, function (i, item) {
        dps1.push({
            x: new Date(unixToDatetime(item.date)),
            y: [Number(item.open), Number(item.high), Number(item.low), Number(item.close)]
        });
        dps2.push({x: new Date(unixToDatetime(item.date)), y: Number(item.close)});
    });
    stockChart.render();
}

function resetFormState(message = 'No Record found.') {
    $("#historical-data").html("");
    $("#chart-container").html("");
    var $tr = $('<tr>').append(
        $('<td colspan="6" class="text-center text-bold">').html(message)
    );
    $tr.appendTo("#historical-data");
}
