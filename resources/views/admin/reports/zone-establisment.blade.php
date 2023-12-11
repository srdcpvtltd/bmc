@extends('admin.layout.index')

@section('title')
    Dashboard/Zone/Estableshment
@endsection

@section('content')

@if($establisments)
<div class="row">

@foreach ( $establisments as $establisment )
    <div class="col-md-6 col-xl-3">

        <div class="card">
            <div class="card-body text-center card-img-top" style="background-image: url({{asset('user_asset/global_assets/images/backgrounds/panel_bg.png')}}); background-size: contain;background-color:{{$establisment->background_color ? $establisment->background_color : '#93ad65' }}">
                <div class="card-img-actions d-inline-block mb-3">
                    <img class="img-fluid rounded-circle" src="{{asset($establisment->image?$establisment->image : 'user_asset/global_assets/images/placeholders/placeholder.jpg')}}" width="170" height="170" alt="">
                    <div class="card-img-actions-overlay card-img rounded-circle">
                        <a href="{{route('admin.zone.estableshment.reports',Crypt::encrypt($establisment->id))}}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                            <i class="icon-link"></i>
                        </a>
                    </div>
                </div>

                <h6 class="font-weight-semibold mb-0">{{ $establisment->name }}</h6>
            </div>

        </div>
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
