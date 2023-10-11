@extends('zdc.layout.index')

@section('title')
    Dashboard/Zone/Estableshment
@endsection

@section('content')

@if($establisments)
<div class="row">

@foreach ( $establisments as $establisment )
    <div class="col-sm-6 col-xl-6">
        <a href="{{route('zdc.zone.estableshment.reports',Crypt::encrypt($establisment->id))}}">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{ $establisment->name }}</h3>
                        <span class="text-uppercase font-size-xs"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>



@endforeach
</div>

@endif


@endsection
@section('scripts')
    <script src="{{ url('chart/Chart.min.js') }}"></script>
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

                    text: 'Zone Wise Payment Colection For Current Month (Unregistered Vendors)'
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
