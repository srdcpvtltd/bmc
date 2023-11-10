@extends('zdc.layout.index')

@section('title')
Manage Arrears
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('zdc.pending_payment.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group col-md-6">
                            <label>Arrear Amount</label>
                            <input name="amount" type="number" step="0.01" class="form-control" placeholder="Enter Pending Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id" id="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment</option>
                                @foreach(App\Models\Establishment::all() as $establishment)
                                <option value="{{$establishment->id}}">{{$establishment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Shop</label>
                            <select  name="shop_id" id="shop_id" class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Shop</option>
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

<div class="card">

    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Establishment Name</th>
                <th>Shop Name</th>
                <th>Shop Number</th>
                <th>Amount</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->pendingPayments  as $key => $pending_payment)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{@$pending_payment->establishment->name}}</td>
                <td>{{@$pending_payment->shop->shop_name}}</td>
                <td>{{@$pending_payment->shop->shop_number}}</td>
                <td>{{$pending_payment->amount}}</td>
                <td>
                    <a href="{{route('zdc.pending_payment.edit',$pending_payment->id)}}" class="btn btn-primary">Edit</a> </td>
                <td>
                    <form action="{{route('zdc.pending_payment.destroy',$pending_payment->id)}}" method="POST">
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
