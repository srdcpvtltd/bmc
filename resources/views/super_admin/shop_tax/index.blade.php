@extends('super_admin.layout.index')

@section('title')
Manage Shop Tax
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Shop Tax By Establishment</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.shop_tax.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tax Amount</label>
                            <input name="amount" type="number" min="1" value="0.00" step="0.01" class="form-control" placeholder="Enter Tax Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tax Type</label>
                            <br>
                            <input type="radio" name="type" class="" checked value="Fixed"> Fixed
                            <input type="radio" name="type" class=""  value="Percentage"> Percentage                     
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shop Rent Limit <small style="color:green;">(Apply tax only if shop rent is greater than this limit) </small></label>
                            <input name="limit" type="number" min="1"  value="0.00" step="0.01" class="form-control" placeholder="Enter Tax Amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Choose Establishment</label>
                            <select  name="establishment_id"  class="form-control select-search" data-fouc required>
                                <option selected disabled>Select Establishment</option>
                                @foreach($establishments as $establishment)
                                @if(!$establishment->tax)
                                    <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                @endif
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
                <th>Tax Amount</th>
                <th>Tax Type</th>
                <th>Limit</th>
                <th>Establishment Name</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes  as $key => $tax)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tax->amount}}</td>
                <td>{{$tax->type}}</td>
                <td>{{$tax->limit}}</td>
                <td>{{$tax->establishment->name}}</td>
                <td>
                    <a href="{{route('super_admin.shop_tax.edit',$tax->id)}}" class="btn btn-primary">Edit</a> </td>
                <td>
                    <form action="{{route('super_admin.shop_tax.destroy',$tax->id)}}" method="POST">
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

@endsection
