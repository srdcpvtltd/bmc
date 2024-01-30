@extends('admin.layout.index')

@section('title')
Total Monthly Collection
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Monthly Collection Date Wise</h5>
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
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{$start_date->format('Y-m-d')}}" class="form-control" >
            </div>
            <div class="form-group col-md-3">
                <label for="">End Date</label>
                <input type="date" name="end_date" value="{{$end_date->format('Y-m-d')}}" class="form-control" >
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
                        <th>Payment Date</th>
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
                        <td>Received</td>
                        <td>{{@$payment->updated_at->format('d M,Y')}}</td>
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