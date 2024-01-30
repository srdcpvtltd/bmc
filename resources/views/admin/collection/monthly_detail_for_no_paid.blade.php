@extends('admin.layout.index')

@section('title')
Total Monthly Collection of Non Paid Shop
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Monthly Collection of Non Paid Shop</h5>
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
        <div class="table-responsive mt-3">
            <table class="table datatable-button-html5-basic">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Owner Name</th>
                        <th>Shop Name</th>
                        <th>Rent</th>
                        <th>Payment Status</th>
                        <th>Create Date</th>
                        <th>Mode of Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments  as $key => $payment)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{@$payment->name}}</td>
                        <td>{{@$payment->shop_name ? $payment->shop_name  : $payment->shop->shop_name }}</td>
                        <td>{{@$payment->shop_rent}}</td>
                        <td>Pending</td>
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