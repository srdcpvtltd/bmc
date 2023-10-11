@extends('zdc.layout.index')

@section('title')
    Monthly Collection
@endsection

@section('content')
<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title">Search Payment By Month</h5>
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
                    <option {{@request()->month == 'Janaury' ? 'selected' : ''}} value='Janaury'>Janaury</option>
                    <option {{@request()->month == 'February' ? 'selected' : ''}} value='February'>February</option>
                    <option {{@request()->month == 'March' ? 'selected' : ''}} value='March'>March</option>
                    <option {{@request()->month == 'April' ? 'selected' : ''}} value='April'>April</option>
                    <option {{@request()->month == 'May' ? 'selected' : ''}} value='May'>May</option>
                    <option {{@request()->month == 'June' ? 'selected' : ''}} value='June'>June</option>
                    <option {{@request()->month == 'July' ? 'selected' : ''}} value='July'>July</option>
                    <option {{@request()->month == 'August' ? 'selected' : ''}} value='August'>August</option>
                    <option {{@request()->month == 'September' ? 'selected' : ''}} value='September'>September</option>
                    <option {{@request()->month == 'October' ? 'selected' : ''}} value='October'>October</option>
                    <option {{@request()->month == 'November' ? 'selected' : ''}} value='November'>November</option>
                    <option {{@request()->month == 'December' ? 'selected' : ''}} value='December'>December</option>
                </select> 
            </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>
    </div>
</div>
@foreach($establishments as $establishment)
<div class="row">
    <div class="col-sm-6 col-xl-6">
        <a href="{{route('zdc.collection.monthly_detail',$establishment->id)}}">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-user icon-3x text-success-400"></i>
                    </div>
    
                    <div class="media-body text-right">
                        <h3 class="font-weight-semibold mb-0">{{$establishment->name}}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Establishment Name</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-6">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-cash icon-3x text-indigo-400"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{$establishment->total_amount}}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Total Collection Amount</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('scripts')
@endsection
