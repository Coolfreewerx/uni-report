@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <br><br><br><br>
        <h1 class="text-3xl mx-4 mt-6">
            สถิติการร้องเรียนทั้งหมด
        </h1>

{{--        <div class="row">--}}
{{--            <div class="col-xl-6">--}}
{{--                <div class="card mb-4">--}}
{{--                    <div class="card-header">--}}
{{--                        <i class="fas fa-chart-area me-1"></i>--}}
{{--                        Area Chart Example--}}
{{--                    </div>--}}
{{--                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="50%" height="20"></canvas></div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($days) !!}');
        var _xdata=JSON.parse('{!! json_encode($dayCount) !!}');

        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: _ydata,
                datasets: [{
                    label: "Registration",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: _xdata,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 10,
                            maxTicksLimit: 10
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

    </script>
    <script src="{{asset('public')}}/assets/demo/chart-area-demo.js"></script>
    <script src="{{asset('public')}}/assets/demo/chart-bar-demo.js"></script>
@endsection

