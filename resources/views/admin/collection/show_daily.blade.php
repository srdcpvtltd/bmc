@extends('admin.layout.index')

@section('title')
Total Collection of Collection Agent {{@$user->name}}
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Total Collection of Collection Agent {{@$user->name}}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable-save-state">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Mode</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Location</th>
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
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->location}}</td>
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