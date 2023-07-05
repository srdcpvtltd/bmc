@extends('admin.layout.index')

@section('title')
Total Collection of Zone {{@$zone->name}}
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Collection of Zone {{@$zone->name}}</h5>
        <div class="header-elements">
            <div class="list-icons">
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
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Update Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments  as $key => $payment)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$payment->user_name}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->updated_at->format("d M,Y")}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@endsection