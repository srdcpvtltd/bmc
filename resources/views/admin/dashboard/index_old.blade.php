@extends('admin.layout.index')

@section('title')
    Dashboard
@endsection

@section('content')



<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body has-bg-image text-center" style="background-color:#50cc50;color:black;">
            <p><b>Establishment {{App\Models\Establishment::count()}}</b></p>
            {{-- <div class="media mb-3">

                <div class="media-body">
                    <p class="font-weight-semibold mb-0">Establishments</p>
                    <span class="opacity-100">{{App\Models\Establishment::count()}}</span>
                </div>
                <div class="ml-3 align-self-center">
                    <i class="icon-quill4 icon-2x"></i>
                </div>
            </div> --}}

            {{-- <div class="progress bg-success mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-white" style="width: 90%">
                </div>
            </div> --}}
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body has-bg-image" style="background-color:#99CCFF;">
            <div class="media mb-3">
                <div class="media-body">
                    <h7 class="font-weight-semibold mb-0">Pending Amount</h7>
                    <span class="opacity-100">{{App\Models\Payment::where('type','monthly')->where('is_paid',0)->sum('amount')}}</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-cash3 icon-2x"></i>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;background-color:#4caf50;">
                <div class="progress-bar bg-white" style="width: 90%">
                    {{-- <span class="sr-only">90% Complete</span> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body has-bg-image" style="background-color:#CCCC66;">
            <div class="media mb-3">

                <div class="media-body">
                    <h7 class="font-weight-semibold mb-0">Zones</h7>
                    <span class="opacity-100">{{App\Models\Zone::count()}}</span>
                </div>
                <div class="ml-3 align-self-center">
                    <i class="icon-lifebuoy icon-2x"></i>
                </div>
            </div>

            <div class="progress bg-success mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-white" style="width: 90%">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body has-bg-image" style="background-color:#FFCC00;">
            <div class="media mb-3">
                <div class="media-body">
                    <h7 class="font-weight-semibold mb-0">Shops</h7>
                    <span class="opacity-100">{{App\Models\Shop::count()}}</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-store2 icon-2x"></i>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;background-color:#4caf50;">
                <div class="progress-bar bg-white" style="width: 90%">
                    {{-- <span class="sr-only">90% Complete</span> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    
    {{-- <div class="col-sm-3 col-xl-3">
        <a href="{{route('admin.zone.index')}}">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\Zone::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Zones</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 col-xl-3">
        <a href="{{route('admin.ward.index')}}">
            <div class="card card-body bg-danger-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-stack-picture icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\Ward::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Wards</span>
                    </div>
                </div>
            </div>
        </a>
    </div> --}}
    <div class="col-sm-6 col-xl-6">
        <a href="{{route('admin.report.establisments')}}">
            <div class="card card-body">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{App\Models\Establishment::count()}}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Establishments Report</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-6">
        <a href="{{route('admin.report.shops')}}">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-question4 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right"> 
                        <h3 class="font-weight-semibold mb-0">{{App\Models\Shop::count()}}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Explore Market & Vending Zones of BMC</span>
                    </div>

                </div>
            </div>
        </a>
    </div>
    {{-- <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.location.index')}}">
            <div class="card card-body bg-orange-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{App\Models\Location::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Locations</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-blog icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </a>
    </div> --}}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card" style="height:300px;">
            <div class="text-center">
                <canvas id="period-billing-chart" ></canvas>
            </div>
            <div class="row" style="margin-top:10px">              
                <div class="col-md-3" style="margin-left:40px;">
                <h7 class="font-weight-semibold mb-0">Billed:</h7><span class="opacity-75">{{App\Models\Payment::where('type','monthly')->where('is_paid',0)->sum('amount')}}</span>
                </div>
                <div class="col-md-3" style="margin-left:40px;">
                <h7 class="font-weight-semibold mb-0">Paid:</h7><span class="opacity-75">{{App\Models\Payment::where('month',Carbon\Carbon::now()->format('F'))->where('type','monthly')->where('is_paid',1)->sum('amount')}}</span>
                </div>
                <div class="col-md-3" style="margin-left:40px;">
                <h7 class="font-weight-semibold mb-0">Pending:</h7><span class="opacity-75">{{App\Models\Payment::where('type','monthly')->where('is_paid',0)->sum('amount')}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:15px">               
                <div class="col-md-6" style="margin-left:40px;">
                    <div class="form-group">
                        <select id="month" class="form-control select-search" data-fouc>
                            <option value="">Select Month</option>
                            <option {{@request()->month && request()->month == 'Janaury' ? 'selected' :'' }} value='Janaury'>Janaury</option>
                            <option {{@request()->month && request()->month == 'February' ? 'selected' :'' }} value='February'>February</option>
                            <option {{@request()->month && request()->month == 'March' ? 'selected' :'' }} value='March'>March</option>
                            <option {{@request()->month && request()->month == 'April' ? 'selected' :'' }} value='April'>April</option>
                            <option {{@request()->month && request()->month == 'May' ? 'selected' :'' }} value='May'>May</option>
                            <option {{@request()->month && request()->month == 'June' ? 'selected' :'' }} value='June'>June</option>
                            <option {{@request()->month && request()->month == 'July' ? 'selected' :'' }} value='July'>July</option>
                            <option {{@request()->month && request()->month == 'August' ? 'selected' :'' }} value='August'>August</option>
                            <option {{@request()->month && request()->month == 'September' ? 'selected' :'' }} value='September'>September</option>
                            <option {{@request()->month && request()->month == 'October' ? 'selected' :'' }} value='October'>October</option>
                            <option {{@request()->month && request()->month == 'November' ? 'selected' :'' }} value='November'>November</option>
                            <option {{@request()->month && request()->month == 'December' ? 'selected' :'' }} value='December'>December</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="height:300px;">
            <div class="text-center">
                <canvas id="daily-collection-chart"></canvas>
            </div>
        </div>
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
                    <span class="text-uppercase font-size-sm text-muted">Total Monthly Collection</span>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            {{-- <div class="text-center" style="padding: 10px"> --}}
                <canvas id="pie-chart" width="300" height="300"></canvas>
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
    <script>
        $(document).ready(function(){
            
            $('#month').change(function(){
                month = this.value;
                var url = "{{url('admin/dashboard?month=')}}"+month;
                window.location.href = url;
            });
        });
    </script>

    <script src="{{ url('chart/Chart.min.js') }}"></script>
    <script>
        
        new Chart(document.getElementById("period-billing-chart"), {

            type: 'doughnut',

            data: {
                labels: ["Billed", "Paid","Pending"],
                datasets: [{

                    label: "Period Billing",
                    backgroundColor: ["#ffccff","#faf170","#bff1f5"],
                    data: [{!! @$data['payments_of_month'] !!}],
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false, // Set to false to allow custom width and height
                aspectRatio: 1.5, // Set your custom aspect ratio (width/height)
                title: {

                    display: true,

                    text: "{{@$month_text}}"
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

        new Chart(document.getElementById("daily-collection-chart"), {

            type: 'bar',

            data: {

                labels: [{!! @$data['labels'] !!}],

                datasets: [
                    {

                        label: [{!! @$data['labels'] !!}],

                        backgroundColor: ["#ffccff","#faf170","#bff1f5"],

                        data: [{!! @$data['paymentsDataForLastTwoDays'] !!}],

                    }
                ]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false, // Set to false to allow custom width and height
                aspectRatio: 1, // Set your custom aspect ratio (width/height)
                title: {

                    display: true,

                    text: 'Daily Collection'
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


                            return ' ' + category + ': ' +value;
                        }
                    }
                }
            }
        });
    </script>
    <script>
        new Chart(document.getElementById("pie-chart"), {

            type: 'pie',

            data: {
                labels: [{!! @$data['labels'] !!}],
                datasets: [{

                    label: "Zone Wise Collection Of Current Month",
                    backgroundColor: ["#990099","#109618","#ff9900", "#dc3912", "#3366cc","#33C4FF","#0C3343","#EC7063","#49BA98"],
                    data: [{!! @$data['payments_for_month'] !!}],

                }]
            },

            options: {

                responsive: true,
                title: {

                    display: true,

                    text: 'Zone Wise Payment Colection For Current Month (Registered Vendors)'
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

                labels: [{!! @$data['labels'] !!}],

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

                    text: 'Zone Wise Payment Colection For Current Date (Unregistered Vendors)'
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
