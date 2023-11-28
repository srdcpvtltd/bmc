@extends('admin.layout.index')

@section('title')
    Daily Collection
@endsection

@section('content')
<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title">Search Payment By Date</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body"> 
        <form class="form-inline" method="GET">
            <div class="form-group">
                <label>Date</label>
                <input type="date" value="{{$date}}" name="date" class="form-control ml-2">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>
    </div>
</div>
@foreach(App\Models\Zone::all() as $zone)
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row text-center">
                <div class="col-3">
                    <p><i class="icon-user icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">
                        <a href="{{route('admin.collection.daily_by_zone',$zone->id)}}">
                        {{-- <a href="{{route('admin.collection.show_daily',$zone->id)}}"> --}}
                            {{$zone->name}}
                        </a>
                    </h5>
                    <span class="text-muted font-size-sm">Zone Name</span>
                </div>
                <div class="col-3">
                    <p><i class="icon-cash4 icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getDailyCollectedAmount($date)}}</h5>
                    <span class="text-muted font-size-sm">Total Collected Amount</span>
                </div>

                <div class="col-3">
                    <p><i class="icon-cash icon-2x d-inline-block text-warning"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getDailyCashAmount($date)}}</h5>
                    <span class="text-muted font-size-sm">Cash</span>
                </div>

                <div class="col-3">
                    <p><i class="icon-credit-card icon-2x d-inline-block text-success"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getDailyUpiAmount($date)}}</h5>
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
