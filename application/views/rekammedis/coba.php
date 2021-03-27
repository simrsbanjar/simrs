<body>
    <canvas width="800" height="330" id="clinic-bar-chart"></canvas>

    <script>
        var cuk = $("#clinic-bar-chart");
        var data = {
            labels: ["2004", "2014", "2004", "2014", "2004", "2014", "2004", "2014"],
            datasets: [{
                backgroundColor: ['#DD608D', '#D53871', '#F8DC92', '#F3C549', '#33A976', '#009454', '#8ED6D5', '#45C0BE'],
                borderWidth: 1,
                data: [10.9, 4.0, 24.6, 30, 26.1, 14.7, 11.9, 7.3],
            }]
        };
        var options = {
            events: false,
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            animation: {
                onComplete: function() {
                    var ctx = this.chart.ctx;
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    var chart = this;
                    var datasets = this.config.data.datasets;

                    datasets.forEach(function(dataset, i) {
                        ctx.font = "24px Lobster Two";
                        ctx.fillStyle = "#4F4C4D";
                        chart.getDatasetMeta(i).data.forEach(function(p, j) {
                            ctx.fillText(datasets[i].data[j], p._model.x, p._model.y - 20);
                        });
                    });
                }
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.6,
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        var myBarChart = new Chart(cuk, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
</body>