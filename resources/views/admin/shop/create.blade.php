@extends('admin.layout.index')

@section('title')
    Add New Shop
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Shop</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.shop.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Shop Owner Name</label>
                            <input name="owner_name" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Phone</label>
                            <input name="phone" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Number</label>
                            <input name="shop_number" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Rent</label>
                            <input name="shop_rent" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Rent Frequency</label>
                            <select  name="rent_frequency"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Rent Frequency-</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Annually">Annually</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Location</label>
                            <input name="lat_long" id="lat_long" readonly type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Zone</label>
                            <select  name="zone_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select zone-</option>
                                @foreach(App\Models\Zone::all() as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Ward</label>
                            <select  name="ward_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Ward</option>
                                @foreach(App\Models\Ward::all() as $ward)
                                <option value="{{$ward->id}}">{{$ward->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Area</label>
                            <select  name="area_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Area</option>
                                @foreach(App\Models\Area::all() as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Location</label>
                            <select  name="location_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Location</option>
                                @foreach(App\Models\Location::all() as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment</option>
                                @foreach(App\Models\Establishment::all() as $establishment)
                                <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                @endforeach
                            </select>
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

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        navigator.geolocation.getCurrentPosition(showPosition);
        
        function showPosition(position) {
            $('#lat_long').val(position.coords.latitude+','+position.coords.longitude);
        }
    });
</script>
@endsection