@extends('collection_staff.layout.index')

@section('title')
Edit Payment
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit New Payment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('collection_staff.payment.update',$payment->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input name="amount" readonly value="{{$payment->amount}}" type="text" class="form-control" placeholder="Enter Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Mode</label>
                            <select  name="payment_mode" id="payment_mode"  class="form-control select-search" data-fouc required>
                                <option >Select Payment Mode</option>
                                <option {{$payment->payment_mode == 'Cash' ? 'selected' : ''}} value="Cash">Cash</option>
                                <option {{$payment->payment_mode == 'UPI' ? 'selected' : ''}} value="UPI">UPI</option>
                                {{-- <option value="Online">Online</option> --}}
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select  name="is_paid" id="is_paid"  class="form-control select-search" data-fouc required>
                                <option >Select Status</option>
                                <option {{$payment->is_paid ? 'selected' : ''}} value="1">Paid</option>
                                <option {{!$payment->is_paid ? 'selected' : ''}} value="0">Not Paid</option>
                                {{-- <option value="Online">Online</option> --}}
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
                    $('#amount').val(establishment_shop.shop_rent);
                    $('#shop_rent').val(establishment_shop.shop_rent);
                    $('#shop_number').val(establishment_shop.shop_number);
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
