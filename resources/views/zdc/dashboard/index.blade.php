@extends('zdc.layout.index')

@section('title')
    Dashboard: {{ $user->zone->name }} Zone
@endsection

@section('content')



<div class="row">




    <div class="col-sm-6 col-xl-6">
        <a href="{{route('zdc.zone.estableshment',Crypt::encrypt($user->zone?->id))}}">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">Market & Vending Zones of {{ $user->zone->name }} Zone</h3>
                        <span class="text-uppercase font-size-xs"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-sm-6 col-xl-6">
        <a href="{{route('zdc.report.establisments',Crypt::encrypt($user->zone?->id))}}">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">Total Establishments of {{ $user->zone->name }} Zone</h3>
                       <span class="text-uppercase font-size-xs"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>
<div class="row">
    <div class="col-sm-6 col-xl-6">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-pointer icon-3x text-success-400"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">
                        {{App\Models\Payment::whereDate('created_at',Carbon\Carbon::yesterday())->where('type','daily')->sum('amount')}}
                    </h3>
                    <span class="text-uppercase font-size-sm text-muted">Yesterday Daily Collection</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-6">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-enter6 icon-3x text-indigo-400"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">
                        {{App\Models\Payment::where('month',Carbon\Carbon::now()->format('F'))->where('type','monthly')->where('is_paid',1)->sum('amount')}}
                    </h3>
                    <span class="text-uppercase font-size-sm text-muted">Monthly Collection</span>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            {{-- <div class="text-center" style="padding: 10px"> --}}
                <canvas id="pie-chart" width="500" height="500"></canvas>
            {{-- </div> --}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            {{-- <div class="text-center" style="padding: 10px"> --}}
                <canvas id="withdraw-chart" width="500" height="500"></canvas>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ url('chart/Chart.min.js') }}"></script>
    <script>
        new Chart(document.getElementById("pie-chart"), {

            type: 'pie',

            data: {
                labels: [{!! @$data['labels'] !!}],
                datasets: [{

                    label: "Establishment Wise Payment Collection for Current Month",
                    backgroundColor: ["#FF5733", "#FFC300", "#DAF7A6", "#7D3C98", "#001f3f", "#2ECC40", "#FF4136", "#FF851B", "#3D9970", "#FFDC00",
                            "#39CCCC", "#B10DC9", "#01FF70", "#7FDBFF", "#0074D9", "#01FF70", "#FFDC00", "#F012BE", "#0074D9", "#B10DC9",
                            "#FF4136", "#FF851B", "#FFC300", "#001f3f", "#7FDBFF", "#3D9970", "#FF851B", "#FFDC00", "#FF4136", "#7FDBFF",
                            "#0074D9", "#F012BE", "#2ECC40", "#FF4136", "#0074D9", "#FF851B", "#FFDC00", "#B10DC9", "#FF4136", "#7FDBFF",
                            "#FF851B", "#39CCCC", "#0074D9", "#FF4136", "#FF851B", "#FFC300", "#01FF70", "#0074D9", "#FF4136", "#FF851B"],
                    data: [{!! @$data['payments_for_month'] !!}],

                }]
            },

            options: {

                responsive: true,
                title: {

                    display: true,
                    text: "{{ @$data['monthly_chart_title'] }}"
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return tooltipItem[0].xLabel;
                        },
                        label: function(dataItems, data) {
                            var category = data.labels[dataItems.index];
                            var value = data.datasets[0].data[dataItems.index];


                            return ' ' + category + ': ' +value;
                        }
                    }
                }
            }
        });
    </script>
    <script>

        new Chart(document.getElementById("withdraw-chart"), {

            type: 'pie',

            data: {

                labels: ['Today Payment'],

                datasets: [{

                    label: "Zone Wise Collection Of Current Day ",

                    backgroundColor: ["#ABB2B9","#7FB3D5","#C39BD3", "#EC7063", "#3366cc","#33C4FF","#0C3343"],

                    data: [{!! @$data['payments_for_current_date'] !!}],

                }]
            },

            options: {

                responsive: true,
                title: {

                    display: true,

                    text: 'Daily Collection Today (Daily Collection of {{@$user->zone->name}})'
                },
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return tooltipItem[0].xLabel;
                        },
                        label: function(dataItems, data) {
                            console.log(dataItems,data);
                            var category = data.labels[dataItems.index];
                            var value = data.datasets[0].data[dataItems.index];


                            return ' ' + category + ': ' +value;
                        }
                    }
                }
            }
        });
    </script>
@endsection