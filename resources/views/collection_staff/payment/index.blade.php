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
                <form action="{{route('collection_staff.payment.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input name="amount" type="text" class="form-control" placeholder="Enter Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Location</label>
                            <input name="location" id="location" readonly type="text" class="form-control" placeholder="Enter Location" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id"  class="form-control select-search" data-fouc required>
                                <option >Select Establishment</option>
                                @foreach(App\Models\Establishment::all() as $establishment)
                                <option value="{{$establishment->id}}">{{$establishment->name}}</option>
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

<div class="card">

    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Location</th>
                <th>Establishment</th>
                <th>Update Date</th>
                <th>Update Time</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Payment::where('user_id',Auth::user()->id)->get()  as $key => $payment)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$payment->name}}</td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->location}}</td>
                <td>{{@$payment->establishment->name}}</td>
                <td>{{@$payment->updated_at->format('d M,Y')}}</td>
                <td>{{@$payment->updated_at->format('H:i s')}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="{{$payment->name}}" 
                        amount="{{$payment->amount}}"  establishment_id="{{$payment->establishment_id}}" id="{{$payment->id}}" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('collection_staff.payment.destroy',$payment->id)}}" method="POST">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name"> Amount</label>
                        <input class="form-control" type="text" id="amount" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="form-group">
                        <label>Choose Establishment</label>
                        <select  name="establishment_id" id="establishment_id"  class="form-control" required>
                            <option >Select Establishment-</option>
                            @foreach(App\Models\Establishment::all() as $establishment)
                            <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                            @endforeach
                        </select>
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
        
        navigator.geolocation.getCurrentPosition(showPosition);
        
        function showPosition(position) {
            $('#location').val(position.coords.latitude+','+position.coords.longitude);
        }
        $('.edit-btn').click(function(){
            let establishment_id = $(this).attr('establishment_id');
            let amount = $(this).attr('amount');
            let name = $(this).attr('name');
            let id = $(this).attr('id');
            $('#establishment_id').val(establishment_id);
            $('#amount').val(amount);
            $('#name').val(name);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('collection_staff.payment.update','')}}' +'/'+id);
        });
    });
</script>
@endsection
