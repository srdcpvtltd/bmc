@extends('super_admin.layout.index')

@section('title')
Manage Establishment
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit {{$establishment->name}} Establishment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.establishment.update',$establishment->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Establishment Name</label>
                            <input name="name" type="text" class="form-control" value="{{$establishment->name}}" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Image</label>
                            <input name="image" type="file" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Background Color</label>
                            <input name="background_color" type="color" class="form-control" value="{{$establishment->background_color}}" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Icon Name</label>
                            <input name="icon_name" type="text" class="form-control"  value="{{$establishment->icon_name}}" placeholder="Enter Icon Name" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Category</label>
                            <select  name="establishment_category_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Category</option>
                                @foreach(App\Models\EstablishmentCategory::all() as $establishment_category)
                                <option @if($establishment->establishment_category_id == $establishment_category->id) selected @endif value="{{$establishment_category->id}}">{{$establishment_category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Establishment Total Shops</label>
                            <input readonly name="total_shops" value="{{$establishment->total_shops}}" type="number" class="form-control" placeholder="Enter Total Shops" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Choose Establishment Zone</label>
                            <select  name="establishment_zone_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Zone</option>
                                @foreach (App\Models\Zone::all()  as $key => $zone)
                                <option value="{{$zone->id}}" {{  $establishment->establishment_zone_id==$zone->id? 'selected':'' }}   >{{$zone->name}}</option>
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

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-right">
                <button data-toggle="modal" data-target="#add_new_shop_modal"  class="btn btn-primary">Add New Shop</button>
            </div>
        </div>
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Shop Number</th>
                    <th>Shop Size</th>
                    <th>Shop Type</th>
                    <th>Shop Rent</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($establishment_shops  as $key => $shop)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$shop->shop_number}}</td>
                    <td>{{$shop->shop_size}}</td>
                    <td>{{$shop->shop_type}}</td>
                    <td>{{$shop->shop_rent}}</td>
                    <td>{{$shop->status?'Rented':'Vacant'}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#edit_modal" shop_number="{{$shop->shop_number}}"
                            shop_size="{{$shop->shop_size}}" shop_type="{{$shop->shop_type}}"
                            shop_rent="{{$shop->shop_rent}}" id="{{$shop->id}}" class="edit-btn btn btn-primary">Edit</button>
                    </td>
                    <td>
                        <form action="{{route('super_admin.establishment_shop.destroy',$shop->id)}}" method="POST">
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

<div id="add_new_shop_modal" class="modal fade">
    <div class="modal-dialog">
        <form action="{{route('super_admin.establishment_shop.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="establishment_id" value="{{$establishment->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Add Establishment Shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Establishment Shop Number</label>
                        <input class="form-control" type="text" name="shop_number" placeholder="Enter Shop Number" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Size</label>
                        <input class="form-control" type="text" name="shop_size" placeholder="Enter Shop Size" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Type</label>
                        <input class="form-control" type="text" name="shop_type" placeholder="Enter Shop Type" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Rent</label>
                        <input class="form-control" type="text" name="shop_rent" placeholder="Enter Shop Rent" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Establishment Shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Establishment Shop Number</label>
                        <input class="form-control" type="text" id="shop_number" name="shop_number" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Size</label>
                        <input class="form-control" type="text" id="shop_size" name="shop_size" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Type</label>
                        <input class="form-control" type="text" id="shop_type" name="shop_type" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Establishment Shop Rent</label>
                        <input class="form-control" type="text" id="shop_rent" name="shop_rent" placeholder="Enter name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let shop_number = $(this).attr('shop_number');
            let shop_size = $(this).attr('shop_size');
            let shop_type = $(this).attr('shop_type');
            let shop_rent = $(this).attr('shop_rent');
            let id = $(this).attr('id');
            $('#shop_number').val(shop_number);
            $('#shop_size').val(shop_size);
            $('#shop_type').val(shop_type);
            $('#shop_rent').val(shop_rent);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('super_admin.establishment_shop.update','')}}' +'/'+id);
        });
    });
</script>
@endsection
