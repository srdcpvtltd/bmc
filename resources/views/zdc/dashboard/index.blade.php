@extends('zdc.layout.index')

@section('title')
    Dashboard: {{ $user->zone->name }} Zone, Bhubaneswar Municipal Corporation
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
                    <h3 class="mb-0">Market & Vending Zones of {{ $user->zone->name }}</h3>
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
                    <h3 class="mb-0">Total Establishments of {{ $user->zone->name }}</h3>
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
                        {{App\Models\Payment::whereDate('created_at',Carbon\Carbon::yesterday())->sum('amount')}}
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
                        {{App\Models\QrCodePayment::whereBetween('payment_created_at',[Carbon\Carbon::now()->startOfMonth(),Carbon\Carbon::now()])->sum('amount')}}
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
@endsection
