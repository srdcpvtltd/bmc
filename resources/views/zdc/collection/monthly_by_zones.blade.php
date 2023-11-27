@extends('zdc.layout.index')

@section('title')
    Monthly Collection
@endsection

@section('content')

@foreach(App\Models\Zone::all() as $zone)
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row text-center">
                <div class="col-2">
                    <p><i class="icon-user icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">
                        <a href="{{route('zdc.collection.monthly',$zone->id)}}">
                        {{$zone->name}}
                        </a>
                    </h5>
                    <span class="text-muted font-size-sm">Zone Name</span>
                </div>
                <div class="col-3">
                    <p><i class="icon-cash3 icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyBilledAmount()}}</h5>
                    <span class="text-muted font-size-sm">Total Billed Amount</span>
                </div>
                <div class="col-3">
                    <p><i class="icon-cash4 icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyCollectedAmount()}}</h5>
                    <span class="text-muted font-size-sm">Total Collected Amount</span>
                </div>

                <div class="col-2">
                    <p><i class="icon-cash icon-2x d-inline-block text-warning"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyCashAmount()}}</h5>
                    <span class="text-muted font-size-sm">Cash</span>
                </div>

                <div class="col-2">
                    <p><i class="icon-credit-card icon-2x d-inline-block text-success"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyUpiAmount()}}</h5>
                    <span class="text-muted font-size-sm">UPI</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('scripts')
@endsection
