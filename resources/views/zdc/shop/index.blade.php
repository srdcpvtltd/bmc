@extends('zdc.layout.index')

@section('title')
Manage Shop
@endsection

@section('content')

<div class="row">
    @foreach (App\Models\Shop::all()  as $key => $shop)
    <div class="col-xl-4">
        <a href="{{route('zdc.shop.show',$shop->id)}}" style="color:black;">
            <div class="card border-left-3 border-left-success-400 rounded-left-0">
                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                    <span><h5>Shop Number </h5> <p class="font-weight-semibold">{{@$shop->shop_number}}</p></span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection

@section('scripts')
@endsection