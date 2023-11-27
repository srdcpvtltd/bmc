@extends('admin.layout.index')

@section('title')
    Dashboard
@endsection

@section('content')



<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body text-center" style="background-color:#50cc50;color:black;">
            <p><b>Establishment {{App\Models\Establishment::count()}}</b></p>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body text-center" style="background-color:#e82610;color:black;">
            <p><b>Shops {{App\Models\Shop::count()}}</b></p>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body text-center" style="background-color:#9dc9ed;color:black;">
            <p>
                <b>
                    Total Daily Collection {{App\Models\Payment::whereDate('created_at',Carbon\Carbon::yesterday())->where('type','daily')->sum('amount')}}
                </b>
            </p>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body text-center" style="background-color:#e6e229;color:black;">
            <p>
                <b>Total Monthly Collection {{App\Models\Payment::where('month',Carbon\Carbon::now()->format('F'))->where('type','monthly')->where('is_paid',1)->sum('amount')}}
                </b>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <select id="month" class="form-control select-search" data-fouc>
                <option value="">Select Month</option>
                <option {{@$month == 'Janaury' ? 'selected' :'' }} value='Janaury'>Janaury</option>
                <option {{@$month == 'February' ? 'selected' :'' }} value='February'>February</option>
                <option {{@$month == 'March' ? 'selected' :'' }} value='March'>March</option>
                <option {{@$month == 'April' ? 'selected' :'' }} value='April'>April</option>
                <option {{@$month == 'May' ? 'selected' :'' }} value='May'>May</option>
                <option {{@$month == 'June' ? 'selected' :'' }} value='June'>June</option>
                <option {{@$month == 'July' ? 'selected' :'' }} value='July'>July</option>
                <option {{@$month == 'August' ? 'selected' :'' }} value='August'>August</option>
                <option {{@$month == 'September' ? 'selected' :'' }} value='September'>September</option>
                <option {{@$month == 'October' ? 'selected' :'' }} value='October'>October</option>
                <option {{@$month == 'November' ? 'selected' :'' }} value='November'>November</option>
                <option {{@$month == 'December' ? 'selected' :'' }} value='December'>December</option>
            </select>
        </div>
        <div class="card card-body text-center">
            <canvas id="period-billing-chart" ></canvas>
        </div>
        <div class="card card-body text-center">
            <canvas id="total-collected-chart" ></canvas>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header header-elements-inline">
                <div class="form-group">
                    <select id="year" class="form-control select-search" data-fouc>
                        <option value="">Select Year</option>
                        @for($year_loop = 2022;$year_loop <= 2024;$year_loop++)
                        <option @if(@$year == $year_loop) selected @endif value="{{$year_loop}}">{{$year_loop}}</option>
                        @endfor
                     </select>
                </div>
            </div>  
            <div class="card-body">
                <canvas id="month-wise-payments-chart" height="330" ></canvas>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="text-center">
                <canvas id="daily-collection-chart"  height="300"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            {{-- <div class="text-center" style="padding: 10px"> --}}
                <canvas id="zone-wise-collection-chart" height="300"></canvas>
            {{-- </div> --}}
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            
            $('#month').change(function(){
                month = this.value;
                year = $("#year").val();
                var url = "{{url('admin/dashboard?month=')}}"+month+"&year="+year;
                window.location.href = url;
            });
            $('#year').change(function(){
                year = this.value;
                month = $("#month").val();
                var url = "{{url('admin/dashboard?year=')}}"+year+"&month="+month;
                window.location.href = url;
            });
        });
    </script>

    <script src="{{ url('chart/Chart.min.js') }}"></script>
    <script>
        // Assuming you have the Chart.js library loaded before this script

        new Chart(document.getElementById("period-billing-chart"), {
            type: 'doughnut',
            data: {
                // labels: ["Total Billed Amount"],
                datasets: [{
                    label: "Total Billed Amount",
                    backgroundColor: ["#88de7a"],
                    data: [{!! @$data['total_payments'] !!}],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 1.5,
                title: {
                    display: true,
                    text: "{{@$totalBilledAmountText}}"
                },
                circumference: Math.PI, // Set to Math.PI for a semi-circle
                rotation: -Math.PI / 1, // Rotate the chart to start from the top center
                cutoutPercentage: 80, // Adjust cutoutPercentage for the size of the hole in the middle
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return tooltipItem[0].xLabel;
                        },
                        label: function(dataItems, data) {
                            var value = data.datasets[0].data[dataItems.index];
                            return 'Total Billed Amount : '+ value;
                        }
                    }
                },

            }
        });
        new Chart(document.getElementById("total-collected-chart"), {
            type: 'doughnut',
            data: {
                // labels: ["Total Billed Amount"],
                datasets: [{
                    label: "Total Collected Amount",
                    backgroundColor: ["#d6c563"],
                    data: [{!! @$data['paid_amount'] !!}],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 1.5,
                title: {
                    display: true,
                    text: "{{@$totalCollectedAmountText}}"
                },
                circumference: Math.PI, // Set to Math.PI for a semi-circle
                rotation: -Math.PI / 1, // Rotate the chart to start from the top center
                cutoutPercentage: 80, // Adjust cutoutPercentage for the size of the hole in the middle
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return tooltipItem[0].xLabel;
                        },
                        label: function(dataItems, data) {
                            var value = data.datasets[0].data[dataItems.index];
                            return 'Total Collected Amount : '+ value;
                        }
                    }
                },

            }
        });


    </script>
    <script>

        new Chart(document.getElementById("month-wise-payments-chart"), {

            type: 'bar',

            data: {

                labels: [{!! @$data['month_wise_name'] !!}],

                datasets: [
                    {

                        label: [{!! @$data['month_wise_name'] !!}],

                        backgroundColor: ["#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9","#29b3d9"],

                        data: [{!! @$data['month_wise_paid_payments'] !!}],

                    }
                ]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false, // Set to false to allow custom width and height
                aspectRatio: 1, // Set your custom aspect ratio (width/height)
                title: {

                    display: true,

                    text: "{{@$year_text}}",
                    position: 'bottom' 
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
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


                            return ' ' +value;
                        }
                    }
                }
            }
        });
    </script>
    <script>
        new Chart(document.getElementById("daily-collection-chart"), {
            type: 'bar',
            data: {

                labels: [{!! @$data['daily_collection_dates'] !!}],

                datasets: [
                    {

                        label: [{!! @$data['daily_collection_dates'] !!}],

                        backgroundColor: [
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec",
                            "#3df2ec"],

                        data: [{!! @$data['last_15_days_daily_collection'] !!}],

                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false, // Set to false to allow custom width and height
                aspectRatio: 1, // Set your custom aspect ratio (width/height)
                title: {

                    display: true,

                    text: 'Daily Collection of Last 15 Days'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
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


                            return ' ' +value;
                        }
                    }
                }
            }
        });
    </script>
    <script>
        new Chart(document.getElementById("zone-wise-collection-chart"), {

            type: 'doughnut',

            data: {
                labels: [{!! @$data['labels'] !!}],
                datasets: [{

                    label: "Zone Wise Collection Of Current Month",
                    backgroundColor: ["#d2fc7c","#fc3f55","#29f0c8", "#d4c715", "#db91c1"],
                    data: [{!! @$data['payments_for_month'] !!}],

                }]
            },

            options: {

                responsive: true,
                title: {

                    display: true,

                    text: 'Zone Wise Payment Colection For Current Month'
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
@endsection
