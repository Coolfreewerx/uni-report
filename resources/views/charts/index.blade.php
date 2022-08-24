@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <br><br><br><br>
        <h1 class="text-3xl mx-4 mt-6">
            สถิติการร้องเรียนทั้งหมด
            <button class="app-button mx-4 mt-6 ml-3" onclick="handlePrintButton()">DOWNLOAD PDF >></button>
        </h1>
        <div class="flex flex-col mx-4 mt-6 md:flex justify-items-center" style="width: 70%; height: 70%">
            <h1 class="text-2xl mx-4 mt-6">
                สถิติปัญหาการร้องเรียน
            </h1>
            <canvas id="myBarChart" class="justify-items-center"></canvas>
        </div>

        <div class="flex flex-col mx-4 mt-6 md:flex justify-items-center" style="width: 50%; height: 50%">
            <h1 class="text-2xl mx-4 mt-6">
                สถิติสถานะการร้องเรียน
            </h1>
            <canvas id="myPieChart" class="justify-items-center"></canvas>
        </div>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($tags_name) !!}');
        var _xdata=JSON.parse('{!! json_encode($tagCount) !!}');

        var _followingData=JSON.parse('{!! json_encode($followings) !!}');
        var _followingCountdata=JSON.parse('{!! json_encode($followingCount) !!}');

        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };

        //Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: _ydata,
                datasets: [{
                    label: "posts",
                    backgroundColor: chartColors.green,
                    borderColor: chartColors.green,
                    data: _xdata,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'tags'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        var c = document.getElementById("myPieChart");
        var myChart = new Chart(c, {
            type: 'pie',
            data: {
                labels: _followingData,
                datasets: [{
                    label: "posts",
                    backgroundColor: [
                        chartColors.red,
                        chartColors.blue,
                        chartColors.yellow],
                    data: _followingCountdata,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });

        function handlePrintButton(){
            print();
        }

    </script>
    <script src="{{asset('public')}}/assets/demo/chart-area-demo.js"></script>
    <script src="{{asset('public')}}/assets/demo/chart-bar-demo.js"></script>
@endsection