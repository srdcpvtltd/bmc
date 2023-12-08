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
                <h5 class="card-title">Add New Establishment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.establishment.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Establishment Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Image</label>
                            <input name="image" type="file" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Background Color</label>
                            <input name="background_color" type="color" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Establishment Icon Name</label>
                            <input name="icon_name" type="text" class="form-control" placeholder="Enter Icon Name" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Category</label>
                            <select  name="establishment_category_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Category</option>
                                @foreach(App\Models\EstablishmentCategory::all() as $establishment_category)
                                <option value="{{$establishment_category->id}}">{{$establishment_category->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Establishment Total Shops</label>
                            <input name="total_shops" id="total_shops" type="number" class="form-control" placeholder="Enter Total Shops" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Choose Establishment Zone</label>
                            <select  name="establishment_zone_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Zone</option>
                                @foreach (App\Models\Zone::all()  as $key => $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('establishment_zone_id')
                        <span class="text-danger">{{ $message }}</span>
                       @enderror

                    </div>
                    <div id="shop_fields">
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
                <th>Background Color</th>
                <th>Icon Name</th>
                <th>Category</th>
                <th>Total Shops</th>
                <th>Remaining Shops</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Establishment::all()  as $key => $establishment)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    @if($establishment->image)
                    <img src="{{asset($establishment->image)}}" height="100" width="100" alt="">
                    @endif
                </td>
                <td>{{$establishment->name}}</td>
                <td>{{$zone->background_color}}</td>
                <td>{{$zone->icon_name}}</td>
                <td>{{$establishment->establishment_category->name}}</td>
                <td>{{$establishment->total_shops}}</td>
                <td>{{$establishment->total_shops - $establishment->shops->count()}}</td>
                <td>
                    <a href="{{route('super_admin.establishment.edit',$establishment->id)}}" class="btn btn-primary">Edit</a> </td>
                <td>
                    <form action="{{route('super_admin.establishment.destroy',$establishment->id)}}" method="POST">
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

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Establishment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Establishment Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label>Choose Establishment Category</label>
                        <select name="establishment_category_id" id="establishment_category_id" class="form-control" required>
                            <option selected disabled>Select Establishment Category</option>
                            @foreach(App\Models\EstablishmentCategory::all() as $establishment_category)
                            <option value="{{$establishment_category->id}}">{{$establishment_category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Establishment Total Shops</label>
                        <input name="total_shops" id="total_shops" type="number" class="form-control" placeholder="Enter Total Shops" required>
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
<div  id="new_shop_field" style="display:none;">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Shop Number</label>
            <input name="shop_number[]" type="text" class="form-control"  required>
        </div>
        <div class="form-group col-md-6">
            <label>Shop Size</label>
            <input name="shop_size[]" type="text" class="form-control"  required>
        </div>
        <div class="form-group col-md-6">
            <label>Shop Type</label>
            <input name="shop_type[]" type="text" class="form-control"  required>
        </div>
        <div class="form-group col-md-6">
            <label>Shop Rent</label>
            <input name="shop_rent[]" type="text" class="form-control"  required>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let establishment_category_id = $(this).attr('establishment_category_id');
            let total_shops = $(this).attr('total_shops');
            let name = $(this).attr('name');
            let id = $(this).attr('id');
            $('#total_shops').val(total_shops);
            $('#establishment_category_id').val(establishment_category_id);
            $('#name').val(name);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('super_admin.establishment.update','')}}' +'/'+id);
        });
        $('#total_shops').change(function(){
            $('#shop_fields').html("");
            let total_shops = $(this).val();
            for(i = 1;i <= total_shops;i++)
            {
                new_shop_field = $('#new_shop_field').html();
                $('#shop_fields').append('<p>Shop '+i+'</p>');
                $('#shop_fields').append(new_shop_field);
            }
        });
    });
</script>
@endsection
