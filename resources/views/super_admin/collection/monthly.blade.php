@extends('super_admin.layout.index')

@section('title')
    Monthly Collection
@endsection

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Qr Payments</h5>
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
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Shop</th>
                    <th>QR ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Transcation ID</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments  as $key => $payment)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{@$payment->qrCode->shop->owner_name}}</td>
                    <td>{{@$payment->qrCode->qr_id}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->status}}</td>
                    <td>{{$payment->payment_id}}</td>
                    <td>{{$payment->payment_created_at}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@endsection
