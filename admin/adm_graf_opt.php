<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grafik Operator</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="operatorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('operatorChart').getContext('2d');
    var operatorChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Operator 1', 'Operator 2', 'Operator 3', 'Operator 4', 'Operator 5'],
            datasets: [{
                label: 'Jumlah Pesanan Ditangani',
                data: [120, 150, 180, 90, 200],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pesanan'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Operator'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Kinerja Operator Berdasarkan Jumlah Pesanan Ditangani'
                },
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
