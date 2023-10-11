@extends('super_admin.layout.index')

@section('title')
    Monthly Collection
@endsection

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Payments</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <input type="hidden" name="active_tab" value="income_statement">
                <div class="form-group col-2">
                    <label>
                        Start Date
                        <input type="text" name="start_date" class="daterange-single form-control pull-right dates" style="height: 35px; "
                            value="{{ date('m/d/Y', strtotime(@$start_date))}}">
                    </label>   
                </div>
                <div class="form-group col-2">
                    <label>
                        End Date
        
                        <input type="text" name="end_date" class="daterange-single form-control pull-right dates" style="height: 35px; "
                            value="{{ date('m/d/Y', strtotime(@$end_date))}}">
                    </label>   
                </div>
                <div class="form-group col-2">
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Mode</th>
                        <th>Type</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Owner Name</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>Shop Number</th>
                        <th>Shop Rent</th>
                        <th>Location</th>
                        <th>Establishment</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments  as $key => $payment)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$payment->user_name}}</td>
                        <td>{{$payment->name}}</td>
                        <td>{{@$payment->payment_mode}}</td>
                        <td>{{@$payment->type}}</td>
                        <td>{{@$payment->month}}</td>
                        <td>{{@$payment->year}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{@$payment->phone}}</td>
                        <td>{{@$payment->shop_name}}</td>
                        <td>{{@$payment->shop_number}}</td>
                        <td>{{$payment->location}}</td>
                        <td>{{@$payment->establishment->name}}</td>
                        <td>{{@$payment->created_at->format('d M,Y H:i s')}}</td>
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
