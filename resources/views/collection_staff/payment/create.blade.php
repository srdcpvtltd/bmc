@extends('collection_staff.layout.index')

@section('title')
Manage Payment
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Payment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(@request()->type)
                <form action="{{route('collection_staff.payment.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="type" value="{{request()->type}}">
                        <input name="location" id="location" type="hidden" required>
                        @if(request()->type == 'daily')
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input name="name" id="name" type="text" class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input name="amount" type="text" class="form-control" placeholder="Enter Amount" required>
                            </div>
                        @endif
                        @if(request()->type == 'monthly')
                        <input name="name" id="name" type="hidden" required>
                        <div class="form-group col-md-6">
                            <label>Month</label>
                            <select name="month" id="month" class="form-control select-search" data-fouc required>
                                <option value="">Select Month</option>
                                <option value='January'>January</option>
                                <option value='February'>February</option>
                                <option value='March'>March</option>
                                <option value='April'>April</option>
                                <option value='May'>May</option>
                                <option value='June'>June</option>
                                <option value='July'>July</option>
                                <option value='August'>August</option>
                                <option value='September'>September</option>
                                <option value='October'>October</option>
                                <option value='November'>November</option>
                                <option value='December'>December</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Year</label>
                            <select name="year" id="year" class="form-control select-search" data-fouc required>
                                <option value="" >Select Year</option>
                                @for($year = 2022;$year <= 2024;$year++)
                                <option value="{{$year}}">{{$year}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id" id="establishment_id"  class="form-control select-search" data-fouc required>
                                <option >Select Establishment</option>
                                @foreach(App\Models\Establishment::all() as $establishment)
                                <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment Shop Number</label>
                            <select  name="establishment_shop_id" id="establishment_shop_id"  class="form-control select-search" data-fouc required>
                                <option selected>Select Establishment Shop Number</option>
                            </select>
                        </div>
                        <input name="shop_number" id="shop_number" type="hidden" class="form-control"  >
                        <input name="shop_id" id="shop_id" type="hidden" class="form-control"  >
                        <div class="form-group col-md-6">
                            <label>Shop Name</label>
                            <input name="shop_name" id="shop_name" type="text" class="form-control" readonly required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Owner Name</label>
                            <input name="owner_name" readonly id="owner_name" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Type</label>
                            <input name="shop_type" readonly id="shop_type" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Size</label>
                            <input name="shop_size" readonly id="shop_size" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Rent</label>
                            <input name="shop_rent" readonly id="shop_rent" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tax Amount</label>
                            <input name="tax_amount" readonly id="tax_amount" type="text" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input name="amount" readonly id="amount" type="text" class="form-control"  required>
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label>Payment Mode</label>
                            <select  name="payment_mode" id="payment_mode"  class="form-control select-search" data-fouc required>
                                <option >Select Payment Mode</option>
                                <option value="Cash">Cash</option>
                                <option value="UPI">UPI</option>
                                {{-- <option value="Online">Online</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    
                </form>
                @else 
                <div class="row">
                    <div class="col-sm-6 col-xl-6">
                        <a href="{{route('collection_staff.payment.create','type=daily')}}">
                            <div class="card card-body bg-teal-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-question4 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right"> 
                                        <h3 class="mb-0">Daily Payment</h3>
                                        {{-- <span class="text-uppercase font-size-xs">{{$zone->name}}</span> --}}
                                    </div>
            
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <a href="{{route('collection_staff.payment.create','type=monthly')}}">
                            <div class="card card-body bg-info-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-question4 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right"> 
                                        <h3 class="mb-0">Monthly Payment</h3>
                                        {{-- <span class="text-uppercase font-size-xs">{{$zone->name}}</span> --}}
                                    </div>
            
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
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
            $('#location').val(position.coords.latitude+','+position.coords.longitude);
        }
        
        $('#establishment_id').change(function(){
            id = this.value;
            month = $("#month").val();
            year = $("#year").val();
            if(month == "")
            {
                alert("Please Select Month");
            }else if(year == "")
            {
                alert("Please Select Year");
            }else{
                $.ajax({
                    url: "{{route('collection_staff.shop.get_taken_establishment_shops')}}",
                    method: 'post',
                    data: {
                        id: id,
                        month: month,
                        year: year,
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

            }
        });
        $('#establishment_shop_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('collection_staff.shop.get_establishment_shop_with_data')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    establishment_shop = result.establishment_shop;
                    shop = result.shop;
                    $('#name').val(shop.owner_name);
                    $('#owner_name').val(shop.owner_name);
                    $('#shop_id').val(shop.id);
                    $('#shop_name').val(shop.shop_name);
                    $('#phone').val(shop.phone);
                    $('#email').val(shop.email);
                    $('#shop_size').val(establishment_shop.shop_size);
                    $('#shop_type').val(establishment_shop.shop_type);
                    $('#shop_rent').val(establishment_shop.shop_rent);
                    $('#shop_number').val(establishment_shop.shop_number);
                    $('#amount').val(result.total_amount);
                    $('#tax_amount').val(result.tax_amount);
                }
            });
        });
        $('#payment_mode').change(function(){
            value = this.value;
            if(value == 'Online')
            {
                alert(value);
            }
        });
    });
</script>
@endsection
