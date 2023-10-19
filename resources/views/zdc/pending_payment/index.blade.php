@extends('zdc.layout.index')

@section('title')
Manage Pending Payments
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Pending Payment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('zdc.pending_payment.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pending Amount</label>
                            <input name="amount" type="number" step="0.01" class="form-control" placeholder="Enter Pending Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Shop</label>
                            <select  name="shop_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Shop</option>
                                @foreach(App\Models\Shop::all() as $shop)
                                <option value="{{$shop->id}}">{{$shop->shop_name .'-'. $shop->shop_number }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

<div class="card">

    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Shop Name</th>
                <th>Shop Number</th>
                <th>Amount</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\PendingPayment::all()  as $key => $pending_payment)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{@$pending_payment->shop->shop_name}}</td>
                <td>{{@$pending_payment->shop->shop_number}}</td>
                <td>{{$pending_payment->amount}}</td>
                <td>
                    <a href="{{route('zdc.pending_payment.edit',$pending_payment->id)}}" class="btn btn-primary">Edit</a> </td>
                <td>
                    <form action="{{route('zdc.pending_payment.destroy',$pending_payment->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
@endsection
