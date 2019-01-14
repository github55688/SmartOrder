var today = new Date()
var nowY = new Array()
var nowM = new Array()
nowY[0] = today.getFullYear()
nowM[0] = today.getMonth()

for (i = 0; i < 6; i++) {
    if (nowM[i] == 0) {
        nowM[i + 1] = 11
        nowY[i + 1] = nowY[i] - 1
    }
    else {
        nowM[i + 1] = nowM[i] - 1
        nowY[i + 1] = nowY[i]
    }
    //console.log(nowM[i])
}
var LineNum = new Array();
for (i = 1; i < 6; i++) {
    LineNum[i - 1] = ((Monthly[i] / Monthly[i - 1] - 1) * 100).toFixed(2)
}
LineNum[5] = ((Monthly[0] / Monthly[6] - 1) * 100).toFixed(2)
//直條圖
var data_1 = [
    //-5,-4
    [getdata(nowY[5], nowM[5], 1), Monthly[0]], [getdata(nowY[4], nowM[4], 1), Monthly[1]],
    //-3,-2
    [getdata(nowY[3], nowM[3], 1), Monthly[2]], [getdata(nowY[2], nowM[2], 1), Monthly[3]],
    //-1,now
    [getdata(nowY[1], nowM[1], 1), Monthly[4]], [getdata(nowY[0], nowM[0], 2), Monthly[5]],
]
//折線圖
var data_2 = [
    //-5,-4
    [getdata(nowY[5], nowM[5], 1), LineNum[5]], [getdata(nowY[4], nowM[4], 1), LineNum[0]],
    //-6,-2
    [getdata(nowY[3], nowM[3], 1), LineNum[1]], [getdata(nowY[2], nowM[2], 1), LineNum[2]],
    //-1,now
    [getdata(nowY[1], nowM[1], 1), LineNum[3]], [getdata(nowY[0], nowM[0], 2), LineNum[4]],
]
function getdata(year, month, day) {
    return new Date(year, month, day).getTime();
}

var dataset = [
    {
        label: "月營收",
        data: data_1,
        color: "blue",
        bars: {
            show: true,
            align: "center",
            barWidth: 900000000,
        }
    },
    {
        label: "月增率",
        data: data_2,
        yaxis: 2,
        color: "red",
        points: { symbol: "circle", fillColor: "red", show: true },
        lines: {
            show: true
        }
    }
];

var options = {
    xaxis: {
        mode: "time",
        timeformat: "%Y-%m",
        tickSize: [1, "month"],
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 14,
        axisLabelPadding: 15
    },
    yaxes: [
        {
            position: "left",
            max: 200000,
            //axisLabel: "",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3
        },
        {
            position: "right",
            //axisLabel: "",
            axisLabel: "(%)",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3
        }
    ],
    legend: {
        noColumns: 0,
        labelBoxBorderColor: "#000000",
        position: "nw"
    },
    grid: {
        hoverable: true,
        borderWidth: 3,
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
    }

};

var previousPoint = null, previousLabel = null, table_id

$.fn.UseTooltip = function () {
    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];
                var color = item.series.color;
                var month = new Date(x);
                var months = "Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec".split(",");

                if (item.series.label == "月營收")
                    unit = "元";
                else if (item.series.label == "月增率")
                    unit = "%";

                showTooltip(item.pageX, item.pageY, color,
                    months[month.getMonth()] + ":<strong> " + y + "</strong>" + unit + "");

                table_id = month.getMonth()
                console.log(table_id);
                $("#tr_num" + table_id).addClass("enter");

            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
            $("#tr_num" + table_id).removeClass("enter");
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
    $.plot($("#flot-placeholder"), dataset, options);
    $("#flot-placeholder").UseTooltip();

    for (i = 0; i < 12; i++) {
        nowM[i]++
        if (nowM[i] < 10) {
            nowM[i] = "0" + nowM[i]
        }
    }
    var table = "<table id='table'>";
    table += "<th width=170px>月別</th><th width=110px>營業收入</th><th width=90px>總訂單數</th>"
    table += "<th width=140px>熱銷1</th><th width=140px>熱銷2</th>"
    var myArray = [
        [nowY[0] + "/" + nowM[0], Monthly[5], Monthly_num[5], popular_month[5][0], popular_month[5][1]],
        [nowY[1] + "/" + nowM[1], Monthly[4], Monthly_num[4], popular_month[4][0], popular_month[4][1]],
        [nowY[2] + "/" + nowM[2], Monthly[3], Monthly_num[3], popular_month[3][0], popular_month[3][1]],
        [nowY[3] + "/" + nowM[3], Monthly[2], Monthly_num[2], popular_month[2][0], popular_month[2][1]],
        [nowY[4] + "/" + nowM[4], Monthly[1], Monthly_num[1], popular_month[1][0], popular_month[1][1]],
        [nowY[5] + "/" + nowM[5], Monthly[0], Monthly_num[0], popular_month[0][0], popular_month[0][1]],
    ];
    var nowM2 = new Array()
    nowM2[0] = today.getMonth()
    for (i = 0; i < 6; i++) {
        if (nowM2[i] == 0)
            nowM2[i + 1] = 11
        else
            nowM2[i + 1] = nowM2[i] - 1
    }
    for (var i = 0; i < myArray.length; i++) {
        table += "<tr id=tr_num" + nowM2[i] + ">"
        for (var j = 0; j < myArray[i].length; j++) {
            table += "<td>" + myArray[i][j] + "</td>";
        }
        table += "</tr>"
    }
    table += "</table>"
    document.getElementById("table").innerHTML = table;

    /* $("#table tr").hover(
         function () {
             $(this).addClass("enter")
         },
         function () {
             $(this).removeClass("enter")
         }
     )*/
});