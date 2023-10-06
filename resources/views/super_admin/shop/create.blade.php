@extends('super_admin.layout.index')

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
                <form action="{{route('super_admin.shop.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Shop Name</label>
                            <input name="shop_name" type="text" class="form-control"  required>
                        </div>
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
                            <label>Choose Establishment Category</label>
                            <select  name="establishment_category_id" id="establishment_category_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment Category</option>
                                @foreach(App\Models\EstablishmentCategory::all() as $establishment_category)
                                <option value="{{$establishment_category->id}}">{{$establishment_category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id" id="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected >Select Establishment</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Shop Number</label>
                            <select  name="establishment_shop_id" id="establishment_shop_id"  class="form-control select-search" data-fouc required>
                                <option selected>Select Establishment Shop Number</option>
                            </select>
                        </div>
                        <input name="shop_number" id="shop_number" type="hidden" class="form-control"  >
                        {{-- <div class="form-group col-md-6">
                            <label>Shop Number</label>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>Shop Size</label>
                            <input name="shop_size" id="shop_size" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Type</label>
                            <input name="shop_type" id="shop_type" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Rent</label>
                            <input name="shop_rent" id="shop_rent" type="text" class="form-control"  required>
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
                            <label>ID Proof</label>
                            <select  name="id_proof"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select ID Proof</option>
                                <option value="PAN">PAN</option>
                                <option value="Aadhar Card">Aadhar Card</option>
                                <option value="Voter ID">Voter ID</option>
                                <option value="Driving License">Driving License</option>
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label>ID Proof Number</label>
                            <input name="id_proof_number" type="text" class="form-control"  required>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>Lat/Long.</label>
                            <input name="lat_long" id="lat_long" readonly type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Zone</label>
                            <select  name="zone_id" id="zone_id" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select zone-</option>
                                @foreach(App\Models\Zone::all() as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Ward</label>
                            <select  name="ward_id" id="ward_id" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Ward</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Structure</label>
                            <select  name="structure_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Structure</option>
                                @foreach(App\Models\Structure::all() as $structure)
                                <option value="{{$structure->id}}">{{$structure->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <input type="text" name="location" class="form-control" required>
                            {{-- <select  name="location_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Location</option>
                                @foreach(App\Models\Location::all() as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label>Allotment Date</label>
                            <input type="date" name="allotment_date" id="allotment_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Number of Years</label>
                            <input type="text" name="number_of_years" id="number_of_years" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Valid Upto</label>
                            <input type="date" name="valid_upto" id="valid_upto" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Allotment Number</label>
                            <input type="text" name="allotment_number" id="allotment_number" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Trade License Number</label>
                            <input type="text" name="trade_license_number" id="trade_license_number" class="form-control" required>
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
        // $('#number_of_years').change(function(){
        //     years = this.value;
        //     alert(years);
        //     date = $('#allotment_date').val();
        //     alert(date);
        //     var inThreeYears = new Date(date);
        //     inThreeYears.setFullYear (inThreeYears.getFullYear() + years )
        //     var date =  inThreeYears.toLocaleDateString('en-US',{day:"2-digit",month:"2-digit",year:"numeric"})
        //     alert(date);
        //     $('#valid_upto').val(valid_upto);
        // });
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