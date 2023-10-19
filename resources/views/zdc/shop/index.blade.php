@extends('zdc.layout.index')

@section('title')
Manage Shop
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Shops</h5>
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
                    <th>Shop QR Code</th>
                    <th>Establishment Name</th>
                    <th>Shop Name</th>
                    <th>Shop No</th>
                    <th>Owner Name</th>
                    <th>Phone</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Shop::all()  as $key => $shop)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><iframe src="{{$shop->getQRCode()}}" height="155" width="155" style="border:white;"></iframe></td>
                    <td>{{$shop->establishment->name}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$shop->shop_number}}</td>
                    <td>{{$shop->owner_name}}</td>
                    <td>{{$shop->phone}}</td>
                    <td>
                        <a type="button"  href="{{route('zdc.shop.show',$shop->id)}}" class="btn btn-primary btn-sm">Detail</button>
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