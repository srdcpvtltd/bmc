@extends('zdc.layout.index')

@section('title')
    Monthly Collection
@endsection

@section('content')
<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title">Search Payment</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body"> 
        <form class="form-inline" method="GET">
            <div class="form-group col-md-3">
                <label>Month</label>
                <select name="month" id="month" class="form-control select-search" data-fouc required>
                    <option value="">Select Month</option>
                    <option {{$month == 'January' ? 'selected' : ''}} value='January'>January</option>
                    <option {{$month == 'February' ? 'selected' : ''}} value='February'>February</option>
                    <option {{$month == 'March' ? 'selected' : ''}} value='March'>March</option>
                    <option {{$month == 'April' ? 'selected' : ''}} value='April'>April</option>
                    <option {{$month == 'May' ? 'selected' : ''}} value='May'>May</option>
                    <option {{$month == 'June' ? 'selected' : ''}} value='June'>June</option>
                    <option {{$month == 'July' ? 'selected' : ''}} value='July'>July</option>
                    <option {{$month == 'August' ? 'selected' : ''}} value='August'>August</option>
                    <option {{$month == 'September' ? 'selected' : ''}} value='September'>September</option>
                    <option {{$month == 'October' ? 'selected' : ''}} value='October'>October</option>
                    <option {{$month == 'November' ? 'selected' : ''}} value='November'>November</option>
                    <option {{$month == 'December' ? 'selected' : ''}} value='December'>December</option>
                </select> 
            </div>
            <div class="form-group col-md-3">
                <label for="">Year</label>
                <select id="year" name="year" class="form-control select-search" data-fouc>
                    <option value="">Select Year</option>
                    @for($year_loop = 2022;$year_loop <= 2024;$year_loop++)
                    <option 
                        @if($year == $year_loop) selected @endif
                         value="{{$year_loop}}">{{$year_loop}}</option>
                    @endfor
                </select>
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
                <div class="col-2">
                    <p><i class="icon-user icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">
                        <a href="{{route('admin.collection.monthly',$zone->id)}}">
                        {{$zone->name}}
                        </a>
                    </h5>
                    <span class="text-muted font-size-sm">Zone Name</span>
                </div>
                <div class="col-3">
                    <p><i class="icon-cash3 icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyBilledAmount($month,$year)}}</h5>
                    <span class="text-muted font-size-sm">Total Billed Amount</span>
                </div>
                <div class="col-3">
                    <p><i class="icon-cash4 icon-2x d-inline-block text-info"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyCollectedAmount($month,$year)}}</h5>
                    <span class="text-muted font-size-sm">Total Collected Amount</span>
                </div>

                <div class="col-2">
                    <p><i class="icon-cash icon-2x d-inline-block text-warning"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyCashAmount($month,$year)}}</h5>
                    <span class="text-muted font-size-sm">Cash</span>
                </div>

                <div class="col-2">
                    <p><i class="icon-credit-card icon-2x d-inline-block text-success"></i></p>
                    <h5 class="font-weight-semibold mb-0">{{$zone->getMonthlyUpiAmount($month)}}</h5>
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
