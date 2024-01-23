@extends('zdc.layout.index')

@section('title')
Total Monthly Collection of Zone {{@Auth::user()->zone->name}}
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Monthly Collection of Zone {{@Auth::user()->zone->name}}</h5>
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
                    <option {{@request()->month == 'January' ? 'selected' : ''}} value='January'>January</option>
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
        <div class="table-responsive mt-3">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shop Name</th>
                        <th>Rent</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>Mode of Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments  as $key => $payment)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{@$payment->name}}</td>
                        <td>{{@$payment->shop_rent}}</td>
                        <td>Received</td>
                        <td>{{@$payment->created_at->format('d M,Y')}}</td>
                        <td>{{@$payment->payment_mode}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection