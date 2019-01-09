var today = new Date()
var nowY = new Array()
var nowM = new Array()
nowY[0] = today.getFullYear()
nowM[0] = today.getMonth()
for (i = 0; i < 12; i++) {
    if (nowM[i] == 0) {
        nowM[i + 1] = 11
        nowY[i + 1] = nowY[i] - 1
    }
    else {
        nowM[i + 1] = nowM[i] - 1
        nowY[i + 1] = nowY[i]
    }
}
//document.write(Monthly_num)
//console.log("1123");
var data_bar1 = [
    //12,11
    [getdata(nowY[11], nowM[11], 1), Monthly[0]], [getdata(nowY[10], nowM[10], 1), Monthly[1]],
    //10,9
    [getdata(nowY[9], nowM[9], 1), Monthly[2]], [getdata(nowY[8], nowM[8], 1), Monthly[3]],
    //8,7
    [getdata(nowY[7], nowM[7], 1), Monthly[4]], [getdata(nowY[6], nowM[6], 1), Monthly[5]],
    //6,5
    [getdata(nowY[5], nowM[5], 1), Monthly[6]], [getdata(nowY[4], nowM[4], 1), Monthly[7]],
    //4,3
    [getdata(nowY[3], nowM[3], 1), Monthly[8]], [getdata(nowY[2], nowM[2], 1), Monthly[9]],
    //2,1
    [getdata(nowY[1], nowM[1], 1), Monthly[10]], [getdata(nowY[0], nowM[0], 2), Monthly[11]],
]
function getdata(year, month, day) {
    return new Date(year, month, day).getTime();
}

var dataset_bar1 = [
    {
        label: "月營收",
        data: data_bar1,
        color: "blue"
    }
];

var options_bar1 = {
    series: {
        bars: {
            show: true,
        },
    },
    bars: {
        align: "center",
        barWidth: 1700000000,
    },
    xaxis: {
        mode: "time",
        timeformat: "%Y-%m",
        tickSize: [1, "month"],
        //axisLabel: "月營收",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 14,
        axisLabelPadding: 15
    },
    grid: {
        hoverable: true,
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
    }

};

$(document).ready(function () {
    $.plot($("#flot-placeholder"), dataset_bar1, options_bar1);
    $("#flot-placeholder").UseTooltip();
});

$.fn.UseTooltip = function () {
    var previousPoint = null

    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];
                var color = item.series.color;
                var month = new Date(x);
                var months = "Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec".split(",");

                showTooltip(item.pageX, item.pageY, color,

                    months[month.getMonth()] + ":<strong> $" + y + "</strong> ");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
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
//月營收表格
$(document).ready(function () {
    for (i = 0; i < 12; i++) {
        nowM[i]++
        if (nowM[i] < 10) {
            nowM[i] = "0" + nowM[i]
        }
    }
    var table1 = "<table border=1 id='table1'><tr>";
    table1 += "<thead><tr><th width=150px>月別</th><th width=100px>營業收入</th><th width=100px>月增率</th><th width=80px>總訂單數</th>"
    table1 += "<th width=120px>熱銷1</th><th width=120px>熱銷2</th></tr></thead>"
    var myArray = [
        [nowY[0] + "/" + nowM[0], Monthly[11], ((Monthly[11] / Monthly[10] - 1) * 100).toFixed(2) + "%", Monthly_num[11], popular_month[11][0], popular_month[11][1]],
        [nowY[1] + "/" + nowM[1], Monthly[10], ((Monthly[10] / Monthly[9] - 1) * 100).toFixed(2) + "%", Monthly_num[10], popular_month[10][0], popular_month[10][1]],
        [nowY[2] + "/" + nowM[2], Monthly[9], ((Monthly[9] / Monthly[8] - 1) * 100).toFixed(2) + "%", Monthly_num[9], popular_month[9][0], popular_month[9][1]],
        [nowY[3] + "/" + nowM[3], Monthly[8], ((Monthly[8] / Monthly[7] - 1) * 100).toFixed(2) + "%", Monthly_num[8], popular_month[8][0], popular_month[8][1]],
        [nowY[4] + "/" + nowM[4], Monthly[7], ((Monthly[7] / Monthly[6] - 1) * 100).toFixed(2) + "%", Monthly_num[7], popular_month[7][0], popular_month[7][1]],
        [nowY[5] + "/" + nowM[5], Monthly[6], ((Monthly[6] / Monthly[5] - 1) * 100).toFixed(2) + "%", Monthly_num[6], popular_month[6][0], popular_month[6][1]],
        [nowY[6] + "/" + nowM[6], Monthly[5], ((Monthly[5] / Monthly[4] - 1) * 100).toFixed(2) + "%", Monthly_num[5], popular_month[5][0], popular_month[5][1]],
        [nowY[7] + "/" + nowM[7], Monthly[4], ((Monthly[4] / Monthly[3] - 1) * 100).toFixed(2) + "%", Monthly_num[4], popular_month[4][0], popular_month[4][1]],
        [nowY[8] + "/" + nowM[8], Monthly[3], ((Monthly[3] / Monthly[2] - 1) * 100).toFixed(2) + "%", Monthly_num[3], popular_month[3][0], popular_month[3][1]],
        [nowY[9] + "/" + nowM[9], Monthly[2], ((Monthly[2] / Monthly[1] - 1) * 100).toFixed(2) + "%", Monthly_num[2], popular_month[2][0], popular_month[2][1]],
        [nowY[10] + "/" + nowM[10], Monthly[1], ((Monthly[1] / Monthly[0] - 1) * 100).toFixed(2) + "%", Monthly_num[1], popular_month[1][0], popular_month[1][1]],
        [nowY[11] + "/" + nowM[11], Monthly[0], ((Monthly[0] / Monthly[12] - 1) * 100).toFixed(2) + "%", Monthly_num[0], popular_month[0][0], popular_month[0][1]],
    ];
    for (var i = 0; i < myArray.length; i++) {
        table1 += "<tr>"
        for (var j = 0; j < myArray[i].length; j++) {
            table1 += "<td align=center>" + myArray[i][j] + "</td>";
        }
        table1 += "</tr>"
    }
    document.getElementById("table1").innerHTML = table1;
});

//月熱銷
//document.write(popular_month);