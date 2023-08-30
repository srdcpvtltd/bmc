@extends('admin.layout.index')

@section('title')
View Shops
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Shop Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">

        
        <div class="row" style="margin-top:20px!important;">
            <div class="col-md-12">
                <table class="table datatable-button-html5-basic">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Establishment</th>
                            <th>Zone</th>
                            <th>Ward</th>
                            <th>Owner Name</th>
                            <th>Owner Phone</th>
                            <th>Allotment Date</th>
                            <th>Allotment No</th>
                            <th>Valid Upto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops  as $key => $shop)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('admin.shop.detail',$shop->id)}}">{{$shop->shop_name}}</a></td>
                            <td>{{@$shop->establishment->name}}</td>
                            <td>{{@$shop->zone->name}}</td>
                            <td>{{@$shop->ward->name}}</td>
                            <td>{{$shop->owner_name}}</td>
                            <td>{{$shop->phone}}</td>
                            <td>{{$shop->allotment_date}}</td>
                            <td>{{$shop->allotment_number}}</td>
                            <td>{{$shop->valid_upto}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection