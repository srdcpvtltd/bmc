@extends('zdc.layout.index')

@section('title')
Manage SHop Pending Payment
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit {{@$pending_payment->shop->shop_name}} Pending Payment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('zdc.pending_payment.update',$pending_payment->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pending Amount</label>
                            <input name="amount" value="{{$pending_payment->amount}}" type="number" step="0.01" class="form-control" placeholder="Enter Pending Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Shop</label>
                            <select  name="shop_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Shop</option>
                                @foreach(App\Models\Shop::all() as $shop)
                                <option {{$pending_payment->shop_id == $shop->id ? 'selected' : ''}} value="{{$shop->id}}">{{$shop->shop_name .'-'. $shop->shop_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

@endsection

@section('scripts')
@endsection
