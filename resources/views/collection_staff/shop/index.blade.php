@extends('collection_staff.layout.index')

@section('title')
Manage Shop
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Shops</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('collection_staff.shop.create')}}" class="btn btn-primary text-right">Add New Shop</a>
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
                    <th>Shop QR Code</th>
                    <th>Establishment Name</th>
                    <th>Shop Name</th>
                    <th>Shop No</th>
                    <th>Owner Name</th>
                    <th>Phone</th>
                    {{-- <th>Register Shop</th> --}}
                    {{-- <th>Shop QR Code</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->shops  as $key => $shop)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><iframe src="{{$shop->getQRCode()}}" height="155" width="155" style="border:white;"></iframe></td>
                    <td>{{$shop->establishment->name}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$shop->establishment->shop_number}}</td>
                    <td>{{$shop->owner_name}}</td>
                    <td>{{$shop->phone}}</td>
                    
                    {{-- <td>
                        @if($shop->customer_id)
                        {{$shop->customer_id}} <span class="badge badge-success badge-sm">Already Connected</span>
                        @else 
                        <a type="button"  href="{{route('collection_staff.shop.create_shop_profile',$shop->id)}}" class="btn btn-primary btn-sm">Create Shop Profile</button>
                        @endif
                    </td>
                    <td>
                        @if($shop->customer_id)
                            <a type="button"  href="{{route('collection_staff.shop.show',$shop->id)}}" class="btn btn-primary btn-sm">Generate QR Code</button>
                        @endif
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@endsection