@extends('zdc.layout.index')

@section('title')
Manage SHop Pending Payment
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit {{@$pending_payment->shop->shop_name}} Pending Payment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('zdc.pending_payment.update',$pending_payment->id)}}" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pending Amount</label>
                            <input name="amount" value="{{$pending_payment->amount}}" type="number" step="0.01" class="form-control" placeholder="Enter Pending Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id" id="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment</option>
                                @foreach(App\Models\Establishment::all() as $establishment)
                                <option {{$pending_payment->establishment_id == $establishment->id ? 'selected' : '' }} value="{{$establishment->id}}">{{$establishment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Shop</label>
                            <select  name="shop_id" id="shop_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Shop</option>
                                @foreach(App\Models\Shop::where('establishment_id',$pending_payment->establishment_id)->get() as $shop)
                                <option {{$pending_payment->shop_id == $shop->id ? 'selected' : ''}} value="{{$shop->id}}">{{$shop->shop_name .'-'. $shop->shop_number }}</option>
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

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#establishment_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('zdc.shop.get_establishment_shops')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    shops = result.shops;
                    $('#shop_id').empty();
                    $('#shop_id').append('<option>Select Shop</option>');
                    for (i=0;i<shops.length;i++){
                        $('#shop_id').append('<option value="'+shops[i].id+'">'+shops[i].shop_name+'-'+shops[i].shop_number+'</option>');
                    }
                }
            });
        });
    });
</script>
@endsection
