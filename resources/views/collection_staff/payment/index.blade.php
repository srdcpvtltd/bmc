@extends('collection_staff.layout.index')

@section('title')
Manage Payment
@endsection

@section('content')


<div class="card">
    <div class="row mt-2 mr-2"> 
        <div class="col-md-12">
            <a href="{{route('collection_staff.payment.create')}}" class="btn btn-primary float-right">Create Payment</a>
        </div>
    </div>
    <div class="table-responsive"> 
        <table class="table datatable-save-state table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mode</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Owner Name</th>
                    <th>Phone</th>
                    <th>Shop Number</th>
                    <th>Shop Rent</th>
                    <th>Location</th>
                    <th>Establishment</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Payment::where('user_id',Auth::user()->id)->get()  as $key => $payment)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$payment->name}}</td>
                    <td>{{@$payment->payment_mode}}</td>
                    <td>{{@$payment->type}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{@$payment->owner_name}}</td>
                    <td>{{@$payment->phone}}</td>
                    <td>{{@$payment->shop_number}}</td>
                    <td>{{@$payment->shop_rent}}</td>
                    <td>{{$payment->location}}</td>
                    <td>{{@$payment->establishment->name}}</td>
                    <td>{{@$payment->created_at->format('d M,Y H:i s')}}</td>
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
