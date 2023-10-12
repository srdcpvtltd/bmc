@extends('admin.layout.index')

@section('title')
    Edit {{$shop->name}} Shop
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit {{$shop->name}} Shop</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.shop.update',$shop->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Shop Name</label>
                            <input name="shop_name" value="{{$shop->shop_name}}" type="text" class="form-control"  required>
                        </div>
                       <div class="form-group col-md-6">
                            <label>Shop Owner Name</label>
                            <input name="owner_name" value="{{$shop->owner_name}}" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Phone</label>
                            <input name="phone" type="text" value="{{$shop->phone}}"  class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Email</label>
                            <input name="email" type="email" value="{{$shop->email}}"  class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Category</label>
                            <select  name="establishment_category_id"  id="establishment_category_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Category</option>
                                @foreach(App\Models\EstablishmentCategory::all() as $establishment_category)
                                <option @if($establishment_category->id == $shop->establishment_category_id) selected @endif value="{{$establishment_category->id}}">{{$establishment_category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id"  id="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment</option>
                                @foreach(App\Models\Establishment::where('establishment_category_id',$shop->establishment_category_id)->get() as $establishment)
                                <option @if($establishment->id == $shop->establishment_id) selected @endif value="{{$establishment->id}}">{{$establishment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Shop Number</label>
                            <select  name="establishment_shop_id" id="establishment_shop_id"  class="form-control select-search" data-fouc required>
                                <option >Select Establishment Shop Number</option>
                                @if($shop->establishment_shop_id)
                                <option value="{{$shop->establishment_shop_id}}" selected >{{@$shop->establishment_shop->shop_number}}</option>
                                @endif
                                @foreach(App\Models\EstablishmentShop::where('establishment_id',$shop->establishment_id)->where('status',0)->get() as $establishment_shop)
                                <option @if($establishment_shop->id == $shop->establishment_shop_id) selected @endif value="{{$establishment_shop->id}}">{{$establishment_shop->shop_number}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="shop_number" id="shop_number" type="hidden" value="{{$shop->shop_number}}" class="form-control" >
                        {{-- <div class="form-group col-md-6">
                            <label>Shop Number</label>
                            <input name="shop_number" id="shop_number" type="text"  value="{{$shop->shop_number}}" class="form-control"  required>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>Shop Size</label>
                            <input name="shop_size" id="shop_size" type="text" value="{{$shop->shop_size}}" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Type</label>
                            <input name="shop_type" id="shop_type" type="text" value="{{$shop->shop_type}}" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Rent</label>
                            <input name="shop_rent" id="shop_rent" type="text" value="{{$shop->shop_rent}}"  class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Rent Frequency</label>
                            <select  name="rent_frequency"  class="form-control select-search" data-fouc required>
                                <option disabled>Select Rent Frequency-</option>
                                <option @if($shop->rent_frequency == 'Weekly' ) selected @endif value="Weekly">Weekly</option>
                                <option @if($shop->rent_frequency == 'Monthly' ) selected @endif value="Monthly">Monthly</option>
                                <option @if($shop->rent_frequency == 'Quarterly' ) selected @endif value="Quarterly">Quarterly</option>
                                <option @if($shop->rent_frequency == 'Annually' ) selected @endif value="Annually">Annually</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>ID Proof</label>
                            <select  name="id_proof"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select ID Proof</option>
                                <option @if($shop->id_proof == 'PAN' ) selected @endif value="PAN">PAN</option>
                                <option @if($shop->id_proof == 'Aadhar Card' ) selected @endif value="Aadhar Card">Aadhar Card</option>
                                <option @if($shop->id_proof == 'Voter ID' ) selected @endif value="Voter ID">Voter ID</option>
                                <option @if($shop->id_proof == 'Driving License' ) selected @endif value="Driving License">Driving License</option>
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label>ID Proof Number</label>
                            <input name="id_proof_number" value="{{$shop->id_proof_number}}" type="text" class="form-control"  required>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>Lat/Long.</label>
                            <input name="lat_long" value="{{$shop->lat_long}}" id="lat_long" readonly type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Zone</label>
                            <select  name="zone_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select zone-</option>
                                @foreach(App\Models\Zone::all() as $zone)
                                <option @if($zone->id == $shop->zone_id) selected @endif value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Ward</label>
                            <select  name="ward_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Ward</option>
                                @foreach(App\Models\Ward::where('zone_id',$shop->zone_id)->get() as $ward)
                                <option @if($ward->id == $shop->ward_id) selected @endif value="{{$ward->id}}">{{$ward->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Structure</label>
                            <select  name="structure_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Structure</option>
                                @foreach(App\Models\Structure::all() as $structure)
                                <option @if($structure->id == $shop->structure_id) selected @endif value="{{$structure->id}}">{{$structure->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <input type="text" value="{{$shop->location}}" name="location" class="form-control" required>
                            {{-- <select  name="location_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Location</option>
                                @foreach(App\Models\Location::all() as $location)
                                <option @if($location->id == $shop->location_id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label>Allotment Date</label>
                            <input type="date" name="allotment_date" value="{{$shop->allotment_date}}" id="allotment_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Number of Years</label>
                            <input type="text" name="number_of_years"  value="{{$shop->number_of_years}}" id="number_of_years" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Valid Upto</label>
                            <input type="date" name="valid_upto" value="{{$shop->valid_upto}}" id="valid_upto" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Allotment Number</label>
                            <input type="text" name="allotment_number" value="{{$shop->allotment_number}}" id="allotment_number" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Trade License Number</label>
                            <input type="text" name="trade_license_number" value="{{$shop->trade_license_number}}" id="trade_license_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Edit <i class="icon-paperplane ml-2"></i></button>
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
        $('#zone_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('super_admin.shop.get_wards')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    wards = result.wards;
                    $('#ward_id').empty();
                    $('#ward_id').append('<option disabled>Select Ward</option>');
                    for (i=0;i<wards.length;i++){
                        $('#ward_id').append('<option value="'+wards[i].id+'">'+wards[i].name+'</option>');
                    }
                }
            });
        });
        $('#establishment_category_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('super_admin.shop.get_establishments')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    establishments = result.establishments;
                    $('#establishment_id').empty();
                    $('#establishment_id').append('<option>Select Establishment</option>');
                    for (i=0;i<establishments.length;i++){
                        $('#establishment_id').append('<option value="'+establishments[i].id+'">'+establishments[i].name+'</option>');
                    }
                }
            });
        });
        $('#establishment_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('super_admin.shop.get_establishment_shops')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    establishment_shops = result.establishment_shops;
                    $('#establishment_shop_id').empty();
                    $('#establishment_shop_id').append('<option>Select Shop Number</option>');
                    for (i=0;i<establishment_shops.length;i++){
                        $('#establishment_shop_id').append('<option value="'+establishment_shops[i].id+'">'+establishment_shops[i].shop_number+'</option>');
                    }
                }
            });
        });
        $('#establishment_shop_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('super_admin.shop.get_establishment_shop')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    establishment_shop = result.establishment_shop;
                    $('#shop_number').val(establishment_shop.shop_number);
                    $('#shop_size').val(establishment_shop.shop_size);
                    $('#shop_type').val(establishment_shop.shop_type);
                    $('#shop_rent').val(establishment_shop.shop_rent);
                }
            });
        });
    });
</script>
@endsection