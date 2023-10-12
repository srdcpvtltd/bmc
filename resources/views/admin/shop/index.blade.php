@extends('super_admin.layout.index')

@section('title')
Manage Shop
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Shops</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('super_admin.shop.create')}}" class="btn btn-primary text-right">Add New Shop</a>
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
                    <th>Shop Name</th>
                    <th>Owner Name</th>
                    <th>Phone</th>
                    <th>Register Shop</th>
                    <th>Generate QR Code</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Shop::all()  as $key => $shop)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$shop->owner_name}}</td>
                    <td>{{$shop->phone}}</td>
                    
                    <td>
                        @if($shop->customer_id)
                        {{$shop->customer_id}} <span class="badge badge-success badge-sm">Already Connected</span>
                        @else 
                        <a type="button"  href="{{route('super_admin.shop.create_shop_profile',$shop->id)}}" class="btn btn-primary btn-sm">Create Shop Profile</button>
                        @endif
                    </td>
                    <td>
                        @if($shop->customer_id)
                            <a type="button"  href="{{route('super_admin.shop.show',$shop->id)}}" class="btn btn-primary btn-sm">Generate QR Code</button>
                        @endif
                    </td>
                    <td>
                        <a type="button"  href="{{route('super_admin.shop.edit',$shop->id)}}" class="edit-btn btn btn-primary">Edit</button>
                    </td>
                    <td>
                        <form action="{{route('super_admin.shop.destroy',$shop->id)}}" method="POST">
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
</div>

@endsection

@section('scripts')
@endsection