@extends('super_admin.layout.index')

@section('title')
Manage Qr Payments
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Qr Payments</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{url('get-payments')}}" class="btn btn-primary text-right">Get New Payments</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
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