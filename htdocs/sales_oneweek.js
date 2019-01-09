//當周營收
//document.write(date_last3_week);
var data_bar2_1 = [[0, Weekly[0]], [1, Weekly[1]], [2, Weekly[2]], [3, Weekly[3]], [4, Weekly[4]], [5, Weekly[5]], [6, Weekly[6]]];
var data_bar2_2 = [[0, Weekly1[0]], [1, Weekly1[1]], [2, Weekly1[2]], [3, Weekly1[3]], [4, Weekly1[4]], [5, Weekly1[5]], [6, Weekly1[6]]];
var data_bar2_3 = [[0, Weekly2[0]], [1, Weekly2[1]], [2, Weekly2[2]], [3, Weekly2[3]], [4, Weekly2[4]], [5, Weekly2[5]], [6, Weekly2[6]]];
var data_bar2_4 = [[0, Weekly3[0]], [1, Weekly3[1]], [2, Weekly3[2]], [3, Weekly3[3]], [4, Weekly3[4]], [5, Weekly3[5]], [6, Weekly3[6]]];
var dataset_bar2_1 = [{ label: "營收", data: data_bar2_1, color: "#B22222" }];
var dataset_bar2_2 = [{ label: "營收", data: data_bar2_2, color: "#B22222" }];
var dataset_bar2_3 = [{ label: "營收", data: data_bar2_3, color: "#B22222" }];
var dataset_bar2_4 = [{ label: "營收", data: data_bar2_4, color: "#B22222" }];
var ticks_bar2 = [[0, "Sun"], [1, "Mon"], [2, "Tue"], [3, "Wed"], [4, "Thu"], [5, "Fri"], [6, "Sat"]];

var options_bar2 = {
    series: {
        bars: {
            show: true
        }
    },
    bars: {
        align: "center",
        barWidth: 0.5,

    },
    xaxis: {
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 16,
        axisLabelPadding: 15,
        ticks: ticks_bar2,
        autoscaleMargin: .02
    },
    grid: {
        hoverable: true,
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
        mouseActiveRadius: 30
    }
}

$(document).ready(function () {
    $.plot($("#flot-placeholder2"), dataset_bar2_1, options_bar2);
    $("#flot-placeholder2").UseTooltip2();
    document.getElementById('now_week_display').innerHTML = date_this_week[0] + ' ~ ' + date_this_week[6];
});

function zero() {
    $.plot($("#flot-placeholder2"), dataset_bar2_1, options_bar2);
    $("#flot-placeholder2").UseTooltip2();
    document.getElementById('now_week_display').innerHTML = date_this_week[0] + ' ~ ' + date_this_week[6];
}

function one() {
    $.plot($("#flot-placeholder2"), dataset_bar2_2, options_bar2);
    $("#flot-placeholder2").UseTooltip2();
    document.getElementById('now_week_display').innerHTML = date_last1_week[0] + ' ~ ' + date_last1_week[6];
}

function two() {
    $.plot($("#flot-placeholder2"), dataset_bar2_3, options_bar2);
    $("#flot-placeholder2").UseTooltip2();
    document.getElementById('now_week_display').innerHTML = date_last2_week[0] + ' ~ ' + date_last2_week[6];
}

function three() {
    $.plot($("#flot-placeholder2"), dataset_bar2_4, options_bar2);
    $("#flot-placeholder2").UseTooltip2();
    document.getElementById('now_week_display').innerHTML = date_last3_week[0] + ' ~ ' + date_last3_week[6];
}

$.fn.UseTooltip2 = function () {
    var previousPoint = null

    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];
                var color = item.series.color;
                var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]

                showTooltip2(item.pageX, item.pageY, color,
                    week[x] + ":<strong> $" + y + "</strong> ");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip2(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 25,
        left: x - 70,
        border: '2px solid ' + color,
        padding: '3px',
        'font-size': '9px',
        'border-radius': '5px',
        'background-color': '#fff',
        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}
//各週營收表格
$(document).ready(function () {
    var sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0, sum8 = 0, sum9 = 0
    for (i = 0; i < 7; i++) {
        sum1 += Weekly[i]
        sum2 += Weekly1[i]
        sum3 += Weekly2[i]
        sum4 += Weekly3[i]
        sum5 += Weekly4[i]
        sum6 += Weekly_num[i]
        sum7 += Weekly1_num[i]
        sum8 += Weekly2_num[i]
        sum9 += Weekly3_num[i]

        //console.log(sum5)
    }

    var table2 = "<table border=1 id='table2'><tr>";
    table2 += "<thead><tr><th width=150px>週別</th><th width=100px>營業收入</th><th width=100px>週增率</th><th width=80px>總訂單數</th></tr></thead>"
    var myArray2 = [
        ["本週", sum1, ((sum1 / sum2 - 1) * 100).toFixed(2) + "%", sum6],
        ["上週", sum2, ((sum2 / sum3 - 1) * 100).toFixed(2) + "%", sum7],
        ["兩週前", sum3, ((sum3 / sum4 - 1) * 100).toFixed(2) + "%", sum8],
        ["三週前", sum4, ((sum4 / sum5 - 1) * 100).toFixed(2) + "%", sum9],
    ];
    for (var i = 0; i < myArray2.length; i++) {
        table2 += "<tr>"
        for (var j = 0; j < myArray2[i].length; j++) {
            table2 += "<td align=center>" + myArray2[i][j] + "</td>";
        }
        table2 += "</tr>"
    }
    document.getElementById("table2").innerHTML = table2;
});
//每週熱銷分析