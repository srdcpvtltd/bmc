@extends('admin.layout.index')

@section('title')
Generate QR Code For {{$shop->name}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Generate QR Code For {{$shop->name}}</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.qr_code.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                    <input type="hidden" name="customer_id" value="{{$shop->customer_id}}" required>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Shop Name</label>
                            <input name="name" type="text" value="{{$shop->shop_name}}" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Usage</label>
                            <select  name="usage"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Usage</option>
                                <option value="single_use">Single Usage</option>
                                <option value="multiple_use">Multiple Usage</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Is Fixed Amount</label>
                            <br>
                            <input type="radio" name="fixed_amount" class="" value="1"> Yes
                            <input type="radio" name="fixed_amount" class="" selected value="0"> No
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Amount</label>
                            <input type="text" name="payment_amount" value="{{$shop->shop_rent}}"class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Notes</label>
                            <input type="text" name="notes" class="form-control" required>
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
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shop->qrCodes  as $key => $qr_code)
            <tr>
                <td>{{$key+1}}</td>
                <td><a href="{{$qr_code->image_url}}" target="_blank">Download Image</a></td>
                <td>{{$qr_code->name}}</td>
                <td>{{$qr_code->status}}</td>
                <td>{{$qr_code->payment_amount}}</td>
                <td>
                    @if($qr_code->usage == 'multiple_use')
                    Multiple usage
                    @else 
                    Single Usage
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
@endsection