new Chart("earningChart", {
    type: "line",
    data: {
        labels: time,
        datasets: [{
            data: revenue,
            label: "Doanh thu",
            backgroundColor: '#ffdd59',
            borderColor: '#ffd32a',
            borderWidth: 3.5,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: '#ffa801',
        },]
    },
    options: {
        tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Poppins',
            bodyFontFamily: 'Poppins',
            cornerRadius: 3,
            intersect: false,
        },
        legend: {
            display: false,
            position: 'top',
            labels: {
                usePointStyle: true,
                fontFamily: 'Poppins',
            },


        },
        xAxes: [{
            display: true,
            gridLines: {
                display: false,
                drawBorder: false
            },
            scaleLabel: {
                display: false,
                labelString: 'Month'
            },
            ticks: {
                fontFamily: "Poppins"
            }
        }],
        yAxes: [{
            display: true,
            gridLines: {
                display: false,
                drawBorder: false
            },
            scaleLabel: {
                display: true,
                labelString: 'Value',
                fontFamily: "Poppins"
            },
            ticks: {
                fontFamily: "Poppins",
                min: 0
            }
        }],
        scales: {
            yAxes: [{ ticks: { min: 0 } }],
        }
    }
});
var order_status = ["Đang xử lý", "Đang vận chuyển", "Chờ nhận hàng", "Hoàn thành", "Đã hủy"];

var barColors = [
    "#34495e",
    "#3498db",
    "#f39c12",
    "#27ae60",
    "#c0392b"
];
var order = document.getElementById("orderStatus");
if (order) {
    order.height = 250;
    order.width = 250;
    new Chart(order, {
        type: "pie",
        data: {
            labels: order_status,
            datasets: [{
                backgroundColor: barColors,
                data: order_count
            }]
        },
        options: {
            title: {
                display: false,
            }
        }
    });
};

var topProduct = document.getElementById("topProduct");
if (topProduct) {

    // Tạo mảng lưu trữ nội dung đầy đủ của label
    var fullLabels = product.map(function (label) {
        return label.length > 7 ? label : null;
    });

    new Chart(topProduct, {
        type: "bar",
        data: {
            labels: product.map(function (label) {
                return label.length > 7 ? label.substring(0, 7) + '...' : label;
            }),
            datasets: [{
                data: quantity,
                label: "Đã bán",
                backgroundColor: [
                    '#7f8fa6',
                    '#8c7ae6',
                    '#00a8ff',
                    '#487eb0',
                    '#c23616',
                    '#e84118'
                ],
            },]
        },
        options: {
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Poppins',
                bodyFontFamily: 'Poppins',
                cornerRadius: 3,
                intersect: false,
                callbacks: {
                    title: function (tooltipItem, data) {
                        var index = tooltipItem[0].index;
                        var fullLabel = fullLabels[index];
                        var displayLabel = data.labels[index];
                        return fullLabel || displayLabel;
                    },
                    label: function (tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + tooltipItem.yLabel;
                    }
                }
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Poppins',
                },
            },
            xAxes: [{
                display: true,
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                },
                ticks: {
                    fontFamily: "Poppins"
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Value',
                    fontFamily: "Poppins"
                },
                ticks: {
                    fontFamily: "Poppins",
                    min: 0
                }
            }],
            scales: {
                yAxes: [{ ticks: { min: 0 } }],
            }
        }
    });
};
